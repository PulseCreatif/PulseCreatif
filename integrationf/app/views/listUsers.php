<?php
require_once(__DIR__.'/../../app/controllers/UserC.php');
require_once(__DIR__.'/../../app/models/User.php');

$userC = new UserController();
$list = $userC->listUsers();
?>
<html>

<head></head>

<body>
    <table border="1" align="center" width="70%">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Role</th>
            <th>Password</th>
        </tr>
        <?php
        foreach ($list as $user) {
        ?>
            <tr>
                <td><?= $user['USER_ID']; ?></td>
                <td><?= $user['USER_NAME']; ?></td>
                <td><?= $user['USER_PHONENUM']; ?></td>
                <td><?= $user['USER_EMAIL']; ?></td>
                <td><?= $user['USER_ROLE']; ?></td>
                <td><?= $user['USER_PASSWORD']; ?></td>
                
                <td align="center">
                    <form method="POST" action="updateUser.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value=<?PHP echo $user['USER_ID']; ?> name="id">
                    </form>
                </td>
                <td>
                    <a href="deleteUser.php?id=<?php echo $user['USER_ID']; ?>">Delete</a>
                </td>
            </tr>
            
        <?php
        }
        ?>
    </table>
</body>

</html>
