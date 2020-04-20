let id = document.getElementById("idhidden").value;

document.getElementById("choix1").addEventListener("click", function (e) {
    e.preventDefault();

    var choix1 = "1";

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = this.response;
            console.log(response.choix1);

            document.getElementById("phpmessages").style.display = "none";
            document.getElementById("choix1").innerHTML = response.choix1;
            document.getElementById("choix2").innerHTML = response.choix2;
            document.getElementById("otages").innerHTML = "otages : " + response.otages;
            document.getElementById("soldats").innerHTML = "soldats : " + response.soldats;
            document.getElementById("argents").innerHTML = "argents : " + response.argents;
            document.getElementById("message5").innerHTML = "<p>" + response.message5 + "</p>";
            document.getElementById("message4").innerHTML = "<p>" + response.message4 + "</p>";
            document.getElementById("message3").innerHTML = "<p>" + response.message3 + "</p>";
            document.getElementById("message2").innerHTML = "<p>" + response.message2 + "</p>";
            document.getElementById("message1").innerHTML = "<p>" + response.message1 + "</p>";
            

        } else if (this.readyState == 4) {
            alert("Une Erreur est survenue...");
        }
    }

    xhr.open("GET", "/async/script.php?choix=" + choix1 + "&id= " + id, true);
    xhr.responseType = "json";
    xhr.send(null);

    return false
});


//------------------------------------------------- //
document.getElementById("choix2").addEventListener("click", function (e) {
    e.preventDefault();

    var choix2 = "2";

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = this.response;
            console.log(response.choix2);

            document.getElementById("phpmessages").style.display = "none";
            document.getElementById("choix1").innerHTML = response.choix1;
            document.getElementById("choix2").innerHTML = response.choix2;
            document.getElementById("otages").innerHTML = "otages : " + response.otages;
            document.getElementById("soldats").innerHTML = "soldats : " + response.soldats;
            document.getElementById("argents").innerHTML = "argents : " + response.argents;
            document.getElementById("message5").innerHTML = "<p>" + response.message5 + "</p>";
            document.getElementById("message4").innerHTML = "<p>" + response.message4 + "</p>";
            document.getElementById("message3").innerHTML = "<p>" + response.message3 + "</p>";
            document.getElementById("message2").innerHTML = "<p>" + response.message2 + "</p>";
            document.getElementById("message1").innerHTML = "<p>" + response.message1 + "</p>";

        } else if (this.readyState == 4) {
            alert("Une Erreur est survenue...");
        }
    }

    xhr.open("GET", "/async/script.php?choix=" + choix2 + "&id= " + id, true);
    xhr.responseType = "json";
    xhr.send(null);

    return false
});