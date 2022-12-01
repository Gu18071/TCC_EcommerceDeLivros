<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['building'].', '.$_POST['town'] .', '. $_POST['city'] .', '. $_POST['state'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'Endereço salvo!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Editar endereço</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/UserEstilo.css">
</head>
<body>
  
<!-- seção header começa  -->
<?php include 'components/user_header.php' ?>
<!-- seção header termina -->

<section class="form-container">

   <form action="" method="post">
      <h3>Editar endereço</h3>
      <input type="text" class="box" placeholder="Número do casa, apto, etc" required maxlength="50" name="building">
      <input type="text" class="box" placeholder="Bairro" required maxlength="50" name="town">
      <input type="text" class="box" placeholder="Cidade" required maxlength="50" name="city">
      <input type="text" class="box" placeholder="Estado" required maxlength="50" name="state">
      <input type="number" class="box" placeholder="Código postal" required max="99999999" min="0" maxlength="8" name="pin_code">
      <input type="submit" value="Salvar endereço" name="submit" class="btn">
      <a href="javascript:history.back()" class="btn">Voltar</a>
   </form>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>