<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../StyleSheets/StyleSheet.css", type="text/css"/>
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
<script src="../Scripts/FadeAway.js"></script>
<script src="../Scripts/CheckAnswer.js"></script>
<a href="Index.php" , class="home"><h1 class="home">Bruh.com</h1></a>
<div class="center">
    <?php
    function GetAnswer($chosenQuestion)//chosen question ranging from index 1 to the num_rows (integer) eg: if chosen question=1, will pick the one with index 0
    {
        $question="";
        $answer="";
        $chosenQuestion=$chosenQuestion-1;
        $conn=new mysqli("localhost","root");
        $result=$conn->query("SELECT Question,Answer FROM questionsdb.questions WHERE ID=".$chosenQuestion);
        foreach ($result as $i)
        {
            $question= $i["Question"];
            $answer=$i["Answer"];
        }
        echo "<h2>".$question."</h2> <br>";
        $conn->close();
        return($answer);
    }

    //get numrows
    $conn=new mysqli("localhost","root");
    $result=$conn->query("SELECT * FROM questionsdb.questions");
    $numrows=$result->num_rows;
    $conn->close();
    $answer=GetAnswer(rand(1,$numrows));
    echo '<p name="'.$answer.'" id="actualAnswer"> : |</p>';

    ?>
    <br>
    <form action ="javascript:void",method="post">
        <input name="answer" id="answer"> < Answer </input>
        <input type="button" onclick="CheckAnswer()" name="submit", value="Submit Answer">
    </form>

</div>
</body>
</html>