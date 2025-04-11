<?php $this->load->view('layout/header'); ?>

<h2>Edit Pasien</h2>
<form action="<?= site_url('pasien/update/' . $pasien->id) ?>" method="post">
  <label>Nama</label><br>
  <input type="text" name="nama" value="<?= $pasien->nama ?>" required><br>

  <label>Alamat</label><br>
  <textarea name="alamat" required><?= $pasien->alamat ?></textarea><br>

  <label>Tanggal Lahir</label><br>
  <input type="date" name="tanggal_lahir" value="<?= $pasien->tanggal_lahir ?>" required><br>

  <label>Jenis Kelamin</label><br>
  <select name="jenis_kelamin" required>
    <option value="L" <?= $pasien->jenis_kelamin == 'L' ? 'selected' : '' ?>>Laki-laki</option>
    <option value="P" <?= $pasien->jenis_kelamin == 'P' ? 'selected' : '' ?>>Perempuan</option>
  </select><br><br>

  <button type="submit">Update</button>
</form>

<?php $this->load->view('layout/footer'); ?>
