<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #4e54c8;
            outline: none;
        }

        .g-recaptcha {
            margin-bottom: 15px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4e54c8;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #3b40a4;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if ($this->session->flashdata('error')): ?>
            <p class="error-message"><?= $this->session->flashdata('error'); ?></p>
        <?php endif; ?>
        <form method="post" action="<?= site_url('login/do_login') ?>">
            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <div class="g-recaptcha" data-sitekey="6LeXCRIrAAAAAA8r3SLSWqppOWv_gwbRkGH2WP_v"></div>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
