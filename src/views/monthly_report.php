<main class="content">
  <?php
    $icon = "icofont-ui-calendar";
    $titulo = "Relatorio Mensal: {$_SESSION['user']->name}";
    $subtitulo = "Acompanhe seu saldo de horas!";
    renderTitle($titulo, $subtitulo, $icon);
    include_once(TEMPLATE_PATH . "/messages.php");
  ?>

<div class="card">
  <form action="#" method="post" class="row row-cols-lg-auto g-3">
      <?php if($user->is_admin): ?>
        <div class="col-sm">
          <select name="userId" id="userId" class="form-control m-2 " placeholder="selecione o usuário">
          <?php foreach ($users as $user): ?>
            <option value="<?= $user->id ?>" <?= ($user->id === $userIdSelected) ? 'selected' : '' ?> ><?= $user->name ?></option>
          <?php endforeach ?>
          </select>
        </div>
      <?php endif?>

      <div class="col-sm">
        <select name="period" id="period" class="form-control m-2" placeholder="selecione o período">
        <?php foreach ($periods as $key => $value): ?>
          <option value="<?= $key ?>" <?= ($key === $selectedPeriod) ? 'selected' : '' ?> ><?= $value ?></option>
        <?php endforeach ?>
        </select>
      </div>
      <div class="col-sm">
        <button class="btn btn-md m-2 btn-primary">
          <i class="icofont-search"></i>
        </button>
      </div>  
  </form>
</div>

  <div class="card">
    <div class="card-header ">
      <div class="row ">
        <span class="record col-sm-8">Horas trabalhadas: <?= "{$sumOfWorkedTime}/{$expectedTime}" ?></span>
        <span class="record col-sm-4 <?= ($sign==='+') ? 'text-primary' : 'text-danger' ?>">Saldo: <?= "{$sign}{$balance}" ?></span>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
          <th>Dia</th>
          <th>Entrada1</th>
          <th>Entrada2</th>
          <th>Saida1</th>
          <th>Saida2</th>
          <th>Saldo</th>
        </thead>
        <tbody>
    <?php foreach ($report as $key => $value): ?>
          <tr>
            <td><?= formatDateWithLocale($value->work_date,'%A, %d/%m/%y') ?></td>
            <td><?= $value->time1 ?></td>
            <td><?= $value->time2 ?></td>
            <td><?= $value->time3 ?></td>
            <td><?= $value->time4 ?></td>
            <td><?= $value->getBalance() ?></td>
          </tr>
    <?php endforeach ?>
        <tr class='table-primary'>
          <td>Total</td>
          <td><?= $sumOfWorkedTime ?></td>
          <td colspan=2></td>
          <td>Saldo</td>
          <td> <?= "{$sign}{$balance}" ?> </td>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex justify-content-center">

    </div>
  </div>
  
</main>