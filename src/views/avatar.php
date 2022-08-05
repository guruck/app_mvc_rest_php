<main class="content">
  <h2>Tela para alterar AVATAR, <?= $_SESSION['user']->name; ?></h2>
  <p><?php include_once(TEMPLATE_PATH . '/messages.php'); ?>


  <?php
  
  $arquivos = $_SESSION['arquivos'] ?? [];
  $defautlAvatar= '/assets/img/user_avatar.png';

  if (isset($_FILES) && isset($_FILES['userfile'])){
    $uploaddir = './assets/uploads/';
    $ext = strtolower(substr($_FILES['userfile']['name'],-4));
    $new_name = $_SESSION['user']->name . $ext;
    // $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    $uploadfile = $uploaddir . $new_name;
    $tmp = $_FILES['userfile']['tmp_name'];
    echo '<pre>';
    // if (file_exists($uploadfile)){
    //   // $new_name = $_SESSION['user']->name . $ext;
    //   $userAvatar = $defautlAvatar;
    //   if(rename($uploadfile, 'bkp.x'.$uploadfile.'x.bkp')) {
    //     echo "movido \n";
    //   }
    // }
    if (move_uploaded_file($tmp, $uploadfile)) {
      echo "Arquivo válido e enviado com sucesso.\n";    
    } else {
      echo "Possível ataque de upload de arquivo!\n";
    }

    // echo 'Aqui está mais informações de debug:';
    // print_r($_FILES);

    print "</pre>";
  }

?>

<!-- O tipo de encoding de dados, enctype, DEVE ser especificado abaixo -->
<form enctype="multipart/form-data" action="#" method="POST">
    <!-- MAX_FILE_SIZE deve preceder o campo input -->
    <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    <!-- O Nome do elemento input determina o nome da array $_FILES -->
    Enviar esse arquivo: <input name="userfile" type="file" accept="image/*"/>
    <input type="submit" value="Enviar arquivo" />
</form>


</main>
