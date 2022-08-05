<aside class="sidebar">
  <nav class="menu mt-3">
    <ul class="nav-list">
    <?php foreach ($menus as $menu ): ?>
      <?php if( $menu->ativo): ?>
        <!-- ($user->is_admin >= $menu->elevate) && -->
        <li class="nav-item">
          <a href="/<?= $menu->page ?>">
            <i class="<?= $menu->ico ?> mr-2"></i>
            <?= $menu->name ?>
          </a>
        </li>
      <?php endif ?>
    <?php endforeach ?>
    </ul>
  </nav>
  <div class="sidebar-widgets">
    <div class="sidebar-widget">
      <i class="icon icofont-hour-glass text-primary"></i>
      <div class="info">
        <span class="main text-primary" <?= $activeClock === 'workedInterval' ? 'active-clock="true"' : '' ?>>
          <?= $workedInterval ?>
        </span>
        <span class="lable text-mute">
          Horas Trabalhadas
        </span>
      </div>
    </div>
    <div class="division my-3"></div>
    <div class="sidebar-widget">
      <i class="icon icofont-ui-alarm text-danger"></i>
      <div class="info">
        <span class="main text-danger" <?= $activeClock === 'exitTime' ? 'active-clock="true"' : '' ?>>
          <?= $exitTime ?>
        </span>
        <span class="lable text-mute">
          Horas de Saída
        </span>
      </div>
    </div>
  </div>
</aside>