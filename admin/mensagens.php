<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:mensagens.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Mensagens</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="../css/adminEstilo.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- seção mensagens começa  -->

<section class="messages">

   <h1 class="heading">Mensagens</h1>

   <div class="box-container">

   <?php
      $select_messages = $conn->prepare("SELECT * FROM `messages`");
      $select_messages->execute();
      if($select_messages->rowCount() > 0){
         while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Nome : <span><?= $fetch_messages['name']; ?></span> </p>
      <p> Número : <span><?= $fetch_messages['number']; ?></span> </p>
      <p> Email : <span><?= $fetch_messages['email']; ?></span> </p>
      <p> Mensagem : <span><?= $fetch_messages['message']; ?></span> </p>
      <a href="mensagens.php?delete=<?= $fetch_messages['id']; ?>" class="delete-btn" onclick="return confirm('Deletar mensagem?');">Deletar</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Não há mensagens!</p>';
      }
   ?>

   </div>

</section>

<!-- seção mensagens termina -->

<script src="../js/admin_script.js"></script>

</body>
</html>