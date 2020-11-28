<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';


try {
if (isset($_POST['cake'])) {
 $cake = $_POST['cake'];
$cake['cakeDate'] = new DateTime();
$cake['authorId'] = 1;
save($pdo, 'cake', 'cakeId', $cake);
 
 
header('location: cake_recipes.php');
} else {
 if (isset($_GET['id'])) {
$cake = getItemById($pdo, 'cake', 'cakeId', $_GET['id']);
 }
$title = 'Add or edit cake recipe';
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
