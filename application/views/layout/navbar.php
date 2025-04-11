<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/navbar.css'); ?>">

<?php
  $current = $this->uri->segment(1);
?>

<nav>
    <ul>
        <li><a href="<?php echo base_url('dashboard'); ?>" class="<?= ($current == 'dashboard') ? 'active' : '' ?>">Dashboard</a></li>
        <li><a href="<?php echo base_url('user'); ?>" class="<?= ($current == 'user') ? 'active' : '' ?>">User Management</a></li>
        <li><a href="<?php echo base_url('artikel'); ?>" class="<?= ($current == 'artikel') ? 'active' : '' ?>">Artikel</a></li>
        <li><a href="<?php echo base_url('login/logout'); ?>">Logout</a></li>
    </ul>
</nav>
