<?php 
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $errors = [];

    $title = '';
    $price = '';
    $description = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){ 

      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $date = date('Y-m-d H:i:s');

      if(!$title){
        $errors[] = 'Product title is required';
      }
      if(!$price){
        $errors[] = 'Product price is required';
      }
      if(empty($errors)){
        $statement = $pdo->prepare("INSERT INTO products (title, image, description, price, create_date)
                        VALUES (:title, :image, :description, :price, :date);
                    ");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', '');
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', $date);
        $statement->execute();
      }

    }

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="app.css" rel="stylesheet"/>
    <title>Products CRUD</title>
</head>
<body>
  <h1>Create New Product</h1>


  <?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
      <?php foreach($errors as $error): ?>
        <div><?php echo $error ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

<form action="" method="post">
  <div class="form-group">
    <label>Product Image</label>
    <input type="file" name="image" class="form-control">
  </div>
  <div class="form-group">
    <label>Product Title</label>
    <input type="text" name="title" class="form-control" value=<?php echo $title?>>
  </div>
  <div class="form-group">
    <label>Product Description</label>
    <textarea name="description" class="form-control" value=<?php echo $description?>></textarea>
  </div>
  <div class="form-group">
    <label>Product Price</label>
    <input type="number" name="price" step=".01" class="form-control" value=<?php echo $price?>>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>