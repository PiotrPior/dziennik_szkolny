<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "dziennik_szkolny");

if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $haslo = $_POST['haslo'];

    $sql = "SELECT * FROM admin WHERE email='$email' AND haslo='$haslo'";
    $wynik = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($wynik)) {
        $_SESSION['admin'] = $row['email'];
        $_SESSION['admin_id'] = $row['id'];

        header("Location: panel_admina.php");
        exit();
    } else {
        echo "Błędne dane";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="login-box">
<form method="POST">
    <h2>Logowanie admin</h2>
    Email: <input type="text" name="email"><br>
    Hasło: <input type="password" name="haslo"><br>
    <button type="submit">Zaloguj</button>
</form>

<a href="login.php">← Powrót</a>
</div>