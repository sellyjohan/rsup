<?php $this->load->view('layout/header'); ?>
<h2>Log Aktivitas</h2>
<table>
  <tr><th>User</th><th>Aksi</th><th>Waktu</th></tr>
  <?php foreach ($log as $l): ?>
    <tr>
      <td><?= $l->user_id ?></td>
      <td><?= $l->aksi ?></td>
      <td><?= $l->created_at ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php $this->load->view('layout/footer'); ?>
