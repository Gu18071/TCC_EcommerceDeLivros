<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $pages = $_POST['pages'];
   $pages = filter_var($pages, FILTER_SANITIZE_STRING);
   $description = $_POST['description'];
   $description = filter_var($description, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, pages = ?, description = ?, category = ?, price = ? WHERE id = ?");
   $update_product->execute([$name, $pages, $description, $category, $price, $pid]);

   $message[] = 'Livro aditado!';


   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'Tamanho de imagem muito grande!';
      }else{
         $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
         $update_image->execute([$image, $pid]);
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('../uploaded_img/'.$old_image);
         $message[] = 'Capa editada!';
      }
   }

}
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Editar livro</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="../css/adminEstilo.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- seção de editar livros começa  -->

<section class="update-product">

   <h1 class="heading">Editar livro</h1>

   <?php
      $update_id = $_GET['update'];
      $show_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $show_products->execute([$update_id]);
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <span>Editar nome</span>
      <input type="text" required placeholder="Nome do livro" name="name" maxlength="100" class="box" value="<?= $fetch_products['name']; ?>">
      <span>Editar páginas</span>
      <input type="number" min="0" max="9999999999" required placeholder="Número de páginas" name="pages" class="box" value="<?= $fetch_products['pages']; ?>">
      <span>Editar descrição</span>
      <input type="text" required placeholder="Descrição do livro" name="description" maxlength="500" class="box" value="<?= $fetch_products['description']; ?>">
      <span>Editar preço</span>
      <input type="number" min="0" max="9999999999" required placeholder="preço do livro" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_products['price']; ?>">
      <span>Editar categoria</span>
      <select name="category" class="box" required>
         <option hidden selected value="<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></option>
         <option value="Ação">Ação</option>
         <option value="Aventura">Aventura</option>
         <option value="Fantasia">Fantasia</option>
         <option value="Infantil">Infantil</option>
         <option value="Ficção científica">Ficção científica</option>
         <option value="Misterio">Mistério</option>
         <option value="Nficcao">Não ficção</option>
         <option value="Policial">Policial</option>
         <option value="Romance">Romance</option>
         <option value="Suspense">Suspense</option>
         <option value="Terror">Terror</option>
      </select>
      <span>Editar capa</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="Editar" class="btn" name="update">
         <a href="livros.php" class="option-btn">Voltar</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">Sem livros adicionados!</p>';
      }
   ?>

</section>

<!-- seção de editar livros termina -->


<script src="../js/admin_script.js"></script>

</body>
</html>