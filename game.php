<?php 

require_once "bootstrap.php";

//Making dure that user has inputted a valid username
if(! isset($_GET['name']) || strlen($_GET['name']) < 1){
    die('Name parameter missing');
}


//If the user logs out, return to the main page
if(isset($_POST['Logout'])){
    header('Location: index.php');
    return;
}

//Set up the values for the game
//Rock: 0 Paper: 1 Scissors: 2

$names = array('Rock', 'Paper', 'Scissors');
$human = isset($_POST["human"]) ? $_POST['human']+0 : -1;

$computer = random_int(0, 2);


// This function takes as its input the computer and human play
// and returns "Tie", "You Lose", "You Win" depending on play
// where "You" is the human being addressed by the computer
function check($computer, $human) {

    if(($human == 0 && $computer == 2) || ($human == 1 && $computer == 0) || ($human == 2 && $computer == 1 )){
       
        return "You win!";
    }
    else if($computer == $human){
        return "Tie!";
    }
    else{
        return "You lose!";
    }

    return false;
}

$result = check($computer, $human);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muhaddatha Abdulghani's Rock, Paper, Scissor's game</title>
</head>
<body>
    <div class="container">
        <h1>Rock, Paper, Scissors</h1>

        <?php 
        
            if(isset($_REQUEST['name'])){
                echo "<p>Welcome: ";
                echo htmlentities($_REQUEST['name']);
                echo"</p>\n";
            }
        
        ?>

        <form method="post">
        <select name="human" >
        <option value="-1">Select</option>
        <option value="0">Rock</option>
        <option value="1">Paper</option>
        <option value="2">Scissors</option>
        <option value="3">Test</option>
        </select>
        <input type="submit" value="Play">
        <input type="submit" name="Logout" value="Logout">
        </form>

        <pre>
        <?php 
        if($human == -1){
            print "Please select a strategy and press Play. \n";
        }
        else if($human == 3){
            for($i = 0; $i < 3; $i++){
                for($j = 0; $j < 3; $j++){
                    $r = check($i, $j);
                    print "Human=$names[$j] Computer=$names[$i] Result=$r\n";
                }
            }
        }
            
        else{
            print "Your play=$names[$human] Computer=$names[$computer] Result=$result\n";
        }
        

        ?>
        </pre>
    
    
    </div>
</body>
</html>