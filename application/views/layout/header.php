<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Aplikasi Web'; ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/navbar.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<?php $this->load->view('layout/navbar'); ?>
