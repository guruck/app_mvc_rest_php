<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="/assets/css/comum.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/icofont.min.css">
    <link rel="stylesheet" href="/assets/css/template.css">
    <script src="/assets/js/jquery.js"></script>
    <title>Projeto BINGO</title>
</head>
<body class="<?= $_COOKIE['menuHide'] ?? ''  ?>">
  <header class="header">
    <div class="logo">
      <i class="icofont-bill mr-2"></i>
      <span class="font-weight-ligth"><i class="icofont-bitcoin-true mr-2">i</i></span>
      <span class="font-weight-bold mx-2">N</span>
      <span class="font-weight-ligth">Guin</span>
      <i class="icofont-billiard-ball ml-3"></i>
    </div>
    <div class="menu-toggle mx-3">
      <i class="icofont-navigation-menu"></i>
    </div>
    <div class="spacer"></div>
    <div class="dropdown">
      <div class="dropdown-button">
        <img class="avatar" src="<?= "http://www.gravatar.com/avatar.php?gravatar_id=" . md5(strtolower(trim($_SESSION['user']->email))) ?>" alt="3x4" >
        <span class="ml-3"><?= $_SESSION['user']->name ?></span>
        <i class="icofont-simple-down mx-2"></i>
      </div>
      <div class="dropdown-content">
        <ul class="nav-list">
          <li class="nav-item">
            <a href="/selfpassword/<?= $_SESSION['user']->id ?>"><i class="icofont-key-hole mr-2"></i>meus dados</a>
          </li>
          <li class="nav-item">
            <a href="/logout"><i class="icofont-logout mr-2"></i>Sair</a>
          </li>
        </ul>
      </div>
    </div>
  
  </header>