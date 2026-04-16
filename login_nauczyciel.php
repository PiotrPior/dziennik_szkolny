<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "dziennik_szkolny");

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $haslo = $_POST['haslo'];

    $sql = "SELECT * FROM nauczyciele WHERE email='$email' AND haslo='$haslo'";
    $wynik = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($wynik)) {
        $_SESSION['nauczyciel'] = $row['email'];
        $_SESSION['nauczyciel_id'] = $row['id'];

        header("Location: panel_nauczyciela.php");
        exit();
    } else {
        echo "Błędne dane";
    }
}
?>

<form method="POST">
    Email: <input type="text" name="email"><br>
    Hasło: <input type="password" name="haslo"><br>
    <button type="submit">Zaloguj jako nauczyciel</button><br>
    <a href="login.php">Zaloguj jako uczen</a>
</form>