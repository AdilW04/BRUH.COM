<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!--bp-->
    <title>F-encore: Accounts</title>
    <link href="../StyleSheets/StyleSheet.css" rel="stylesheet" type="text/css" />
    <!--    google font stuff-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Varela Round', sans-serif;
        }
    </style>
    <!--bp-->

</head>
<body>
<script src="../Scripts/Redirect.js"></script>
<script src="../Scripts/Clear.js"></script>
<a href="Index.php" , class="home"><h1 class="home">Bruh.com</h1></a>
<div class="center", id="body">
    <h1> We're happy you're here!</h1>
    <h2> Now join us or else >:)</h2>
    <br>
    <div>
        <form method="post">
            <input name="username"> <-Username</input>
            <br><br>
            <input type="password" name="password"> <-Password</input>
            <br>
            <input type="password" name="passwordconf"> <-Confirm Password</input>
            <br><br>
            <input name="email"> <-Email</input>
            <br>
            <input name="emailconf"> <-Confirm Email</input>
            <br><br>
            <div class="center">
                <input name="submit" type="submit"></input>
            </div>
        </form>
    </div>
</div>
        <?php
            $conn=new mysqli("localhost","root");


            if(isset($_POST["submit"]))
            {
                $result=$conn->query("SELECT Email, Username FROM questionsdb.users");
                $emailtaken=false;
                $usernametaken=false;
                //check if email is part of a domain that actually exists
                if ($_POST["email"]!="" AND filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)==true and checkdnsrr(substr($_POST["email"],strpos($_POST["email"],"@")+1))==true) {
                    for ($i = 0; $i < $result->num_rows; $i++) {
                        $assoc = $result->fetch_assoc();
                        //echo($assoc["Username"]);
                        //check if username already exists
                        if ($assoc["Username"] == $_POST["username"]) {
                            echo "username already taken";
                            $usernametaken = true;
                        }
                        elseif ($_POST["username"]==""AND $usernametaken==false)
                        {
                            echo "please enter a username";
                            $usernametaken = true;
                        }
                        echo "<br>";
                        //check if email already exists
                        if ($assoc["Email"] == $_POST["email"]) {
                            echo "email already in use";
                            $emailtaken = true;
                        }

                    }
                    if ($_POST["password"]=="")
                    {
                        echo "please enter a password";
                        $usernametaken=true;
                        //prevents progression in registration even though username may have not acually been taken
                    }
                    if ($usernametaken == false and $emailtaken == false) {
                        if ($_POST["password"] == $_POST["passwordconf"] and $_POST["email"] == $_POST["emailconf"]) {
                            echo "<script> clear()</script>";
                            echo "<div class='center'><h1>Welcome To BRUH.COM " . $_POST["username"] . "!</h1></div>";
                            $conn->query("INSERT INTO questionsdb.users(ID,Username,Password,Email) values(" . $result->num_rows . ",'" . $_POST["username"] . "','" . $_POST["password"] . "','" . $_POST["email"] . "')");
                            echo "<script>redirect()</script>";
                            //adds user to database if the password matches with the confirm password and the same with email
                        } else {
                            echo "password or email does not match";
                        }
                    }
                }
                else
                {
                    echo "email is not valid";
                }


            }
        ?>

</body>
</html>