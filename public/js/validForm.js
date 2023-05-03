let inputmail=document.getElementById("inscription_mail");
let inputtel=document.getElementById("inscription_tel");
let inputlienportfolio=document.getElementById("inscription_lien_portfolio");

var regexmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var regextel = /^0[1-9]([-. ]?[0-9]{2}){4}$/;
var regexlienportfolio = /^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/;

let btnajouter = document.getElementsByClassName("btn btn-primary");
inputmail.addEventListener("change",function(event){
    let mail = event.target.value;
    let spanmail = document.getElementById("erreurmail");

    if (mail.search(regexmail)>-1){
        //console.log("La saisie est correcte")
        spanmail.innerHTML = "";
        btnajouter[0].disabled = false;

    } else {
        spanmail.innerHTML = "Entrez un adresse mail valide";
        btnajouter[0].disabled = true;
    }
});

inputtel.addEventListener("change",function(event) {
    let tel = event.target.value;
    let spantel = document.getElementById("erreurtel");

    if (tel.search(regextel) > -1) {
        spantel.innerHTML = "";
        btnajouter[0].disabled = false;
    } else {
        spantel.innerHTML = "Entrez un numéro de téléphone valide";
        btnajouter[0].disabled = true;
    }
});

inputlienportfolio.addEventListener("change",function(event) {
    let lienportfolio = event.target.value;
    let spanlienportfolio = document.getElementById("erreurlienportfolio");

    if (lienportfolio.search(regexlienportfolio) > -1) {
        spanlienportfolio.innerHTML = "";
        btnajouter[0].disabled = false;
    } else {
        spanlienportfolio.innerHTML = "Entrez un lien valide";
        btnajouter[0].disabled = true;
    }
});