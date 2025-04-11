<?php $this->load->view('layout/header'); ?>

<div class="dashboard-container">
    <h2>Selamat datang, User!</h2>
    <p>Halo <strong><?= $this->session->userdata('full_name'); ?></strong> (<?= $this->session->userdata('username'); ?>)</p>
    <a href="<?= site_url('login/logout') ?>" class="btn-logout">Logout</a>
</div>

<?php $this->load->view('layout/footer'); ?>
