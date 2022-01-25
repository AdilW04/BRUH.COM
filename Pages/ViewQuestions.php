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
    <title>F-encore: View</title>
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
<div class="center">
    <table>
        <th>Question</th><th>Answer</th>

        <?php
        //esablish conenction
        $conn=new mysqli("localhost","root");
        $result=$conn->query("SELECT Question, Answer FROM questionsdb.questions");
        //echo "Question      Answer <br>";
        $questions=[];
        $answers=[];
        //create lists based of data obtained from database
        for ($i=0;$i<$result->num_rows;$i++)
        {
            $assoc=$result->fetch_assoc();
            array_push($questions,$assoc["Question"]);
            array_push($answers,$assoc["Answer"]);
        }
        //output the data in the form of a html table row and data
        for ($i=0;$i<sizeof($questions);$i++)
        {
            echo "<tr>";
            echo "<td>".$questions[$i]."</td><td>".$answers[$i]."</td>";
        }
        $conn->close();
        ?>
    <table>
</div>




</body>
</html>