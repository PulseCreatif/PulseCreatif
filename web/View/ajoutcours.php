<?php
include '../controleur/CoursC.php';
include '../Model/cours.php';
$error = "";
$cours = NULL;
$CoursC = new CoursC();
if (isset($_POST['Nbr_heures']) && isset($_POST['Type_cours']) && isset($_POST['Nom_Ens'])) {
    if (!empty($_POST['Nbr_heures']) && !empty($_POST['Type_cours']) && !empty($_POST['Nom_Ens'])) {
        $cours = new cours($_POST['Nbr_heures'], $_POST['Type_cours'], $_POST['Nom_Ens']);
        $CoursC->addcours($cours);
        header('location:listcours.php');
    } else {
        $error = "Missing information";
    }
}
?>

<html>

<body>
    <form action="" method="POST">
        Nbr_heures: <input type="number" name="Nbr_heures">
        Type_cours: <input type="number" name="Type_cours">
        Nom_Ens: <input type="text" name="Nom_Ens">
        <input type="submit" value="Save">
        <input type="reset" value="Annuler">
    </form>
</body>

</html>