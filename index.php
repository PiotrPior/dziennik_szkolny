<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dziennik szkolny</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="logo.svg" type="image/x-icon">
    <script src="https://cdn.tiny.cloud/1/eoh0d6bcxy7iv9he2qout37rbwaehxaq9qzj2rlvwqshtdcp/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
</head>
<body>

<header>
    <div class="logo">
        <img src="logo.svg" alt="Logo" height="30">
    </div>
    <div>
    Użytkownik: <?php echo $_SESSION['user']; ?>
    | <a href="logout.php">Wyloguj</a>
    </div>
</header>
<div class="container">
    <div class="sidebar">
        <a href="index.php">Panel główny</a>
        <a href="oceny.php">Oceny</a>
        <a href="obecnosc.php">Obecności</a>
        <button onclick="zmniejsz()">A-</button>
        <button onclick="zwieksz()">A+</button>
        <button onclick="darkMode()">🌙</button>
    </div>
    <div class="main">
        <div class="box">
            <h3>Plan lekcji (dzisiaj)</h3>
            <table>
                <tr>
                    <th>Godzina</th>
                    <th>Przedmiot</th>
                </tr>
                <tr>
                    <td>8:00 - 8:45</td>
                    <td>Matematyka</td>
                </tr>
                <tr>
                    <td>9:00 - 9:45</td>
                    <td>Polski</td>
                </tr>
                <tr>
                    <td>10:00 - 10:45</td>
                    <td>Informatyka</td>
                </tr>
            </table>
        </div>
        <div class="box">
            <h3>Ostatnie oceny</h3>
            <ul>
                <li>Matematyka - 5</li>
                <li>Polski - 4</li>
                <li>Informatyka - 6</li>
            </ul>
        </div>
        <div class="box">
            <h3>Ostatnie obecności</h3>
            <ul>
                <li>Matematyka - obecny</li>
                <li>Polski - obecny</li>
                <li>Informatyka - nieobecny</li>
            </ul>
        </div>
        <div class="box">
            <h3>Notatka</h3>
            <textarea id="editor"></textarea>
        </div>
    </div>

</div>

<footer>Wykonane przez: Piotr Pióro | eduDziennik</footer>
<script src="script.js"></script>
</body>
</html>