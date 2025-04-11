<?php $this->load->view('layout/header'); ?>

<h2>Tambah Pasien</h2>
<form action="<?= site_url('pasien/store') ?>" method="post">
  <label>Nama</label><br>
  <input type="text" name="nama" required><br>

  <label>Alamat</label><br>
  <textarea name="alamat" required></textarea><br>

  <label>Tanggal Lahir</label><br>
  <input type="date" name="tanggal_lahir" required><br>

  <label>Jenis Kelamin</label><br>
  <select name="jenis_kelamin" required>
    <option value="">-- Pilih --</option>
    <option value="L">Laki-laki</option>
    <option value="P">Perempuan</option>
  </select><br><br>

  <button type="submit">Simpan</button>
</form>

<?php $this->load->view('layout/footer'); ?>
