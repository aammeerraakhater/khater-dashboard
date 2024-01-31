function changeStatus(id, status) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("serviceStatus").innerHTML = this.responseText;
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
function changetechnician(id, technician) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("technician").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "sendStatus.php?id=" + id + "&technician=" + technician, true);
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
