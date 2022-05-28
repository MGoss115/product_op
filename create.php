<?php 
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

    <form>
  <div class="form-group">
    <label>Product Image</label>
    <input type="file" class="form-control">
  </div>
  <div class="form-group">
    <label>Product Title</label>
    <input type="text" class="form-control">
  </div>
  <div class="form-group">
    <label>Product Description</label>
    <textarea class="form-control"></textarea>
  </div>
  <div class="form-group">
    <label>Product Price</label>
    <input type="number" step=".01" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>