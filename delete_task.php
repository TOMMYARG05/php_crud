<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM task WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Operacion Fallida");
    }

    $_SESSION['message'] = 'Nota Eliminada con Exito';
    $_SESSION['mesage_type'] = 'danger';

    header('Location: index.php');
} 
?>