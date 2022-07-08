<main class="content">
  <?php
    $icon = "icofont-navigation-menu";
    $titulo = "Cadastro de Menus";
    $subtitulo = "Crie e atualize o Menu";
    include(TEMPLATE_PATH . "/titulo.php");
    include(TEMPLATE_PATH . "/messages.php");
    //print_r($resultado);
  ?>
  <form action="update" method="post">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="name">Nome</label>
        <input type="text" id="name" name="name" placeholder="Informe o nome"
          class="form-control <?= $errors['name'] ? 'is-invalid' : '' ?>"
          value="<?= $name ?>">
        <div class="invalid-feedback">
          <?= $errors['name'] ?>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="ico">Icone <i class="<?= $ico ?>"></i></label>
        <input type="text" id="ico" name="ico" placeholder="Informe o icone"
          class="form-control <?= $errors['ico'] ? 'is-invalid' : '' ?>"
          value="<?= $ico ?>">
        <div class="invalid-feedback">
          <?= $errors['ico'] ?>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="page">Pagina</label>
        <input type="text" id="page" name="page" placeholder="Informe a pagina"
          class="form-control <?= $errors['page'] ? 'is-invalid' : '' ?>" value="<?= $page ?>">
        <div class="invalid-feedback">
          <?= $errors['page'] ?>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="updated">Ultima atualização</label>
        <input type="date" id="updated" name="updated"
          class="form-control <?= $errors['updated'] ? 'is-invalid' : '' ?>"
          value="<?= $updated ?>" disabled>
        <div class="invalid-feedback">
          <?= $errors['updated'] ?>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="elevate">Administrador?</label>
        <input type="checkbox" id="elevate" name="elevate"
          class="form-control <?= $errors['elevate'] ? 'is-invalid' : '' ?>"
          <?= $elevate ? 'checked' : '' ?>>
        <div class="invalid-feedback">
          <?= $errors['elevate'] ?>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="ativo">Ativo?</label>
        <input type="checkbox" id="ativo" name="ativo"
          class="form-control <?= $errors['ativo'] ? 'is-invalid' : '' ?>"
          <?= $ativo ? 'checked' : '' ?>>
        <div class="invalid-feedback">
          <?= $errors['ativo'] ?>
        </div>
      </div>
    </div>
    <div>
      <button class="btn btn-primary btn-lg">Salvar</button>
      <!-- <a href="/menu" class="btn btn-secondary btn-lg">Cancelar</a> -->
      <a href="/batata" class="btn btn-secondary btn-lg">Cancelar</a>
    </div>
  </form>
</main>