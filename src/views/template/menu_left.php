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
 
</aside>