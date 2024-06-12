function incQte(elt) { // Augmente la quantité d'un produit de 1
    elt.value = parseInt(elt.value) + 1;
}

function inc10Qte(elt) { // Augmente la quantité d'un produit de 10
    elt.value = parseInt(elt.value) + 10;
}

function inc100Qte(elt) { // Augmente la quantité d'un produit de 100
    elt.value = parseInt(elt.value) + 100;
}

function decQte(elt) { // Diminue la quantité d'un produit de 1, mais ne descend pas en dessous de 1
    if (elt.value - 1 < 1) {
        elt.value = 1;
    } else {
        elt.value = parseInt(elt.value) - 1;
    }
}

function dec10Qte(elt) { // Diminue la quantité d'un produit de 10, mais ne descend pas en dessous de 1
    if (elt.value - 10 < 1) {
        elt.value = 1;
    } else {
        elt.value = parseInt(elt.value) - 10;
    }
}

function dec100Qte(elt) { // Diminue la quantité d'un produit de 100, mais ne descend pas en dessous de 1
    if (elt.value - 100 < 1) {
        elt.value = 1;
    } else {
        elt.value = parseInt(elt.value) - 100;
    }
}

function validRefFormat(input) { // Valide le format d'une entrée de référence de produit
    var modele = /[0-9]{4}/; // Définit le modèle à utiliser
    var saisie = input.value; // Récupère la valeur de l'entrée
    var msg = document.getElementById("msgErreur"); // Récupère l'élément du message d'erreur

    if (modele.test(saisie) === false) { // Si la valeur de l'entrée ne correspond pas au modèle
        msg.innerHTML = "<b> Erreur de saisie : </b>la référence produit doit être de format numérique "; // Écrit un message d'erreur dans la zone de message d'erreur
        msg.style.color = "#D80600"; // Change la couleur du texte du message d'erreur

        input.value = ""; // Efface le champ d'entrée
        input.style.fontWeight = "normal"; // Réinitialise le poids de la police de l'entrée
        setTimeout(function () {
            input.focus(); // Donne le focus à l'entrée pour une nouvelle saisie
        }, 10);
    } else { // Si la valeur de l'entrée correspond au modèle
        msg.innerHTML = ""; // Efface le message d'erreur dans la zone de message d'erreur
        msg.style.color = "#000000"; // Réinitialise la couleur du texte du message d'erreur
        msg.style.backgroundColor = "white"; // Réinitialise la couleur de fond du message d'erreur
    }
}
