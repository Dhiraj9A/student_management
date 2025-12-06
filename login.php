<?php
require_once 'config.php';
if (isset($_SESSION['usename']) and isset($_SESSION["isauthenticated"]) == true) {
    header("Location: dashboard.php");
    exit();
}
// Simple hardcoded user for demo: admin / 1234
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    $selectQuery = "select * from admins where username = '$user' and password = sha2('$pass',256)";
    $sel_exe = $conn->query($selectQuery);
    if ($sel_exe->num_rows > 0) {
        $user_data =  $sel_exe->fetch_assoc();
        $_SESSION['usename'] = $user_data["id"];
        $_SESSION["isauthenticated"] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Credentials";
    }
}

?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="container">
        <h2>Admin Login</h2>
        <?php if (!empty($error)) echo '<p class="error">' . htmlspecialchars($error) . '</p>'; ?>
        <form method="post" action="">
            <label>Username</label><br>
            <input type="text" name="username" required><br>
            <label>Password</label><br>
            <input type="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>