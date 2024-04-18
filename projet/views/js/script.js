// Fonction pour vérifier si une chaîne contient uniquement des lettres et des chiffres de 1 à 8
function estValide(chaine) {
    var regex = /^[A-Za-z1-8]+$/;
    return regex.test(chaine);
}

// Fonction pour valider le formulaire de connexion
function validerFormulaire() {
    var id = document.getElementById('id').value;
    var password = document.getElementById('password').value;

    // Vérifier si les champs respectent les critères
    if (!estValide(id)) {
        alert("L'ID doit contenir uniquement des lettres et des chiffres de 1 à 8.");
        return false;
    }

    if (!estValide(password)) {
        alert("Le mot de passe doit contenir uniquement des lettres et des chiffres de 1 à 8.");
        return false;
    }

    // Vérifier l'ID pour redirection
    if (id.includes('JFT') || id.includes('JMT')) {
        window.location.href = 'espEtud.html';
    } else if (id.includes('PRF')) {
        window.location.href = 'espProf.html';
    } else {
        alert("ID non reconnu.");
        return false;
    }
}

// Ajouter les gestionnaires d'événements après le chargement du document
document.addEventListener("DOMContentLoaded", function() {
    // Ajouter un gestionnaire d'événement au formulaire pour appeler la fonction de validation lors de la soumission
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Empêcher la soumission du formulaire par défaut
        validerFormulaire();
    });

    // Autres gestionnaires d'événements peuvent être ajoutés ici
});


// Lier la fonction de validation au bouton "Ajouter le rendu"
const boutonAjouterRendu = document.getElementById("boutonAjouterRendu");
boutonAjouterRendu.addEventListener("click", function(event) {
    event.preventDefault();
    validerFormulaire();
});

const matiereForm = document.getElementById('matiereForm');
const rendusDiv = document.getElementById('rendus');

matiereForm.addEventListener('submit', (event) => {
    event.preventDefault(); // Empêche la soumission du formulaire

    const matiereChoisie = document.getElementById('matiere').value;

    // Affichage d'un message de chargement
    rendusDiv.innerHTML = `<p>Chargement des rendus...</p>`;

    // Fonction pour afficher les rendus
    const afficherRendus = (rendus) => {
        rendusDiv.innerHTML = ''; // Vider la zone d'affichage

        if (rendus.length === 0) {
            rendusDiv.innerHTML = `<p>Aucun rendu trouvé pour cette matière.</p>`;
            return;
        }
    };
});


const addButton = document.querySelector('.rendre-devoir .main-button.icon-button');
const fileInput = document.querySelector('.rendre-devoir button[type="file"]');
const messageBox = document.querySelector('.rendre-devoir h4');

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

const buttons = document.querySelectorAll('.crud-buttons a');

buttons.forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault(); 
        const destination = button.getAttribute('href');
        window.location.href = destination;
    });
});

const form = document.getElementById("addAssignmentForm");
  
form.addEventListener("submit", function(event) {
    event.preventDefault();

    const idDepot = document.getElementById("id_depot").value;
    const idCours = document.getElementById("id_cours").value;
    const dateLimite = document.getElementById("date_limite").value;
    const fichier = document.getElementById("fichier").files[0]; // Récupérer le fichier
    const commentaire = document.getElementById("commentaire").value;
    const etat = document.getElementById("etat").value;

    // Validation des champs
    if (!idDepot || !idCours || !dateLimite || !fichier || !fichier.name || !commentaire || !etat) {
        alert("Veuillez remplir tous les champs.");
        return false;
    }

    if (!estValideID(idDepot)) {
        alert("Le champ ID du depot doit contenir uniquement des chiffres.");
        return false;
    }

    if (!estValideID(idCours)) {
        alert("Le champ ID du cours doit contenir uniquement des chiffres.");
        return false;
    }

    if (!estValideCommentaire(commentaire)) {
        alert("Le champ commentaire doit contenir uniquement des lettres et des chiffres.");
        return false;
    }

    if (!estValideDateLimite(dateLimite)) {
        alert("La date limite doit être au format YYYY-MM-DD et postérieure à la date du jour.");
        return false;
    }

    if (!estValideFichier(fichier)) {
        alert("Le fichier doit être au format PDF, DOCX ou XLSX et ne pas dépasser 5 Mo." );
        return false;
    }
});
  
// Fonction pour vérifier si une chaîne contient uniquement des chiffres de 0 à 9
function estValideID(chaine) {
    const regex = /^[0-9]+$/;
    return regex.test(chaine);
}

// Fonction pour vérifier si une chaîne contient uniquement des lettres et des chiffres
function estValideCommentaire(chaine) {
    const regex = /^[A-Za-z0-9]+$/;
    return regex.test(chaine);
}
    
// Fonction pour vérifier si la date est au format YYYY-MM-DD et postérieure à la date du jour
function estValideDateLimite(dateLimite) {
    const regex = /^\d{4}-\d{1,2}-\d{1,2}$/;
    if (!regex.test(dateLimite)) {
        return false;
    }

    const dateLimiteDate = new Date(dateLimite);
    const today = new Date();
    return dateLimiteDate >= today;
}

// Fonction pour vérifier si le fichier est au format PDF, DOCX ou XLSX et ne dépasse pas 100 Mo
function estValideFichier(fichier) {
    const allowedExtensions = ["pdf", "docx", "xlsx"];
    const extension = fichier.name.split(".").pop().toLowerCase();
    if (!allowedExtensions.includes(extension)) {
        return false;
    }

    if (fichier.size > 100 * 1024 * 1024) { // 5 Mo en octets
        return false;
    }
    return true;
}
