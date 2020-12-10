<?php


//echo strtok($_SERVER['REQUEST_URI'], '?');

// This is the cakes website controller
/*
if (!isset($_COOKIE['visits'])) {
$_COOKIE['visits'] = 0;
echo $_COOKIE['visits']."111111<br>";
echo "Inside if";
}
echo $_COOKIE['visits']."22222222<br>";
//$visits = $_COOKIE['visits']+1;
echo "<br>";
echo $_COOKIE['visits']."33333333333<br>";
//setcookie('visits', $visits, time() + 3600 * 24 * 365);
echo "<br>";
echo $_COOKIE['visits']."444444444444<br>";
if ($_COOKIE['visits'] > 1) {
echo "This is visit number ".$_COOKIE['visits'].".";
$visits = $_COOKIE['visits']+1;
setcookie('visits', $visits, time() + 3600 * 24 * 365);
} else {
// First visit
echo $_COOKIE['visits']."55555555555<br>";
echo 'Welcome to our website! Click here for a tour!';
$visits = $_COOKIE['visits']+1;
setcookie('visits', $visits, time() + 3600 * 24 * 365);
echo $_COOKIE['visits']."777777777777777<br>";
}
*/
 
echo phpinfo();





// Include the file that creates the $pdo variable and connects to the database
/*
include_once __DIR__ .
'/../includes/DatabaseConnection.php';
// Include the file that provides the `totalJokes` function

include __DIR__ . '/../classes/DatabaseTable.php';
// Call the function
echo totalCakeRecipes($pdo)."<br>";

$cakeRecipe1 = getCakeRecipe($pdo, 1);
echo $cakeRecipe1['cakeRecipe']."<br>";


$cakeRecipe2 = getCakeRecipe($pdo, 2);
echo $cakeRecipe2['cakeRecipe'];

$date = new DateTime();

echo "<br>".$date->format('Y-m-d H:i:s');
 * *
 */

