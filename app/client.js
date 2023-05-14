let username;
let password;
let activity;


// implementing an immediately invoked function expression 
(function () {
    function init() {
        //  initialization 
        console.log("i am the initiator bro !")
        if (document.getElementById('login-form')) {
            console.log("login form got found")
            document.getElementById('login-form').addEventListener('submit', login);
        }
        if (document.getElementById('register-form')) {
            console.log("regiter form got found")
            document.getElementById('register-form').addEventListener('submit', register);
        }
    }
    // Call the init function
    init();
})();

function register(e) {
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    username = document.getElementById('username').value;
    password = document.getElementById('password').value;
    if (username === "" || password === "") {
        handleErrorMessage()
        return;
    }

    console.log(username + " " + password)
    xhr.open('POST', 'server.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        console.log(this.responseText);
    }

    // Encode the data as URL-encoded format
    var data = 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password);
    xhr.send(data);
    window.location.href = "login.php";
}

function login(e) {
    e.preventDefault();
    let xhr = new XMLHttpRequest();
    username = document.getElementById('username').value;
    password = document.getElementById('password').value;
    activity = 'online'

    if (username === "" || password === "") {
        handleErrorMessage()
        return;
    }

    xhr.open('POST', 'server.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        console.log(this.responseText);
    }

    // Encode the data as URL-encoded format
    var data = 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password) + '&status=' + encodeURIComponent(activity);
    xhr.send(data);
}

function handleErrorMessage() {
    let name = document.getElementById('username-feedback');
    let pass = document.getElementById('password-feedback');
    if (username === "")
        name.innerHTML = "Ein Name is notwendig";
    else
        name.innerHTML = ""


    if (password === "")
        pass.innerHTML = "Ein Passwort ist notwendig";
    else
        pass.innerHTML = "";
}