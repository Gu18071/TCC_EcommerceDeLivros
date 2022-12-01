<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_contas.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin - Admins</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" type="text/css" href="../css/adminEstilo.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- seção de admin contas começa  -->

<section class="accounts">

   <h1 class="heading">admins</h1>

   <div class="box-container">

   <div class="box">
      <p>Registrar novo admin</p>
      <a href="registrar_admin.php" class="option-btn">Registrar</a>
   </div>

   <?php
      $select_account = $conn->prepare("SELECT * FROM `admin`");
      $select_account->execute();
      if($select_account->rowCount() > 0){
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <p> admin id : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> usuário : <span><?= $fetch_accounts['name']; ?></span> </p>
      <div class="flex-btn">
         <a href="admin_contas.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn" onclick="return confirm('Deletar essa conta?');">Deletar</a>
         <?php
            if($fetch_accounts['id'] == $admin_id){
               echo '<a href="editar_perfil.php" class="option-btn">Editar</a>';
            }
         ?>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">Sem contas disponíveis</p>';
   }
   ?>

   </div>

</section>

<!-- seção de admin contas termina -->




















<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>