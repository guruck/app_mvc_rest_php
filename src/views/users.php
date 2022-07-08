<main class="content">
  <?php
    $icon = "icofont-user";
    $titulo = "Cadastro de Contas";
    $subtitulo = "Mantenha os dados dos usuários atualizados";
    include(TEMPLATE_PATH . "/titulo.php");
    include(TEMPLATE_PATH . "/messages.php");
    
  ?>
  <a class="btn btn-lg btn-primary mb-3" href="accounts/new">Novo Usuário</a>
  <table class="table table-bordered table-striped table-hover">
    <thead>
      <th>Nome</th>
      <th>Email</th>
      <th>Data de Criação</th>
      <th>Data de Desativação</th>
      <th>Ações</th>
    </thead>
    <tbody>
      <?php foreach($users as $user): ?>
        <tr>
          <td><?= $user->name ?></td>
          <td><?= $user->email ?></td>
          <td><?= $user->start_date ?></td>
          <td><?= $user->end_date ?></td>
          <td>
            <a href="accounts/<?= $user->id ?>/edit" 
              class="btn btn-warning rounded-circle mr-2">
              <i class="icofont-edit"></i>
            </a>
            <a href="accounts/<?= $user->id ?>/delete"
              class="btn btn-danger rounded-circle">
              <i class="icofont-trash"></i>
            </a>
          </td>
        </tr>
      <?php endforeach?>
    </tbody>
  </table>
  
</main>