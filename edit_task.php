<?php error_reporting(0);
include("db.php");
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Note Kepper</title>
    </head>
    <body>
    
        <?php 
        $title = '';
        $description= '';
        $image= '';

        if  (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM task WHERE id=$id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $title = $row['title'];
            $description = $row['description'];
            $image = $row['image'];
        }
        }

        if (isset($_POST['update'])) {
        $id = $_GET['id'];
        $title= $_POST['title'];
        $description = $_POST['description'];
        $image = $_POST['image'];

        $query = "UPDATE task set title = '$title', description = '$description', image = 'image' WHERE id=$id";
        mysqli_query($conn, $query);
        $_SESSION['message'] = 'Task Updated Successfully';
        $_SESSION['message_type'] = 'warning';
        header('Location: index.php');
        }

        ?>
        <?php include('includes/header.php'); ?>
        <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
            <div class="card card-body">
            <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <div class="form-group">
                <input name="title" type="text" class="form-control" value="<?php echo $title; ?>" placeholder="Update Title">
                </div>
                <br>
                <div class="form-group">
                <textarea name="description" class="form-control" cols="30" rows="10"><?php echo $description;?></textarea>
                </div>
                <br>
                <button href="index.php" type="button" class="btn btn-success" style="width:100%;" name="update"> Actualizar
                </button>
            </form>
            </div>
            </div>
        </div>
        </div>
        <?php include('includes/footer.php'); ?>
            
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</html>