<?php
function validateInputs($idCours, $dateLimite, $fichier, $commentaire, $etat) {
    // Validate ID_COURS as an integer
    if (filter_var($idCours, FILTER_VALIDATE_INT) === false) {
        return false;  // ID_COURS is not an integer
    }

    // Validate DATE_LIMITE as a date in the format YYYY-MM-DD
    $date = DateTime::createFromFormat('Y-m-d', $dateLimite);
    if (!$date || $date->format('Y-m-d') !== $dateLimite) {
        return false;  // DATE_LIMITE is not a valid date or not in the correct format
    }

    // Validate FICHIER by checking its type and size
    if (isset($fichier["fileToUpload"])) {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];  // Adjust as needed
        $fileSizeLimit = 5 * 1024 * 1024;  // 5 MB size limit
        $fileExtension = strtolower(pathinfo($fichier["fileToUpload"]["name"], PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedTypes)) {
            return false;  // FICHIER has an invalid extension
        }

        if ($fichier["fileToUpload"]["size"] > $fileSizeLimit) {
            return false;  // FICHIER exceeds the size limit
        }
    } else {
        return false;  // No file uploaded
    }

    // Validate COMMENTAIRE to ensure it does not exceed 12500 characters
    if (strlen($commentaire) > 12500) {
        return false;  // COMMENTAIRE exceeds the maximum length
    }

    // Validate ETAT as an integer within the range 0 to 3
    if (filter_var($etat, FILTER_VALIDATE_INT) === false || $etat < 0 || $etat > 3) {
        return false;  // ETAT is not within the valid range
    }

    // If all validations pass
    return true;
}


function validateEvaluation($id_depot,$id_enseignant,$note,$commentaire,$reponse_etud) {
    // Validate ID_EVALUATION, ID_DEPOT, and ID_ENSEIGNANT as integers
    if (!filter_var($id_depot, FILTER_VALIDATE_INT) ||
        !filter_var($id_enseignant, FILTER_VALIDATE_INT)) {
        return false;
    }

    // Validate NOTE as a floating-point number
    if (!filter_var($note, FILTER_VALIDATE_FLOAT)) {
        return false;
    }

    // Check if NOTE is in a valid range (for example, between 0 and 20)
    $note = floatval($note);
    if ($note < 0 || $note > 20) {
        return false;
    }

    // Validate COMMENTAIRE to ensure it does not exceed 12500 characters
    if (strlen($commentaire) > 20) {
        return false;
    }

    // Validate REPONSE_ETUD to ensure it does not exceed 12500 characters
    if (strlen($reponse_etud) > 12500) {
        return false;
    }

    // All validations passed
    return true;
}
