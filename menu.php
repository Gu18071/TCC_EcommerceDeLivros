<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

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

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Categoria de livros</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="css/UserEstilo.css" rel="stylesheet">
</head>

<body>
    <!-- seção header começa  -->
    <header class="header">

   <section class="flex" style="line-height: 1.1; margin-top:0.2px;">

      <a href="home.php" class="logo">INStyle</a>

      <nav class="navbar">
         <a style="margin: 0 1.1rem;"  href="home.php">Página inicial</a>
         <a  style="margin: 0 1.1rem;" href="menu.php">Livros</a>
         <a  style="margin: 0 1.1rem;" href="ordens.php">Pedidos</a>
         <a  style="margin: 0 1.1rem;" href="sobre.php">Sobre</a>
         <a style="margin: 0 1.1rem;"  href="contato.php">Contato</a>
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
         <a style="text-decoration:none;" href="listaDeDesejos.php"><i id="icon-heart" class="fas fa-heart"></i><span style="font-size:1.6rem;" > <?= $total_wishlist_counts; ?> </span></a>
         <a style="text-decoration:none;" href="carrinho.php"><i id="icon-bag" class="fa-solid fa-bag-shopping"></i><span style="font-size:1.6rem;" > <?= $total_cart_items; ?> </span></a>
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
         <p class="name"><?= $fetch_profile['name']; ?></p>
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

    <!-- seção header termina -->

    <!-- Seção filtragem -->
<div class="heading">
   <h3>Categoria de livros</h3>
</div>
<section class="container">
        <div class="row">
            <div class="col-md-3 mt-5">                				
				<div class="list-group">
					<h3>Preço <span style="font-size:1.4rem;">(R$)</span></h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show" style="font-size:1.3rem;" >10 - 200</p>
                    <div id="price_range"></div>
                </div>	
                <br/>			
                <div class="list-group">
					<h3>Categoria</h3>
                    <div>
					<?php

                    $query = "SELECT DISTINCT(category) FROM products WHERE product_status = '0' ORDER BY id DESC";
                    $statement = $conn->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox" style="font-size:1.2rem;">
                        <label><input type="checkbox" class="common_selector category" value="<?php echo $row['category']; ?>"  > <?php echo $row['category']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
            	<br />
                <div class="row filter_data">
                </div>
            </div>
        </div>


 </section>



    
<style>

#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var category = get_filter('category');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, category:category},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:10,
        max:200,
        values:[10, 200],
        step:5,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});

</script>
<script src="js/script.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<?php include 'components/footer.php'; ?>

</body>


</html>