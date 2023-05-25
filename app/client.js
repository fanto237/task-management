let username;
let password;
let activity;


// implementing an immediately invoked function expression 
(function () {
    function init() {
        //  initialization 
        // console.log("i am the initiator bro !")
        if (document.getElementById('login-form')) {
            // console.log("login form got found")
            document.getElementById('login-form').addEventListener('submit', login);
        }
        if (document.getElementById('register-form')) {
            // console.log("regiter form got found")
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

    xhr.open('POST', 'server.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.status === 200) {
            let redirectTo = this.responseText
            console.log(redirectTo);
            window.location.href = redirectTo;
        }
    }

    // Encode the data as URL-encoded format
    var data = 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password);
    xhr.send(data);
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
        if (this.status === 200) {
            let redirectTo = this.responseText === 'dashboard.php' ? "dashboard.php" : "index.php?error=Benutzername oder Passwort falsch";
            console.log(this.responseText)
            window.location.href = redirectTo;
        }
    }

    // Encode the data as URL-encoded format
    var data = 'username=' + encodeURIComponent(username) + '&password=' + encodeURIComponent(password) + '&status=' + encodeURIComponent(activity);
    xhr.send(data);
}

function handleErrorMessage() {
    let name = document.getElementById('username-feedback');
    let pass = document.getElementById('password-feedback');
    name.innerHTML = username === "" ? "Ein Name is notwendig" : "";
    pass.innerHTML = password === "" ? "Ein Passwort ist notwendig" : "";
}