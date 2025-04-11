<?php $this->load->view('layout/header'); ?>
<h2>Upload File</h2>
<form action="<?= site_url('file/upload') ?>" method="post" enctype="multipart/form-data">
  <label>Pilih File</label><br>
  <input type="file" name="file"><br><br>
  <button type="submit">Upload</button>
</form>
<?php $this->load->view('layout/footer'); ?>
