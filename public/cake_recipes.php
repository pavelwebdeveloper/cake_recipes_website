<?php

try {
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

//$output = 'Database connection established.';


$result = findAll($pdo, 'cake');
$cakes = [];
foreach ($result as $cake) {
$author = getItemById($pdo, 'author', 'id',
$cake['authorId']);
$cakes[] = [
'cakeId' => $cake['cakeId'],
'cakeName' => $cake['cakeName'],
'cakeIngredients' => $cake['cakeIngredients'],
'cakeRecipe' => $cake['cakeRecipe'],
'cakeCuisine' => $cake['cakeCuisine'],
'cakePicture' => $cake['cakePicture'],
'cakeDate' => $cake['cakeDate'],
'name' => $author['name'],
'email' => $author['email']
];
}


$totalCakeRecipes = totalRecords($pdo, 'cake');

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

$error = 'Unable to connect to the database server: ' .
$e->getMessage() . ' in ' .
$e->getFile() . ':' . $e->getLine();
}

//include __DIR__ . '/../templates/cakes.html.php';
include __DIR__ . '/../templates/layout.html.php';

