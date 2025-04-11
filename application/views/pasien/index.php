<?php $this->load->view('layout/header'); ?>
<h2>Data Pasien</h2>
<a href="<?= site_url('pasien/create') ?>">Tambah Pasien</a>
<table>
  <tr><th>Nama</th><th>Alamat</th><th>Aksi</th></tr>
  <?php foreach ($pasien as $p): ?>
    <tr>
      <td><?= $p->nama ?></td>
      <td><?= $p->alamat ?></td>
      <td>
        <a href="<?= site_url('pasien/edit/'.$p->id) ?>">Edit</a> |
        <a href="#" onclick="hapus(<?= $p->id ?>)">Hapus</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
<script>
function hapus(id) {
  if (confirm('Yakin ingin hapus?')) {
    fetch('<?= site_url("pasien/delete/") ?>' + id, { method: 'DELETE' })
      .then(res => location.reload());
  }
}
</script>
<?php $this->load->view('layout/footer'); ?>
