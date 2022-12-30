
<?php 

    include('config/db_connect.php');

    $errors = array('email' => '', 'title' => '', 'ingredient' => '');
    if(isset($_POST['submit'])){
		
		// check email
		if(empty($_POST['email'])){
			$errors["email"] = 'An email is required <br />';
		} else{
			$email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Must enter a valid email adress." . '<br>';
            }
		}

		// check title
		if(empty($_POST['title'])){
			$errors["title"] = 'A title is required <br />';
		} else{
            $title = $_POST['title'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
                $errors["title"] = "Must enter a valid title." . '<br>';
            }
		}

		// check ingredients
		if(empty($_POST['ingredient'])){
			$errors["ingredient"] = 'At least one ingredient is required <br />';
		} else{
            $ingredient = $_POST['ingredient'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredient)) {
                $errors["ingredient"] = "Must enter a valid ingredient." . '<br>';
            }
		}

        if(array_filter($errors)) {
            // echo errors in form
        } else {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $ingredient = mysqli_real_escape_string($conn, $_POST['ingredient']);

            //sql insert
            $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredient')";

            // save to database and check
            if(mysqli_query($conn, $sql)) {
                //succes
                header('Location: index.php');
            } else {
                //errors
                echo 'query error : ' . mysqli_error($conn);
            }
        }

	} // end POST check
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php include ('templates/header.php'); ?>
<section class=" row">
    <form action="add.php" method="POST" class="col-lg-12">
        <h4 class="tittle">"Pizza add"</h4>
    <div class="row d-block ms-5">
        <div class="col-lg-4 mb-3 mt-4">
            <label>Enter you mail :</label> <br>
            <div class="text-danger"><?php echo $errors['email'] ?></div>
            <input type="text" class="mt-4" name="email">
        </div>
        <div class="col-lg-4 mb-3">
            <label>Pizza title :</label> <br>
            <div class="text-danger"><?php echo $errors['title'] ?></div>
            <input type="text" class=" mt-4" name="title">
        </div>
        <div class="col-lg-4 mb-3">
            <label>Ingredients :</label> <br>
            <div class="text-danger"><?php echo $errors['ingredient']?></div>
            <input type="text" class="mt-4" name="ingredient">
        </div>
        <div class="mb-5">
            <button type="submit" name="submit" value="Submit" class="btn btn-dark">Submit</button>
        </div>
    </div>
    </form>
    </section>
    <?php include ('templates/footer.php'); ?>
</body>
</html>