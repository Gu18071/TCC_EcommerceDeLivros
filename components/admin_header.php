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

      <a href="dashboard.php" class="logo">Instyle<span> admin</span></a>

      <nav class="navbar">
         <a href="dashboard.php">Dashboard</a>
         <a href="livros.php">Livros</a>
         <a href="pedidos_feitos.php">Pedidos</a>
         <a href="admin_contas.php">Admins</a>
         <a href="contas_usuarios.php">usuários</a>
         <a href="mensagens.php">Mensagens</a>
      </nav>

      <div class="icons">
         <a href="Procurar.php"><i class="fas fa-search"></i></a>
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><span>Nome: </span><?= $fetch_profile['name']; ?></p>
         <a href="editar_perfil.php" class="btn">Editar perfil</a>
         <div class="flex-btn">
            <a href="admin_login.php" class="option-btn">Login</a>
            <a href="registrar_admin.php" class="option-btn">Registar</a>
         </div>
         <a href="../components/admin_logout.php" onclick="return confirm('Deseja mesmo sair?');" class="delete-btn">Sair</a>
      </div>

   </section>

</header>