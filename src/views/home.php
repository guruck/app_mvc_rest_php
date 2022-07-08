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