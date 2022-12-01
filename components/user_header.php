<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">INStyle</a>

      <nav class="navbar">
         <a href="home.php">Página inicial</a>
         <a href="menu.php">Livros</a>
         <a href="ordens.php">Pedidos</a>
         <a href="sobre.php">Sobre</a>
         <a href="contato.php">Contato</a>
      </nav>

      <div class="icons">
         <?php

             $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
             $count_wishlist_items->execute([$user_id]);
             $total_wishlist_counts = $count_wishlist_items->rowCount();
 
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="procurar.php"><i id="icon-search" class="fas fa-search"></i></a>
         <a href="listaDeDesejos.php"><i id="icon-heart" class="fas fa-heart"></i><span style="font-size:1.6rem;" > <?= $total_wishlist_counts; ?> </span></a>
         <a href="carrinho.php"><i id="icon-bag" class="fa-solid fa-bag-shopping"></i><span style="font-size:1.6rem; "> <?= $total_cart_items; ?> </span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><span>Bem-vindo: </span><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="perfil.php" class="btn">Perfil</a>
            <a href="components/user_logout.php" onclick="return confirm('Deseja mesmo sair?');" class="delete-btn">Sair</a>
         </div>
         <?php
            }else{
         ?>
            <p class="name">Faça o login!</p>
            <a href="login.php" class="btn">Login</a>
         <?php
          }
         ?>
      </div>

   </section>


</header>

