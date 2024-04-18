<?php
include '../controleur/CoursC.php';
$CoursC = new CoursC();
$tab = $CoursC->listcours();
?>

<center>
    <h1>Liste des cours</h1>
    <a href="ajoutcours.php"> Ajouter un cours</a>

    <center>
        <h1>Liste des cours</h1>
    </center>
    <table border="1" align="center" width="70%">
        <tr>
            <th>id_cours</th>
            <th>nbr_heures</th>
            <th>type_cours</th>
            <th>Nom_enseignant</th>
            <th>Delete</th>
        </tr>
        <tr>

            <?php foreach ($tab as $cours) {
            ?>
                <td> <?php echo $cours['Id_cours']; ?>
                </td>
                <td> <?= $cours['Nbr_heures']; ?>
                </td>
                <td> <?= $cours['Type_cours']; ?>
                </td>
                <td> <?= $cours['Nom_Ens']; ?>
                </td>
                <td><a href="deletecours.php?idd=<?php echo $cours['Id_cours'] ?>">Delete</a></td>

        </tr>
    <?php
            } ?>
    </table>