<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $pages = $_POST['pages'];
   $pages = filter_var($pages, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'O nome desse livro já existe!';
   }else{
      if($image_size > 200000000000){
         $message[] = 'Tamanho de imagem muito grande';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `products`(name, category, pages, description, price, image) VALUES(?,?,?,?,?,?)");
         $insert_product->execute([$name, $category, $pages, $description, $price, $image]);

         $message[] = 'Novo livro adicionado!';
      }

   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:livros.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Livros</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="../css/adminEstilo.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- seção de add livros começa  -->

<section  class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Adicionar livros</h3>
      <input type="text" required placeholder="Nome do livro" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="Número de páginas" name="pages" class="box">
      <input type="text" required placeholder="Descrição do livro" name="description" maxlength="500" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="Preço do livro" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <select name="category" class="box" required>
         <option value="" disabled selected>Categoria</option>
         <option value="Ação">Ação</option>
         <option value="Aventura">Aventura</option>
         <option value="Fantasia">Fantasia</option>
         <option value="Infantil">Infantil</option>
         <option value="Ficção científica">Ficção científica</option>
         <option value="Mistério">Mistério</option>
         <option value="Não ficção">Não ficção</option>
         <option value="Policial">Policial</option>
         <option value="Romance">Romance</option>
         <option value="Suspense">Suspense</option>
         <option value="Terror">Terror</option>
      </select>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input id="livrosmin" type="submit" value="Adicionar livro" name="add_product" class="btn">
   </form>

</section>

<!-- seção de add livros termina -->

<!-- seção de mostrar livros começa  -->



<section   class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM `products`");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="flex">
         <div class="price"><span></span><?= $fetch_products['price']; ?><span> R$</span></div>
         <div class="price" style="margin:auto;"><span></span><?= $fetch_products['pages']; ?><span> páginas</span></div>
         <div class="category"><?= $fetch_products['category']; ?></div>
      </div>
      <div class="name" style="text-align:center;" ><?= $fetch_products['name']; ?></div>
      <div class="flex-btn">
         <a href="editar_livros.php?update=<?= $fetch_products['id']; ?>" class="option-btn">Editar</a>
         <a href="livros.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Deletar este livro?');">Deletar</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Sem livros adicionados!</p>';
      }
   ?>

   </div>

</section>


<!-- seção de mostrar livros termina -->

<script src="../js/admin_script.js"></script>

</body>
</html>