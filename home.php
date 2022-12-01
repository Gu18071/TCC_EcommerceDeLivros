<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';
include 'components/listaDeDesejos_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Página inicial</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/UserEstilo.css">
</head>
<body>

<!-- seção header começa  -->
<?php include 'components/user_header.php'; ?>
<!-- seção header termina -->

<!-- slider seção começa  -->

<section class="home" id="home">

    <div class="row">

        <div class="content">
            <h3>COMPRE LIVROS ONLINE</h3>
            <p>faça seu pedido agora mesmo!</p>
            <a href="menu.php" class="btn">Ver livros</a>
        </div>

        <div class="swiper books-slider">
            <div class="swiper-wrapper">
                <a href="#"  class="swiper-slide"><img style="height:22rem;" src="images/livro1.png" alt=""></a>
                <a href="#"  class="swiper-slide"><img style="height:22rem;" src="images/livro2.png" alt=""></a>
                <a href="#"  class="swiper-slide"><img style="height:22rem;" src="images/livro3.png" alt=""></a>
                <a href="#"  class="swiper-slide"><img style="height:22rem;" src="images/livro4.png" alt=""></a>
                <a href="#"  class="swiper-slide"><img style="height:22rem;" src="images/livro5.png" alt=""></a>
                <a href="#"  class="swiper-slide"><img style="height:22rem;" src="images/livro6.png" alt=""></a>
            </div>
            <img src="images/stand.png" class="stand" style="height:24rem;" alt="">
        </div>

    </div>

</section>

<!-- slider seção termina  -->

<!-- seção de categoria começa -->

<section class="category">

   <h1 class="cheading">Categorias</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="categoria.php?category=Terror" class="swiper-slide slide">
      <img src="images/cat1.png" alt="">
      <h3>Terror</h3>
   </a>

   <a href="categoria.php?category=Romance" class="swiper-slide slide">
      <img src="images/cat2.png" alt="">
      <h3>Romance</h3>
   </a>

   <a href="categoria.php?category=Aventura" class="swiper-slide slide">
      <img src="images/cat3.png" alt="">
      <h3>Aventura</h3>
   </a>

   <a href="categoria.php?category=Infantil" class="swiper-slide slide">
      <img src="images/cat4.png" alt="">
      <h3>Infantil</h3>
   </a>

   <a href="categoria.php?category=Suspense" class="swiper-slide slide">
      <img src="images/cat5.png" alt="">
      <h3>Suspense</h3>
   </a>

   <a href="categoria.php?category=Policial" class="swiper-slide slide">
      <img src="images/cat6.png" alt="">
      <h3>Policial</h3>
   </a>

   <a href="categoria.php?category=Não ficção" class="swiper-slide slide">
      <img src="images/cat7.png" alt="">
      <h3>Não ficção</h3>
   </a>

   <a href="categoria.php?category=Misterio" class="swiper-slide slide">
      <img src="images/cat8.png" alt="">
      <h3>Mistério</h3>
   </a>

   <a href="categoria.php?category=Ficção científica" class="swiper-slide slide">
      <img src="images/cat9.png" alt="">
      <h3>Ficção científica</h3>
   </a>

   <a href="categoria.php?category=Fantasia" class="swiper-slide slide">
      <img src="images/cat10.png" alt="">
      <h3>Fantasia</h3>
   </a>

   <a href="categoria.php?category=Acao" class="swiper-slide slide">
      <img src="images/cat11.png" alt="">
      <h3>Ação</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>



<!-- seção de categoria termina -->

<section class="products">
<h1 class="divisor"> <span>Livros</span> </h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 9");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
         <a href="detalhes.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <div class="cardimage">
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         </div>
         <div class="conteudocard">
         <a href="categoria.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><?= $fetch_products['price']; ?><span> R$</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
         <button type="submit" name="add_to_cart" class="cart-btn">Adicionar ao carrinho 🛒</button>
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">Sem livros adicionados!</p>';
         }
      ?>

   </div>
   <div class="more-btn">
      <a href="menu.php" class="btn">Ver mais</a>
   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   autoplay: {
     delay: 4500,
     disableOnInteraction: false,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});


</script>


</body>
</html>