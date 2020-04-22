function connectToAjax(choix) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = this.response;

            document.getElementById("phpmessages").style.display = "none";
            document.getElementById("choix1").innerHTML = response.choix1;
            document.getElementById("choix2").innerHTML = response.choix2;
            document.getElementById("otages").innerHTML = "Otages : " + response.otages;
            document.getElementById("soldats").innerHTML = "Soldats : " + response.soldats;
            document.getElementById("argents").innerHTML = "Argents : " + response.argents;
            document.getElementById("message1").innerHTML = "<p>" + response.message1 + "</p>";
            document.getElementById("message2").innerHTML = "<p>" + response.message2 + "</p>";
            document.getElementById("message3").innerHTML = "<p>" + response.message3 + "</p>";
            document.getElementById("message4").innerHTML = "<p>" + response.message4 + "</p>";
            document.getElementById("message5").innerHTML = "<p>" + response.message5 + "</p>";

        } else if (this.readyState == 4) {
            alert("Une Erreur est survenue...");
        }
    }

    xhr.open("GET", "/async/script.php?choix=" + choix, true);
    xhr.responseType = "json";
    xhr.send(null);

    return false
};

document.getElementById("choix1").addEventListener("click", function () {
    var choix = "1";
    connectToAjax(choix);
});

document.getElementById("choix2").addEventListener("click", function () {
    var choix = "2";
    connectToAjax(choix);
});

document.getElementsByClassName("pagination").addEventListener("click", function(){



});