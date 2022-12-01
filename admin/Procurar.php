<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pesquisar livros</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" type="text/css" href="../css/adminEstilo.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include '../components/admin_header.php' ?>
<!-- header section ends -->

<!-- search form section starts  -->

<section class="search-form">
   <form method="post" action="">
      <input type="text" name="search_box" placeholder="pesquise aqui..." class="box">
      <button type="submit" name="search_btn" class="fas fa-search"></button>
   </form>
</section>

<!-- search form section ends -->


<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
         if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
         $search_box = $_POST['search_box'];
         $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
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
    }
   ?>

   </div>

</section>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
