<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'Mensagem já enviada!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'Mensagem enviada com sucesso!';

   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contato</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/UserEstilo.css">
</head>
<body>
   
<!-- seção header começa  -->
<?php include 'components/user_header.php'; ?>
<!-- seção header termina -->

<div class="heading">
   <h3>Entre em contato</h3>
</div>

<!-- seção contato começa  -->

<section class="contact">

   <div class="row">
      <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58425.66330779274!2d-53.34016926467164!3d-23.761498403342262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94f2d6aad88f12b7%3A0x62e741a44bc7bfc7!2sUmuarama%2C%20State%20of%20Paran%C3%A1!5e0!3m2!1sen!2sbr!4v1667080109334!5m2!1sen!2sbr" allowfullscreen="" loading="lazy"></iframe>
      <form action="" method="post">
         <h3>No que podemos ajudar?</h3>
         <input type="text" name="name" maxlength="50" class="box" placeholder="Nome" required>
         <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="Número com ddd" required maxlength="10">
         <input type="email" name="email" maxlength="50" class="box" placeholder="Email" required>
         <textarea name="msg" class="box" required placeholder="Mensagem" maxlength="500" cols="30" rows="10"></textarea>
         <input type="submit" value="Enviar" name="send" class="btn">
      </form>

   </div>

</section>

<!-- seção contato termina -->

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>