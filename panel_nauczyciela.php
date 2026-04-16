<?php
session_start();

if (!isset($_SESSION['nauczyciel'])) {
    header("Location: login_nauczyciel.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "dziennik_szkolny");
?>

<h2>Panel nauczyciela</h2>

<h3>Dodaj ocenę</h3>
<form method="POST">
    ID ucznia: <input type="number" name="uczen_id"><br>
    ID przedmiotu: <input type="number" name="przedmiot_id"><br>
    Ocena: <input type="number" name="ocena"><br>
    <button type="submit" name="dodaj_ocene">Dodaj</button>
</form>

<?php
if (isset($_POST['dodaj_ocene'])) {
    $u = $_POST['uczen_id'];
    $p = $_POST['przedmiot_id'];
    $o = $_POST['ocena'];

    mysqli_query($conn, "INSERT INTO oceny (uczen_id, przedmiot_id, ocena, data)
    VALUES ('$u','$p','$o',CURDATE())");
}
?>

<h3>Dodaj obecność</h3>
<form method="POST">
    ID ucznia: <input type="number" name="uczen_id"><br>
    ID przedmiotu: <input type="number" name="przedmiot_id"><br>
    Status: <input type="text" name="status"><br>
    <button type="submit" name="dodaj_obecnosc">Dodaj</button>
</form>

<?php
if (isset($_POST['dodaj_obecnosc'])) {
    $u = $_POST['uczen_id'];
    $p = $_POST['przedmiot_id'];
    $s = $_POST['status'];

    mysqli_query($conn, "INSERT INTO obecnosci (uczen_id, przedmiot_id, data, status)
    VALUES ('$u','$p',CURDATE(),'$s')");
}
?>