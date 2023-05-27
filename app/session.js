
// implementing an immediately invoked function expression 
(function () {
    function init() {
        //  initialization 
        if (document.getElementById('save-task')) {
            document.getElementById('save-task').addEventListener('click', saveTask);
        }
        if (document.getElementById('edit-task')) {
            document.getElementById('edit-task').addEventListener('click', editTask);
        }
        if (document.getElementsByName("done-boxes").length > 0) {
            console.log('done-boxes');
            checkboxes = document.getElementsByName("done-boxes");
            checkboxes.forEach(element => {
                element.addEventListener('change', doneTask);
            });
        }
    }
    // Call the init function
    init();
})();

function saveTask(e) {
    let xhr = new XMLHttpRequest();
    document.get
    let title = document.getElementById('add-title').value;
    let description = document.getElementById('add-desc').value;
    let assignTo = document.getElementById('add-for').value;
    let priority = document.getElementById('add-priority').value;
    let start = document.getElementById('add-start').value;
    let end = document.getElementById('add-end').value;

    xhr.open('POST', 'server.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.status === 200) {
            console.log(this.responseText);
            if (this.responseText === 'success') {
                alert('Task wurde erfolgreich erstellt');
                window.location.href = 'dashboard.php';
            } else {
                alert('Task konnte nicht erstellt werden, bitte überprüfen Sie Ihre Eingaben');
            }
        }
    }


    // Encode the data as URL-encoded format
    var data = 'title=' + encodeURIComponent(title) +
        '&description=' + encodeURIComponent(description) +
        '&assignTo=' + encodeURIComponent(assignTo) +
        '&priority=' + encodeURIComponent(priority) +
        '&start=' + encodeURIComponent(start) +
        '&end=' + encodeURIComponent(end) +
        '&action=create';


    // send the request
    xhr.send(data);
}

function editTask(e) {
    let xhr = new XMLHttpRequest();

    let input = document.getElementsByName('title-input');
    let id = input[0].getAttribute('id');
    let title = document.getElementsByName('title-input')[0].value;
    let description = document.getElementById('add-desc').value;
    let assignTo = document.getElementById('add-for').value;
    let priority = document.getElementById('add-priority').value;
    let start = document.getElementById('add-start').value;
    let end = document.getElementById('add-end').value;


    xhr.open('POST', 'server.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.status === 200) {
            console.log(this.responseText);
            if (this.responseText === 'success') {
                alert('Task wurde erfolgreich bearbeitet');
                window.location.href = 'dashboard.php';
            } else {
                alert('Task konnte nicht bearbeitet werden, bitte überprüfen Sie Ihre Eingaben');
            }
        }
    }


    // Encode the data as URL-encoded format
    var data = 'title=' + encodeURIComponent(title) +
        '&description=' + encodeURIComponent(description) +
        '&assignTo=' + encodeURIComponent(assignTo) +
        '&priority=' + encodeURIComponent(priority) +
        '&start=' + encodeURIComponent(start) +
        '&end=' + encodeURIComponent(end) +
        '&id=' + encodeURIComponent(id) +
        '&action=edit';

    // send the request
    xhr.send(data);
}

function doneTask(e) {

    let xhr = new XMLHttpRequest();
    let id = e.target.getAttribute('data-id');
    xhr.open('POST', 'server.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.status === 200) {
            console.log(this.responseText);
            if (this.responseText === 'success') {
                window.location.href = 'dashboard.php';
            }
        }
    }

    // Encode the data as URL-encoded format
    var data = 'id=' + encodeURIComponent(id) +
        '&action=delete';

    // send the request
    xhr.send(data);
}
