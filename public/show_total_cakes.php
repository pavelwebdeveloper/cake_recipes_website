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

// library/connections.php

/*
try {
$pdo = new PDO('mysql:host=localhost;dbname=cake_recipes;charset=utf8',
'proxyClient', 'iMi20GYnzHXRrJ9B');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//$output = 'Database connection established.';

$sql = 'SELECT `cakeIngredients` FROM `cake`';
$result = $pdo->query($sql);
//while ($row = $result->fetch()) {
foreach ($result as $row) {
$cakeRecipes[] = $row['cakeIngredients'];
}
$title = 'Cake recipes list';

// Start the buffer
ob_start();

// Include the template. The PHP code will be executed,
// but the resulting HTML will be stored in the buffer
// rather than sent to the browser.
include __DIR__ . '/../templates/cake_recipes.html.php';
// Read the contents of the output buffer and store them
// in the $output variable for use in layout.html.php
$output =  ob_get_clean();

}
catch (PDOException $e) {
//$output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' .
//$e->getFile() . ':' . $e->getLine();

$output = 'Unable to connect to the database server: ' .
$e->getMessage() . ' in ' .
$e->getFile() . ':' . $e->getLine();
}

//include __DIR__ . '/../templates/cakes.html.php';
include __DIR__ . '/../templates/layout.html.php';
 * *
 */