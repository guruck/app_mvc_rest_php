<main class="content">
  <?php
    $icon = "icofont-check-alt";
    $titulo = "Registrar Ponto: {$_SESSION['user']->name}";
    $subtitulo = "mantenha seu ponto consistente!";
    renderTitle($titulo, $subtitulo, $icon);
    include_once(TEMPLATE_PATH . "/messages.php");
  ?>
  <div class="card">
    <div class="card-header">
      <h3><?= $today ?></h3>
      <p class="mb-0">Os batimentos efetuados hoje</p>
    </div>
    <div class="card-body">
      <div class="d-flex m-5 justify-content-around">
        <span class="record">Entrada 1: <?= is_null($workingHours->time1) ? '---' : $workingHours->time1 ?></span>
        <span class="record">Saída 1: <?= is_null($workingHours->time2) ? '---' : $workingHours->time2 ?></span>
      </div>
      <div class="d-flex m-5 justify-content-around">
        <span class="record">Entrada 2: <?= is_null($workingHours->time3) ? '---' : $workingHours->time3 ?></span>
        <span class="record">Saída 2: <?= is_null($workingHours->time4) ? '---' : $workingHours->time4 ?></span>
      </div>
    </div>
    <div class="card-footer d-flex justify-content-center">
      <a href="innout.php" class="btn btn-success btn-lg">
        <i class="icofont-check mr-1"></i>
        Bater o Ponto
      </a>
    </div>
  </div>
  
  <form class="mt-5" action="innout.php" method="post">
  <div class="input-group no-border">
    <input type="text" name="forcedTime" id="forcedTime" class="form-control" placeholder="digite o horario para simular 00:00:00"> 
    <button class="btn btn-md btn-danger ml-3">Simular Ponto</button>
  </div>
  </form>
</main>