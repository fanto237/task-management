// create an event listener
document.getElementById('button').addEventListener('click', loadText);

function loadText() {
    // create the XHR Object
    const xhr = new XMLHttpRequest();

    console.log('The ready state is ' + xhr.readyState);

    // open the request
    // open takes 3 arguments - method (GET, POST, PUT, DELETE), url/file, async
    xhr.open('GET', 'sample.txt', true);

    console.log('The ready state is ' + xhr.readyState);

    // OPTIONAL - used for spinners/loaders
    xhr.onprogress = function () {
        console.log('The ready state is ' + xhr.readyState);
    }

    xhr.onerror = function () {
        console.log('Error');
    }




    // onload method won't run unless the xhr is ready ( readystate = 4 ) and status is 200
    xhr.onload = function () {
        if (this.status === 200) {
            console.log(this.responseText);
            document.getElementById('message').innerHTML = this.responseText;
        }
        else if (this.status === 404){
            console.log('the doc is not found');
        }
    }
    
    
    console.log('The ready state is ' + xhr.readyState);

    // ready state values 
    // 0: request not initialized
    // 1: server connection established
    // 2: request received
    // 3: processing request
    // 4: request finished and response is ready

    // xhr.onreadystatechange = function () {
    //     if (this.readyState === 4 && this.status === 200) {
    //         console.log(this.responseText);
    //         document.getElementById('message').innerHTML = this.responseText;
    //     }
    // }

    // send the request
    xhr.send();

}