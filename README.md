# Task Management

Building a task management web app using the `LEMP` Stack, `Javascript` and `Redis` for caching.

## Table of Contents
- [Task Management](#task-management)
  - [Table of Contents](#table-of-contents)
  - [Project Structure](#project-structure)
  - [Installation](#installation)
    - [Prerequisites](#prerequisites)
    - [Getting Started](#getting-started)
  - [Usage](#usage)
  - [Contributing](#contributing)
  - [License](#license)

## Project Structure

```
project-root/
├── app/
│   └── ...
│
├── conf/
│   └── ...
│
├── report/
│   └── ...
├── README.md
└── ...
```

- `app/`: Contains the app code
- `conf/`: Contains **Nginx** configuration
- `report/` Contains my latex report for the project (can be ignored).
- `README.md`: This README file.

## Installation

### Prerequisites

Before you begin, make sure you habe `Docker` installed, since the app will runs in container.
- Docker can be download here: [Docker](https://www.docker.com/products/docker-desktop/)
- Or if you are on a linux based os, run the following command:
```
sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

### Getting Started
- You can now go ahead and clone the project by running: `git clone https://github.com/fantosama/task-management.git`
- rename ***sample.env*** in ***.env***: `mv sample.env .env`
- edit the ***.env*** with your own value
- And then either run: `./start.sh` or `docker-compose -up`


## Usage

The app allows following actions :
- *create an account*
- *login with existing account*
- *add new task*
- *assign tasks to existing user*
- *remove task*
- *update task*

## Contributing

Feel free to clone the repo and add new features 😊.

## License

This project is licensed under the [MIT License](LICENSE).