<main class="content">
  <h2>Tela para TESTES, <?= $_SESSION['user']->name; ?></h2>
  <p><?php include_once(TEMPLATE_PATH . '/messages.php'); ?>
  <?php 

    if(is_array($resultado)){
      echo gettype($resultado), ":<br/>";
      foreach ($resultado as $value) {
        var_dump($value);
        echo '<br/>';
      }
    }
    elseif(is_object($resultado)){
      echo get_class($resultado), ":<br/>";
      var_dump($resultado);
      foreach ($resultado as $key => $value) {
        echo "{$key} => {$value} <br/>";
      }
    }
    elseif(is_string($resultado)){
      echo ($resultado == 'phpinfo()') ? phpinfo() : $resultado;
    }else{
      var_dump($resultado);
    }
    
  ?>
  <?php foreach ($menus as $menu ): ?>
    <?php if($user->is_admin >= $menu->elevate): ?>
      <li class="nav-item">
        <a href="<?= $menu->page ?>">
          <i class="<?= $menu->ico ?> mr-2"></i>
          <?= $menu->name ?>
        </a>
      </li>
    <?php endif ?>
  <?php endforeach ?>

  <?php $tipo_usuario = $_SESSION['tipo_usuario'] ?>
  <div class="form-group">
      <label class="col-sm-2 col-sm-2 control-label"><b>Tipo de usuario</b></label>
      <div class="col-sm-3">
        <select class="form-control grey" id="tipo_usuario" name="tipo_usuario" value="<?php echo $tipo_usuario['tipo_usuario']; ?>">
          <option value="">Seleccione</option>
          <option value="Oficina" <?php if($tipo_usuario=="Oficina"){ echo "selected='selected'";}?> >Oficina tecnica</option>
          <option value="Personal">Personal</option>
          <option value="Administrador">Administrador</option>
        </select>
        <span class="error">* <?php echo $tipo_usuarioErr; ?></span>
      </div>
    </div>
    <div id="get"></div>
    <div id="post"></div>
  </p>

  <div class="titulo">API do PHP - Arquivo Download</div>

  <?php
  
  print_r($_FILES);
  print_r($_POST);
  print_r($_GET);

  $arquivos = $_SESSION['arquivos'] ?? [];


  if (isset($_FILES) && isset($_FILES['userfile'])){
    $uploaddir = './assets/uploads/';
    $ext = strtolower(substr($_FILES['userfile']['name'],-4));
    $new_name = $_SESSION['user']->name . $ext;
    // $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    $uploadfile = $uploaddir . $new_name;
    $tmp = $_FILES['userfile']['tmp_name'];
    echo '<pre>';
    if (move_uploaded_file($tmp, $uploadfile)) {
      echo "Arquivo válido e enviado com sucesso.\n";
      $arquivos[] = $_FILES['userfile']['name'];
      $_SESSION['arquivos'] = $arquivos;
    } else {
        echo "Possível ataque de upload de arquivo!\n";
    }

    echo 'Aqui está mais informações de debug:';
    print_r($_FILES);

    print "</pre>";
  }

?>

<!-- O tipo de encoding de dados, enctype, DEVE ser especificado abaixo -->
<form enctype="multipart/form-data" action="#" method="POST">
    <!-- MAX_FILE_SIZE deve preceder o campo input -->
    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
    <!-- O Nome do elemento input determina o nome da array $_FILES -->
    Enviar esse arquivo: <input name="userfile" type="file" accept="image/*"/>
    <input type="submit" value="Enviar arquivo" />
</form>
<ul>
  <?php foreach($arquivos as $arqSessao): ?>
    <?php if(stripos($arqSessao,'.jpg')>0): ?>
      <li>
        <img src="/assets/uploads/<?= $arqSessao ?>" alt="<?= $arqSessao ?>" height="220"/>
      </li>
    <?php endif ?>
  <?php endforeach ?>
</ul>

</main>

<script>
  function exibirResultado(id,dados){
    const texto = JSON.stringify(dados)
    document.getElementById(id).innerHTML = texto
  }

  $('#tipo_usuario').change(
    function(){
      alert('selected: ' + $(this).val());
    }
  );

// (function(){
  
//   const tipoUser = document.querySelector('#tipo_usuario');
//   tipoUser.onchange = function (e){
//     console.log(e);
//     console.log(e.target.value);
    
//   }

// })();

</script>