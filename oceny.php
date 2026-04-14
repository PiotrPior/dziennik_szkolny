<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "dziennik_szkolny");

$uczen_id = $_SESSION['uczen_id'];
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Oceny</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="logo.svg" height="30">
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
            <h3>Oceny</h3>
            <table>
            <tr>
                <th>Przedmiot</th>
                <th>Ocena</th>
            </tr>

            <?php
            $sql = "SELECT oceny.ocena, przedmioty.nazwa
                    FROM oceny
                    JOIN przedmioty ON oceny.przedmiot_id = przedmioty.id
                    WHERE oceny.uczen_id = $uczen_id";

            $wynik = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($wynik)) {
                echo "<tr>";
                echo "<td>" . $row['nazwa'] . "</td>";
                echo "<td>" . $row['ocena'] . "</td>";
                echo "</tr>";
            }
            ?>

            </table>
        </div>
    </div>
</div>

<footer>eduDziennik</footer>
<script src="script.js"></script>
</body>
</html>