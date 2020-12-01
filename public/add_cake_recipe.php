<?php
if (isset($_POST['cake_recipe_text'])) {
try {
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';

$date = new DateTime();
insert($pdo, 'cake', [ 
    'cakeName' => $_POST['cake_name'], 
    'cakeIngredients' => $_POST['cake_ingredients'], 
    'cakeRecipe' => $_POST['cake_recipe_text'], 
    'cakeCuisine' => $_POST['cake_cuisine'], 
    'cakePicture' => $_POST['cake_picture'], 
    'cakeDate' => $date->format('Y-m-d H:i:s'),
    'authorId' => 2
    ]
        );
header('location: cake_recipes.php');
} catch (PDOException $e) {
$title = 'An error has occurred';
$output = 'Database error: ' . $e->getMessage() . ' in '
. $e->getFile() . ':' . $e->getLine();
}
} else {
$title = 'Add a new cake recipe';
ob_start();
include __DIR__ . '/../templates/add_cake_recipe.html.php';
$output = ob_get_clean();
}
include __DIR__ . '/../templates/layout.html.php';

