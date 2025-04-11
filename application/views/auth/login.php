<?php $this->load->view('layout/header'); ?>
<h2>Login</h2>
<form action="<?= site_url('auth/login') ?>" method="post">
  <label>Username</label><br>
  <input type="text" name="username" required><br>

  <label>Password</label><br>
  <input type="password" name="password" required><br>

  <label>CAPTCHA</label><br>
  
  <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>

  <br>
  <button type="submit">Login</button>
</form>
<?php $this->load->view('layout/footer'); ?>
