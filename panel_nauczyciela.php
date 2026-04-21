<?php
session_start();

if (!isset($_SESSION['nauczyciel'])) {
    header("Location: login_nauczyciel.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "dziennik_szkolny");
$nauczyciel_id = $_SESSION['nauczyciel_id'];

$sql = "SELECT id FROM przedmioty WHERE nauczyciel_id = $nauczyciel_id";
$wynik = mysqli_query($conn, $sql);
$przedmiot = mysqli_fetch_assoc($wynik);
$p = $przedmiot['id'];
$uczniowie = mysqli_query($conn, "SELECT id, imie, nazwisko FROM uczniowie");
$uczniowie2 = mysqli_query($conn, "SELECT id, imie, nazwisko FROM uczniowie");
?>
<link rel="stylesheet" href="style.css">
<div class="panel">
<h2>Panel nauczyciela</h2>
<div>
Użytkownik: <?php echo $_SESSION['nauczyciel']; ?>
| <a href="logout.php">Wyloguj</a>
</div>
<h3>Dodaj ocenę</h3>
<form method="POST">
    Uczeń:
    <select name="uczen_id">
    <?php
    while ($u = mysqli_fetch_assoc($uczniowie)) {
        echo "<option value='".$u['id']."'>".$u['imie']." ".$u['nazwisko']."</option>";
    }
    ?>
    </select><br>
    Ocena: <input type="number" name="ocena" max="6" min="1"><br>
    <button type="submit" name="dodaj_ocene">Dodaj</button>
</form>

<?php
if (isset($_POST['dodaj_ocene'])) {
    $u = $_POST['uczen_id'];
    $o = $_POST['ocena'];

    mysqli_query($conn, "INSERT INTO oceny (uczen_id, przedmiot_id, ocena, data)
    VALUES ('$u','$p','$o',CURDATE())");
}
?>

<h3>Dodaj obecność</h3>
<form method="POST">
    Uczeń:
    <select name="uczen_id">
    <?php
    while ($u = mysqli_fetch_assoc($uczniowie2)) {
        echo "<option value='".$u['id']."'>".$u['imie']." ".$u['nazwisko']."</option>";
    }
    ?>
    </select><br>
    Status:
    <select name="status">
        <option value="obecny">obecny</option>
        <option value="nieobecny">nieobecny</option>
        <option value="spozniony">spóźniony</option>
        <option value="zwolniony">zwolniony</option>
    </select><br>
    <button type="submit" name="dodaj_obecnosc">Dodaj</button>
</form>
<?php
if (isset($_POST['dodaj_obecnosc'])) {
    $u = $_POST['uczen_id'];
    $s = $_POST['status'];

    mysqli_query($conn, "INSERT INTO obecnosci (uczen_id, przedmiot_id, data, status)
    VALUES ('$u','$p',CURDATE(),'$s')");
}
?>
</div>