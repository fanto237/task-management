document.getElementById('button').addEventListener('click', getName);
document.getElementById('getForm').addEventListener('submit', getName);
document.getElementById('postForm').addEventListener('submit', setName);

function getName(e) {
    e.preventDefault();
    let param = document.getElementById('name1').value;
    let xhr = new XMLHttpRequest();

    xhr.open('GET', 'process.php?name=' + param, true);

    xhr.onload = function () {
        console.log(this.responseText);
    }

    xhr.send();
};

function setName(e) {
    e.preventDefault();
    let param = document.getElementById('name2').value;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'process.php?name=' + param, true);
    xhr.onload = function () {
        console.log(this.responseText);
    };

    xhr.send();
}