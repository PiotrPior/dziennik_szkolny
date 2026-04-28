<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "dziennik_szkolny");
$uczniowie = mysqli_query($conn, "SELECT id, imie, nazwisko, klasa FROM uczniowie");
$nauczyciele = mysqli_query($conn, "SELECT id, imie, nazwisko, specjalizacja FROM nauczyciele");
?>

<link rel="stylesheet" href="style.css">

<div class="panel">
<h2>Panel administratora</h2>

<div>
Zalogowany: <?php echo $_SESSION['admin']; ?>
| <a href="logout.php">Wyloguj</a>
</div>

<h3>Dodaj ucznia</h3>
<form method="POST">
    Imię: <input type="text" name="imie"><br>
    Nazwisko: <input type="text" name="nazwisko"><br>
    Email: <input type="text" name="email"><br>
    Hasło: <input type="text" name="haslo"><br>
    Klasa: <input type="text" name="klasa"><br>
    <button name="dodaj_ucznia">Dodaj</button>
</form>

<?php
if (isset($_POST['dodaj_ucznia'])) {
    mysqli_query($conn, "INSERT INTO uczniowie (imie,nazwisko,email,haslo,klasa)
    VALUES ('$_POST[imie]','$_POST[nazwisko]','$_POST[email]','$_POST[haslo]','$_POST[klasa]')");
}
?>

<h3>Dodaj nauczyciela</h3>
<form method="POST">
    Imię: <input type="text" name="imie_n"><br>
    Nazwisko: <input type="text" name="nazwisko_n"><br>
    Email: <input type="text" name="email_n"><br>
    Hasło: <input type="text" name="haslo_n"><br>
    Specjalizacja: <input type="text" name="spec"><br>
    <button name="dodaj_nauczyciela">Dodaj</button>
</form>

<?php
if (isset($_POST['dodaj_nauczyciela'])) {
    mysqli_query($conn, "INSERT INTO nauczyciele (imie,nazwisko,email,haslo,specjalizacja)
    VALUES ('$_POST[imie_n]','$_POST[nazwisko_n]','$_POST[email_n]','$_POST[haslo_n]','$_POST[spec]')");
}
?>

<h3>Usuń ucznia</h3>
<form method="POST">
    Uczeń:
    <select name="usun_id">
    <?php
    while ($u = mysqli_fetch_assoc($uczniowie)) {
        echo "<option value='".$u['id']."'>".$u['imie']." ".$u['nazwisko']." (".$u['klasa'].")</option>";
    }
    ?>
    </select><br>
    <button name="usun_ucznia" onclick="return confirm('Na pewno usunąć ucznia?')">Usuń</button>
</form>

<?php
if (isset($_POST['usun_ucznia'])) {
    mysqli_query($conn, "DELETE FROM uczniowie WHERE id=$_POST[usun_id]");
}
?>

<h3>Usuń nauczyciela</h3>
<form method="POST">
    Nauczyciel:
    <select name="usun_id_n">
    <?php
    while ($n = mysqli_fetch_assoc($nauczyciele)) {
        echo "<option value='".$n['id']."'>".$n['imie']." ".$n['nazwisko']." (".$n['specjalizacja'].")</option>";
    }
    ?>
    </select><br>
    <button name="usun_nauczyciela" onclick="return confirm('Na pewno usunąć nauczyciela?')">Usuń</button>
</form>

<?php
if (isset($_POST['usun_nauczyciela'])) {
    mysqli_query($conn, "DELETE FROM nauczyciele WHERE id=$_POST[usun_id_n]");
}
?>

</div>