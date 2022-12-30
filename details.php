<?php 
    include('config/db_connect.php');

    if(isset($_POST['delete'])) {
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
        $sql = "DELETE FROM pizzas where id = $id_to_delete";
        if(mysqli_query($conn, $sql)) {
            // success
            header('Location: index.php');
        } else {
            //failed
            echo "error :" . mysqli_error($conn);
        }
    }

    if(isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM pizzas where id = $id";
        $result = mysqli_query($conn, $sql);
        $pizza = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/details.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include ('templates/header.php'); ?>
    <div class="tittle mb-5">
        <h2>Detailed Pizza</h2>
    </div>
    <div class="detaill shadow-sm p-3 mb-5 bg-body rounded">
        <div class="pizza shadow p-3 mb-5 bg-body rounded w-50">
        <?php if($pizza): ?>
            <img src="img/pizza.svg" alt="pizza picture" class="imgPizza">
            <h4>"<?php echo htmlspecialchars($pizza['title']) ?>"</h4>
            <p>Created by : <?php echo htmlspecialchars($pizza['email']) ?></p>
            <p>Created at : <?php echo htmlspecialchars($pizza['created_at']) ?></p>
            <ul class="list">Ingredients :<?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                <li><?php echo htmlspecialchars($ing) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
                <?php endif; ?>
            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
                <button type="submit" name="delete" class="btn btn-danger">DELETE</button>
            </form>
        </div>
    </div>
<?php include ('templates/footer.php'); ?>
</body>
</html>