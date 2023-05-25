document.getElementById('save-task').addEventListener('click', saveTask);

function saveTask(e) {
    let title = document.getElementById('add-title').value;
    let description = document.getElementById('add-desc').value;
    let assignTo = document.getElementById('add-for').value;
    let priority = document.getElementById('add-priority').value;
    let start = document.getElementById('add-start').value;
    let end = document.getElementById('add-end').value;
    console.log('the title is:' + title);
    console.log('the description is:' + description);
    console.log('the assignTo is:' + assignTo);
    console.log('the priority is:' + priority);
    console.log('the start is:' + start);
    console.log('the end is:' + end);

    xhr.open('POST', 'server.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // xhr.onload = function () {
    //     if (this.status === 200) {
    //         let redirectTo = this.responseText
    //         console.log(redirectTo);
    //         window.location.href = redirectTo;
    //     }
    // }

    // Encode the data as URL-encoded format
    var data = 'title=' + encodeURIComponent(title) +
        '&description=' + encodeURIComponent(description) +
        '&assignTo=' + encodeURIComponent(assignTo) +
        '&priority=' + encodeURIComponent(priority) +
        '&start=' + encodeURIComponent(start) +
        '&end=' + encodeURIComponent(end);


    // send the request
    xhr.send(data);

}