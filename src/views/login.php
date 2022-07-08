<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/css/comum.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Projeto Bingo</title>
</head>
<body>
  <form class="form-login" action="login" method="post">
    <div class="login-card card">
      <div class="card-header">
        <i class="icofont-bill mr-2"></i>
        <span class="font-weight-ligth"><i class="icofont-bitcoin-true mr-2">i</i></span>
        <span class="font-weight-bold mx-2">N</span>
        <span class="font-weight-ligth">Guin</span>
        <i class="icofont-billiard-ball ml-3"></i>
      </div>
      <div class="card-body">
      <?php include_once(TEMPLATE_PATH . '/messages.php'); ?>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="text" name="email" id="email" class="form-control <?= $errors['email'] ? 'is-invalid' : '' ?>" placeholder="Informe o e-mail" value="<?= isset($email) ? $email : '' ?>" autofocus/>
          <div class="invalid-feedback"><?= $errors['email'] ?></div>
        </div>
        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" name="password" id="password" class="form-control <?= $errors['password'] ? 'is-invalid' : '' ?>" />
          <div class="invalid-feedback"><?= $errors['password'] ?></div>
        </div>
      </div>
      <div class="card-footer">
        <div class="botao">
          <button class="btn btn-lg btn-primary">Entrar</button>
        </div>
      </div>
    </div>
  </form>
  <br/>
  
</body>
</html>
