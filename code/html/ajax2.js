document.getElementById('button2').addEventListener('click', loadUsers);
document.getElementById('button1').addEventListener('click', loadUser);

function loadUsers() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'jsons/users.json', true);

    xhr.onload = function () {
        if (this.status === 200) {
            let users = JSON.parse(this.responseText);
            let output = '';

            for (let i in users) {
                output += '<ul>' +
                    '<li>ID: ' + users[i].id + '</li>' +
                    '<li>Name: ' + users[i].name + '</li>' +
                    '<li>Email: ' + users[i].email + '</li>' +
                    '</ul>';
            }

            document.getElementById('users').innerHTML = output;
        }
        console.log(this.responseText);

    }

    xhr.send();
}


function loadUser() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'jsons/user.json', true);

    xhr.onload = function () {
        if (this.status === 200) {
            let user = JSON.parse(this.responseText);
            let output = '';
            output += '<ul>' +
                '<li>ID: ' + user.id + '</li>' +
                '<li>Name: ' + user.name + '</li>' +
                '<li>Email: ' + user.email + '</li>' +
                '</ul>';
            document.getElementById('user').innerHTML = output;
        }
        console.log(this.responseText);

    }

    xhr.send();
}