<?php

include('db.php');

if (isset($_POST['save_task'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $image = file_get_contents($_FILES['image']['tmp_name']);

  $query = "INSERT INTO task(title, description) VALUES ('$title', '$description', 'image')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  if (isset($_FILES['imagen'])) {
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']); // Leer el contenido binario de la imagen

    $sql = "INSERT INTO tabla_imagenes (nombre, imagen_binaria) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sb", $_FILES['imagen']['name'], $imagen);

    if ($stmt->execute()) {
        echo "Imagen guardada correctamente en la base de datos.";
    } else {
        echo "Error al guardar la imagen: " . $stmt->error;
    }

        $stmt->close();
    } else {
        echo "No se ha seleccionado ninguna imagen.";
      }

  $_SESSION['message'] = ' La nota se guardo con exito';
  $_SESSION['message_type'] = 'success';
  header('Location: index.php');

}

?>