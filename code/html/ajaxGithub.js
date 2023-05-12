document.getElementById('button-hub').addEventListener('click', loadGitHubUsers);

function loadGitHubUsers() {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'https://api.github.com/users', true);
    xhr.onload = function () {
        let users = JSON.parse(this.responseText);
        let output = '';
        for (let i in users) {
            output +=
                '<div class="user">' +
                '<img src="' + users[i].avatar_url + '" width="70" height="70">' +
                '<ul>' +
                '<li>ID: ' + users[i].id + '</li>' +
                '<li>Name: ' + users[i].login + '</li>' +
                '<li>Url: ' + users[i].url + '</li>' +
                '</ul>' +
                '</div>';
        }
        document.getElementById('users').innerHTML = output;
    }
    xhr.send();
}
