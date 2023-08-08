<?php error_reporting(0);
include('db.php') ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Note keeper</title>
</head>
<body>
    <?php include('includes/header.php') ?>
        <br>
        <h1>Caja de Tareas</h1>
        <br>
        <!--------mensage de guardado------>
        <div class="card" style="width: 25rem;">
                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-<?= $_SESSION['message_type']?>" role="alert">
                        <?= $_SESSION['message']?>
                    </div>
                <?php session_unset(); } ?>
        <!----Añadir datos con formulario--------->             
                <form action="save_task.php" method="POST">
                        <div class="form-group">
                            <h5 class="card-title">Nota</h5>
                            <input type="text" name="title" class="form-control" placeholder="Titulo de la Nota" autofocus></input>
                        </div>
                        <br>
                        <div class="form-group">
                            <textarea name="description" class="form-control" rows="2" placeholder="descripcion" ></textarea>
                        </div>
                        <hr>
                        <div class="form-group">
                            <h4>Subir Imagen</h4>
                            <input class="btn btn-success" type="file" name="imagen" accept="image/*"></input>
                            <br>
                            <input class="btn btn-info" type="submit" value="Subir Imagen">
                        </div>
                        <br>
                        <input type="submit" class="btn btn-success btn-block" style="width:100%;" rows="2" name="save_task" value="Guardar Nota"></input>
                </form>
        </div>
        <!--------Tabla de datos------------>
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Fecha de Creacion</th>
                        <th>Imagen Subida</th>
                        <th>Opciones</th>
                    <tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT * FROM task";
                    $result_tasks = mysqli_query($conn, $query);    

                    while($row = mysqli_fetch_assoc($result_tasks)) { ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['create_at']; ?></td>
                        <td><?php echo $row['image'] ;?></td>
                        <td>
                        <a href="edit_task.php?id=<?php echo $row['id']?>" class="btn btn-secondary">Actualizar
                            <i class="fas fa-marker"></i>
                        </a>
                        <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">Eliminar
                            <i class="far fa-trash-alt"></i>
                        </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</html>