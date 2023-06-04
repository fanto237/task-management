#!/bin/bash

RED='\033[0;32m'  # Red color code
BLUE='\033[0;34m'  # Blue color code
NC='\033[0m'      # No color code


read -p "Do you have docker-compose installed? (yes/no): " response

if [ "$response" == "yes" ]; then
    # If docker-compose is installed, run docker-compose up
    echo -e "${RED}running docker-compose up...${NC}"
    docker-compose up --force-recreate --build -d
else
    # Create a Docker network named 'infrastruktur'
    echo -e "${RED}Creating Docker network 'infrastruktur'...${NC}"
    docker network create infrastruktur
    
    # Build the php-fpm image from the php.Dockerfile
    echo -e "${RED}Building php-fpm image...${NC}"
    docker build -t php-fpm -f php.Dockerfile .
    
    # Create the php-fpm container attached to the 'infrastruktur' network
    echo -e "${RED}Creating php-fpm container...${NC}"
    docker run -d --name php-fpm --network infrastruktur --volume ${PWD}/app:/code --volume ${PWD}/conf/log.conf:/usr/local/etc/php-fpm.d/zz-log.conf:ro --volume ${PWD}/conf/php.ini:/usr/local/etc/php/php.ini:ro php-fpm
    
    # waiting for php-fpm container to start
    sleep 10
    # Create the nginx container attached to the 'infrastruktur' network
    echo -e "${RED}Creating nginx container...${NC}"
    docker run -d --name server --network infrastruktur -p 8085:80 --volume ${PWD}/app:/code --volume ${PWD}/conf/default.conf:/etc/nginx/conf.d/default.conf nginx
    
    # Create the mysql container attached to the 'infrastruktur' network
    echo -e "${RED}Creating mysql container...${NC}"
    docker run -d --name database --network infrastruktur -e MYSQL_ROOT_PASSWORD=$(grep -oP 'PASSWORD=\K[^ ]+' .env) -e MYSQL_DATABASE=$(grep -oP 'DATABASE=\K[^ ]+' .env) fanto/mysql-infra:1.0
    
    # Create the redis container attached to the 'infrastruktur' network
    echo -e "${RED}Creating redis container...${NC}"
    docker run -d --name redis --network infrastruktur --volume ${PWD}/app/redis-data:/data redis
fi

# Website deployment completed
echo -e "${RED}Website is now hosted at ${BLUE}http://localhost:8085${NC}"

# Wait for 5 seconds and open the website in the default browser
sleep 5
xdg-open http://localhost:8085 &
