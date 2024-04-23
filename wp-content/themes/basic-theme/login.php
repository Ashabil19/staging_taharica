<?php
// Fungsi untuk memproses login
function custom_login_process() {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Lakukan verifikasi login di sini, misalnya dengan menggunakan fungsi wp_signon()
        $user = wp_signon(array('user_login' => $username, 'user_password' => $password), false);

        if (is_wp_error($user)) {
            // Jika login gagal, munculkan pesan kesalahan
            echo '<div class="login-error">' . $user->get_error_message() . '</div>';
        } else {
            // Jika login berhasil, atur session dan alihkan ke halaman yang sesuai
            $_SESSION['logged_in_user'] = $user->user_login;
            wp_redirect(home_url()); // Ganti URL tujuan dengan yang sesuai
            exit;
        }
    }
}

// Jalankan fungsi saat halaman dimuat
custom_login_process();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page Taharica</title>
</head>
<body class="loginPage">
    <div class="backgroundLogo">
        <div class="loginCard">
            <form action="<?php echo esc_url( $_SERVER['REQUEST_URI'] ); ?>" method="post" class="loginForm">
                <h1 class="text-display">Login</h1>
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="login" class="login-btn" value="Login">
            </form>
        </div>
    </div>
</body>
</html>
