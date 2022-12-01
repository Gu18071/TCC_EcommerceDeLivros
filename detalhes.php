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
   <title>Detalhes do livro</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/UserEstilo.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section>

   <h1 class="title">Detalhes</h1>

   <?php
      $pid = $_GET['pid'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$pid]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
      <div class = "card-detalhess">
      <div class = "card-det">
        <!-- card left -->
        <div class = "product-imgs">
          <div class = "img-display">
            <div class = "img-showcase">
              <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
            </div>
          </div>
        </div>
        <!-- card right -->
        <div class = "product-content">
          <h2 class = "product-title"><?= $fetch_products['name']; ?></h2>
          <div class = "product-price">
            <p class = "new-price">Preço: <span><?= $fetch_products['price']; ?> R$</span></p>
          </div>
          </br>
            </br>
          </br>
          <div class = "product-detail">
            <h2>Descrição: </h2>
            <p><?= $fetch_products['description']; ?></p>
            </br>
              <p><b>Categoria: </b><span><?= $fetch_products['category']; ?></span></p>
              <p><b>Número de páginas: </b><span><?= $fetch_products['pages']; ?></span></p>
          </div>
          </br>
          <div class = "purchase-info">
          <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
            <button type="submit" name="add_to_cart" class = "btnd">
              Add ao carrinho <i class = "fas fa-shopping-cart"></i>
            </button>
            <button type="submit" name="add_to_wishlist" class = "btnd"><i class="fa-sharp fa-solid fa-heart"></i></button>
          </div>
        </div>
      </div>
    </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">Não tem livros adicionados!</p>';
      }
   ?>

</section>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>