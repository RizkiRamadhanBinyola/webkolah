
<?php

$id_user = $_GET['id_user'];

// connect to the database and select the publisher
require_once 'koneksi/config.php';

// construct the delete statement
$sql = 'DELETE FROM user
        WHERE id_user = :id_user';

// prepare the statement for execution
$statement = $conn->prepare($sql);
$statement->bindParam(':id_user', $id_user, PDO::PARAM_INT);

// execute the statement
if ($statement->execute()) {
    
    header('Location: data-user.php');
}
?>
