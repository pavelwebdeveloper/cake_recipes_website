<?php

//echo var_dump($_POST);


if (isset($_POST['cakeId'])) {
try {
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

delete($pdo, 'cake', 'cakeId', $_POST['cakeId']);

header('location: cake_recipes.php');
} catch (PDOException $e) {
$title = 'An error has occurred';
$output = 'Database error: ' . $e->getMessage() . ' in '
. $e->getFile() . ':' . $e->getLine();
}
} else {
 header('location: cake_recipes.php');
 
$title = 'Cake recipes list';
ob_start();
include __DIR__ . '/../templates/cake_recipes.html.php';
$output = ob_get_clean();
  
}
include __DIR__ . '/../templates/layout.html.php';
