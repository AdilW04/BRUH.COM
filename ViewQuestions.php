<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>F-encore: View</title>
    <link rel="stylesheet" href="StyleSheet.css" type="text/css"/>
</head>
<body>
<a href="Index.html"><h1>F-Encore</h1></a>
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