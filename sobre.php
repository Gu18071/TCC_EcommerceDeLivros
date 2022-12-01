<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Sobre</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/UserEstilo.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Sobre nós</h3>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-img2.svg" alt="">
      </div>

      <div class="content">
         <h3 style="text-transform:uppercase;">por que nos escolher?</h3>
         <p>Somos a loja de livros com os melhores do preço do mercado e todas as sextas-feiras temos promoções de alguns livros em até 50%!</p>
         <a href="menu.php" class="btn">Nossos livros</a>
      </div>

   </div>

</section>

<!-- about section ends -->

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">Passos simples</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/step-1.png" alt="">
         <h3>Faça seu pedido</h3>
      </div>

      <div class="box">
         <img src="images/step-2.png" alt="">
         <h3>Entrega rápida</h3>
      </div>

      <div class="box">
         <img src="images/step-4.png" alt="">
         <h3>Desfrute do livro</h3>
      </div>

   </div>

</section>

<!-- steps section ends -->


<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>