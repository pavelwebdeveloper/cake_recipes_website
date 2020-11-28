<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';


try {
if (isset($_POST['cakeId'])) {
 
update($pdo, 'cake', 'cakeId', [
    'cakeId' => $_POST['cakeId'], 
    'cakeName' => $_POST['cake_name'], 
    'cakeIngredients' => $_POST['cake_ingredients'], 
    'cakeRecipe' => $_POST['cake_recipe_text'], 
    'cakeCuisine' => $_POST['cake_cuisine'], 
    'cakePicture' => $_POST['cake_picture'], 
    'authorId' => 1
    ]
        );
header('location: cake_recipes.php');
} else {
$cake = getItemById($pdo, 'cake', 'cakeId', $_GET['id']);
$title = 'Edit cake recipe';
ob_start();
include __DIR__ . '/../templates/edit_cake_recipe.html.php';
$output = ob_get_clean();
}
} catch (PDOException $e) {
$title = 'An error has occurred';
$output = 'Database error: ' . $e->getMessage() . '
in ' . $e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';
