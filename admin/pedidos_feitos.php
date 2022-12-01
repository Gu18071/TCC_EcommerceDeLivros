<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update_payment'])){

   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $update_status = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_status->execute([$payment_status, $order_id]);
   $message[] = 'Status do pagamento atualizado!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:pedidos_feitos.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Pedidos</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="../css/adminEstilo.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- seção de pedidos feitos começa  -->

<section class="placed-orders">

   <h1 class="heading">Pedidos</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Id de usuário : <span><?= $fetch_orders['user_id']; ?></span> </p>
      <p> Pedido feito em : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> Nome : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> Número : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> Endereço : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> Livros totais : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> Preço total : <span><?= $fetch_orders['total_price']; ?>R$</span> </p>
      <p> Método de pagamento : <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="POST">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="drop-down">
            <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="pendente">pendente</option>
            <option value="completo">completo</option>
         </select>
         <div class="flex-btn">
            <input type="submit" value="Atualizar" class="btn" name="update_payment">
            <a href="pedidos_feitos.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Deletar este pedido?');">Deletar</a>
         </div>
      </form>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">Sem pedidos!</p>';
   }
   ?>

   </div>

</section>

<!-- seção de pedidos feitos termina -->

<script src="../js/admin_script.js"></script>

</body>
</html>