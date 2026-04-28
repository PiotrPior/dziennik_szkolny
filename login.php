<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "dziennik_szkolny");

if (isset($_POST['email'])) {

    $email = $_POST['email'];
    $haslo = $_POST['haslo'];

    $sql = "SELECT * FROM uczniowie WHERE email='$email' AND haslo='$haslo'";
    $wynik = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($wynik)) {
        $_SESSION['user'] = $row['email'];
        $_SESSION['uczen_id'] = $row['id'];

        header("Location: index.php");
        exit();
    } else {
        echo "Błędne dane";
    }
}
?>
<link rel="stylesheet" href="style.css">
<div class="login-box">
<form method="POST">
    <h2>Logowanie</h2>
    Email: <input type="text" name="email"><br>
    Hasło: <input type="password" name="haslo"><br>
    <button type="submit">Zaloguj</button>
</form>
<a href="login_nauczyciel.php">Zaloguj jako nauczyciel</a>
<a href="login_admin.php">Zaloguj jako admin</a>
</div>