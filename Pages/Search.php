<?php session_start()?>
<?php
if (!isset($_SESSION["user"])){
    header("Location:Login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>F-encore</title>
    <link rel="stylesheet" href="../StyleSheets/StyleSheet.css" type="text/css"/>
    <!--    google font stuff-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Varela Round', sans-serif;
        }
    </style>
</head>
<body>
<a href="Index.php" , class="home"><h1 class="home">Bruh.com</h1></a>
<?php
if(isset($_SESSION["user"])){
    echo $_SESSION["user"];
}
?>
</body>
</html>