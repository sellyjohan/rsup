<?php $this->load->view('layout/header'); ?>
<h2>Daftar File</h2>
<a href="<?= site_url('file/upload') ?>">Upload Baru</a>
<ul>
  <?php foreach ($files as $f): ?>
    <li>
      <a href="<?= base_url('uploads/'.$f->nama_file) ?>" target="_blank"><?= $f->nama_file ?></a>
    </li>
  <?php endforeach; ?>
</ul>
<?php $this->load->view('layout/footer'); ?>
