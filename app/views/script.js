// Fonction pour vérifier si une chaîne contient uniquement des lettres majuscules, des lettres minuscules et des chiffres de 1 à 8
function estValide(chaine) {
    // Expression régulière pour vérifier si la chaîne contient uniquement des lettres majuscules, des lettres minuscules et des chiffres de 1 à 8
    var regex = /^[A-Za-z0-9]+$/;
    return regex.test(chaine);
}

// Fonction pour valider le formulaire
function validerFormulaire() {
    var id = document.getElementById('id').value;
    var password = document.getElementById('password').value;

    // Vérifier si les champs respectent les critères
    if (!estValide(id)) {
        alert("L'ID doit contenir uniquement des lettres majuscules, des lettres minuscules et des chiffres de 1 à 8.");
        return false;
    }

    if (!estValide(password)) {
        alert("Le mot de passe doit contenir uniquement des lettres majuscules, des lettres minuscules et des chiffres de 1 à 8.");
        return false;
    }

    // Si les champs sont valides, soumettre le formulaire
    alert("Formulaire soumis avec succès !");
    return true;
}

// Ajouter un gestionnaire d'événement au formulaire pour appeler la fonction de validation lors de la soumission
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêcher la soumission du formulaire par défaut
    validerFormulaire();
});

// Fonction pour valider le formulaire et rediriger en fonction de l'ID
function validerFormulaire() {
    var id = document.getElementById('id').value;
    var password = document.getElementById('password').value;

    // Vérifier si les champs respectent les critères
    if (!estValide(id)) {
        alert("L'ID doit contenir uniquement des lettres majuscules, des lettres minuscules et des chiffres de 1 à 8.");
        return false;
    }

    if (!estValide(password)) {
        alert("Le mot de passe doit contenir uniquement des lettres majuscules, des lettres minuscules et des chiffres de 1 à 8.");
        return false;
    }


    // PREMIUM TEMPORAIRE
    if (id === "221JMT9090") {
        window.location.href = 'espEtud.php';
    }
    // Vérifier l'ID pour redirection
    else if (id.includes('JFT') || id.includes('JMT')) {
        window.location.href = 'espEtud.php';
    }
    else if (id.includes('PRF')) {
        window.location.href = 'espProf.php';
    }
    else {
        alert("ID non reconnu.");
    }

    return true; // Peut-être inutile, car les redirections interrompent le flux d'exécution
}


document.addEventListener("DOMContentLoaded", function() {
    var addButton = document.querySelector('.rendre-devoir .main-button.icon-button');
    var fileInput = document.querySelector('.rendre-devoir button[type="file"]');
    var messageBox = document.querySelector('.rendre-devoir h4');

    addButton.addEventListener('click', function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length === 0) {
            messageBox.textContent = "Aucun fichier sélectionné.";
        } else {
            messageBox.textContent = "Fichier sélectionné : " + fileInput.files[0].name;
        }
    });
});
