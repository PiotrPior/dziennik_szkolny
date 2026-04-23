<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "dziennik_szkolny");

if (!isset($_SESSION['uczen_id'])) {
    header("Location: login.php");
    exit();
}

$uczen_id = $_SESSION['uczen_id'];

if (isset($_POST['upload']) && isset($_FILES['avatar'])) {
    $img = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));

    mysqli_query($conn, "UPDATE uczniowie SET avatar='$img' WHERE id=$uczen_id");
}

$sql = "SELECT avatar FROM uczniowie WHERE id=$uczen_id";
$wynik = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($wynik);
?>
<link rel="stylesheet" href="style.css">
<div class="profile-box">
<h2>Mój profil</h2>
<?php
if ($row['avatar']) {
    echo '<img src="data:image/jpeg;base64,'.base64_encode($row['avatar']).'">';
} else {
    echo '<img src="default.png">';
}
?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="avatar"><br>
    <button type="submit" name="upload">Zmień zdjęcie</button>
</form>
<a href="index.php" class="back-btn">← Powrót do strony głównej</a>
</div>