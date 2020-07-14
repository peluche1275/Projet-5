function loadSaveAjax(choix, page) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let response = this.response;

            if (response.fin) {
                document.getElementById("choix1").innerHTML = response.choix1;
                document.getElementById("choix2").innerHTML = response.choix2;
                document.getElementById("message1").innerHTML = "<p>" + response.message1 + "</p>";
                document.getElementById("message2").innerHTML = "<p>" + response.message2 + "</p>";
                document.getElementById("message3").innerHTML = "<p>" + response.message3 + "</p>";
                document.getElementById("message4").innerHTML = "<p>" + response.message4 + "</p>";
                document.getElementById("message5").innerHTML = "<p>" + response.message5 + "</p>";
                if (response.progression < 6 && response.page == 0) {
                    document.getElementById("precedent").style.display = "none";
                }
                else {
                    document.getElementById("precedent").style.display = "block";
                }

                if (response.lastpage == false) {
                    document.getElementById("precedent").style.display = "none";
                }

                if (response.page == 0) {
                    document.getElementById("suivant").style.display = "none";
                }
                else {
                    document.getElementById("suivant").style.display = "block";
                }

                if (response.page > 0) {
                    document.getElementById("choix1").style.display = "none";
                    document.getElementById("choix2").style.display = "none";
                }
                else {
                    document.getElementById("choix1").style.display = "block";
                    document.getElementById("choix2").style.display = "block";
                }
            }
            else {
                document.getElementById("game").innerHTML = "<p>FIN DU QUIZZ</br> VOTRE SCORE EST DE : </br>" + response.score + " POINTS</p>";
            }
        } else if (this.readyState == 4) {
            alert("Une Erreur est survenue...");
        }
    }

    xhr.open("GET", "/async/script.php" + choix + "&page=" + page, true);
    xhr.responseType = "json";
    xhr.send(null);

    return false
};
let page = 0;
let choix = "?banane=1";

loadSaveAjax(choix, page);

document.getElementById("precedent").addEventListener("click", function () {
    page++;
    choix = "?banane=1";
    loadSaveAjax(choix, page);
});

document.getElementById("suivant").addEventListener("click", function () {
    page--;
    choix = "?banane=1";
    loadSaveAjax(choix, page);
});

document.getElementById("choix1").addEventListener("click", function () {
    choix = "?choix=1";
    loadSaveAjax(choix, page);
});

document.getElementById("choix2").addEventListener("click", function () {
    choix = "?choix=2";
    loadSaveAjax(choix, page);
});