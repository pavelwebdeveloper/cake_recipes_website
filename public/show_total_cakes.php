<?php
echo strtok($_SERVER['REQUEST_URI'], '?');

//phpinfo();




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

