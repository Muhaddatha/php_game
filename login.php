<?php 

require_once "bootstrap.php";
if(isset($_POST['cancel'])){
    //If the user clicks on the cancel button, return them to index.php
    header("Location: index.php");
    //https://www.php.net/manual/en/function.header.php

    return;
}

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
//Password is meow123

$failure = false; //If we have no _POST data
$debuggin = true;

//Checking to see if _POST data exists. If there is, we process it
// CHecking to see if the user has enetered user name AND password, if they haven't failure remains false
if(isset($_POST['who']) && isset($_POST['pass'])){


    if(strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1){

        $failure = "User name and password are required.";

    }
    else{
        $check = hash('md5', $salt.$_POST['pass']); //making sure the password is correct

        //Why does post have an underscore? Mistake * all _POST's have an underscore

        if($check == $stored_hash){
            //User has entered the right password
            //Redirecting browser to game.php using header
            //urlencode : encodes a string inside a URL

            if($debuggin){
                echo("Correct password entered!");
                sleep(10);
            }
            header("Location: game.php?name=".urlencode($_POST['who']));
            return;
        }
        else{
            //User has enetered the wrong password
            $failure = "Incorrect password";
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muhaddatha Abdulghani's Login page</title>
</head>
<body>
    <!-- The keyword container is signalling to bootstrap for styling I think -->
    <div class="container">
        <h1>Please log in</h1>

        <?php 
            if($failure !== false){
                //* !== compares type and value *
                echo('<p style="color: red;">'.htmlentities($failure)."</p>\n");
            }
        ?>

        <form method="POST">
            <label for="nam">Username</label>
            <input type="text" name="who" id="nam"><br/>
            <label for="id_1723">Password</label>
            <input type="text" name="pass" id="id_1723"><br/>
            <input type="submit" value="Log In">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>
    
</body>
</html>