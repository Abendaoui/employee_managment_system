<?php
require_once '../../../../utils/data.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="#" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="../../../../assets/img/logo/logo.jpeg" alt="logo" class="object-fit-contain w-px-30 rounded-3" />
      </span>
      <span class="app-brand-text demo text-body fw-bolder m-md-2" style="text-transform: capitalize !important;font-size:25px;font-family:monospace !important">
        Sellsy<span>Soft</span>
      </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <?php foreach ($admin_pages as $page) :
      $active = in_array($current_page, $page['keys']) ? 'active' : '';
      $has_submenu = isset($page['submenus']) && is_array($page['submenus']);
    ?>
      <li class="menu-item <?= $active ?> mb-2">
        <a href="<?= $page['link'] ?>" class="menu-link <?= $has_submenu ? 'menu-toggle' : '' ?>">
          <i class="menu-icon tf-icons <?= $page['icon'] ?>"></i>
          <div data-i18n="Analytics">
            <?= $page['page']  ?>
          </div>
        </a>
        <?php if ($has_submenu) { ?>
          <ul class="menu-sub">
            <?php foreach ($page['submenus'] as $submenu) { ?>
              <li class="menu-item">
                <a href="<?= $submenu['link'] ?>" class="menu-link">
                  <div data-i18n="Container"><?= $submenu['page'] ?></div>
                </a>
              </li>
            <?php } ?>
          </ul>
        <?php } ?>
      </li>
    <?php endforeach ?>
  </ul>
</aside>