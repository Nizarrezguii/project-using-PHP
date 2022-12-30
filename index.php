<?php
    
    include('config/db_connect.php');

    // sql query
    $sql = 'SELECT title, ingredients, id FROM pizzas';

    //get the result
    $result = mysqli_query($conn, $sql);

    //fetch the result
    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free the result from the memory
    mysqli_free_result($result);

    //close the database connection
    mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php include ('templates/header.php'); ?>
    <div class="tittle mb-5">
        <h2>PHP Course</h2>
    </div>
    <div class="container-fluid row">
    <?php foreach($pizzas as $pizza): ?>
  <div class="col-sm-6 mb-5">
    <div class="card">
    <img src="img/pizza.svg" alt="pizza picture" class="imgPizza">
      <div class="card-body">
        <h5 class="card-title"><?php echo htmlspecialchars($pizza['title']); ?></h5>
        <ol><?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
          <li><?php echo htmlspecialchars($ing) ?></li>
        <?php endforeach; ?>
        </ol>
        <a href="details.php?id= <?php echo $pizza["id"] ?>" class="btn btn-secondary">more info</a>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
    <?php include ('templates/footer.php'); ?>
</body>
</html>