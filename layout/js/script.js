function changeStatus(elementID, id, status) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(elementID).innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "sendStatus.php?id=" + id + "&serviceStatus=" + status, true);
    xmlhttp.send();
}
function changeNotes(id, note) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("note").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "sendStatus.php?id=" + id + "&Notes=" + note, true);
    xmlhttp.send();
}
function changetechnician(elementID, id, technician) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(elementID).innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "sendStatus.php?id=" + id + "&technician=" + technician, true);
    xmlhttp.send();
}
function confirmOrder(elementID, id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {

    };
    if (document.getElementById(elementID).checked) {
        state = 1;
    } else {
        state = 0;
    }
    xmlhttp.open("GET", "sendStatus.php?orderID=" + id + "&state=" + state, true);
    xmlhttp.send();

}
function addAlternitave(city, id, showedEleID, showedEleName) {
    var element = document.getElementById(id);
    if (city == 'أخرى') {
        element.classList.remove("hidden");
        document.getElementById(showedEleID).name = showedEleName;
        document.getElementById(showedEleID).required = true;
    } else {
        element.classList.add("hidden");
        document.getElementById(showedEleID).name = '';
        document.getElementById(showedEleID).required = false;

    }
}
// function shareXlsx(q) {
//     var xmldownloadrequest = new XMLHttpRequest();
//     xmldownloadrequest.open("GET", "saveXlsx.php?q=" + q, true);
//     xmldownloadrequest.send();
// }
function capture() {
    const captureElement = document.querySelector('#capture') // Select the element you want to capture. Select the <body> element to capture full page.
    html2canvas(captureElement)
        .then(canvas => {
            canvas.style.display = 'none'
            document.body.appendChild(canvas)
            return canvas
        })
        .then(canvas => {
            const image = canvas.toDataURL('image/png')
            const a = document.createElement('a')
            a.setAttribute('download', 'my-image.png')
            a.setAttribute('href', image)
            a.click()
            canvas.remove()
        })
}

// const btn = document.getElementById('captureBtn')
// btn.addEventListener('click', capture)
