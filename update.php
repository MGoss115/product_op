<?php 
    require_once "database.php";

    $id = $_GET['id'] ?? null;
    if (!$id) {
        header('Location: index.php');
        exit;
    }

    $statement = $pdo->prepare('SELECT * FROM products WHERE id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);

    $errors = [];

    $title = $product['title'];
    $price = $product['price'];
    $description = $product['description'];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){ 

      $title = $_POST['title'];
      $description = $_POST['description'];
      $price = $_POST['price'];


      if(!$title){
        $errors[] = 'Product title is required';
      }
      if(!$price){
        $errors[] = 'Product price is required';
      }
      if (!is_dir('images')) {
        mkdir('images');
      }
      if(empty($errors)){
        $image = $_FILES['image'] ?? null;
        $imagePath = $product['image'];

        if ($image && $image['tmp_name']) {
            $imagePath = 'images/' . randomString(8) . '/' . $image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }
        
        $statement = $pdo->prepare("UPDATE products SET title = :title, 
                                        image = :image, 
                                        description = :description, 
                                        price = :price WHERE id = :id");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':id', $id);

        $statement->execute();
        header('Location: index.php');
    
      }
    }  

?>
<?php include_once"views/partials/header.php"; ?>
  <h1>Update Product: <?php echo $product['title'] ?></h1>

  <p>
     <a href="index.php" class="btn btn-light">Go Back</a>
  </p>

<?php require_once './views/partials/products/form.php'; ?>

</body>
</html>