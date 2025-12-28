<?php
session_start();
include 'koneksi.php';

$error = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed = md5($password);
    // Cek user berdasarkan username & password (plain text)
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$hashed'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<style>
.login-wrapper {
    min-height: calc(100vh - 160px); /* supaya tidak nutup navbar + footer */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Box login */
.login-box {
    background: #fff;
    width: 340px;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    text-align: center;
}

.login-box h2 {
    margin-top: 0;
    color: #4e73df;
    font-size: 24px;
}

.login-box input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 15px;
}

.login-box button {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    background: #4e73df;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.login-box button:hover {
    background: #3b5fcc;
}

.error {
    background: #ffb3b3;
    padding: 8px;
    border-radius: 6px;
    margin-bottom: 10px;
    color: #900;
}

/* Tombol kembali ke beranda */
.back-home {
    margin-top: 15px;
    display: inline-block;
    text-decoration: none;
    padding: 8px 15px;
    background: #f4c430;
    color: #333;
    border-radius: 8px;
    font-weight: bold;
}

.back-home:hover {
    background: #e2b325;
}
</style>

<?php include "../includes/header.php"; ?>

<div class="login-wrapper">
    <div class="login-box">
        <h2>Login Admin</h2>

        <?php if (!empty($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" autocomplete="off" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login">Login</button>
        </form>

        <!-- Tombol kembali ke beranda -->
        <a class="back-home" href="../home.php">Kembali ke Beranda</a>
    </div>
</div>

<?php include "../includes/footer.php"; ?>