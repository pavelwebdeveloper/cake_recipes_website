<?php

// This is the cakes website controller
//require_once __DIR__ . '/../library/connections.php';
function loadTemplate($templateFileName, $variables = [])
{
extract($variables);
ob_start();
include __DIR__ . '/../templates/' . $templateFileName;
return ob_get_clean();
}

try {
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';
include __DIR__ . '/../controllers/CakeRecipeController.php';
$cakeRecipesTable = new DatabaseTable($pdo, 'cake', 'cakeId');
$authorsTable = new DatabaseTable($pdo, 'author', 'id');
$CakeRecipeController = new CakeRecipeController($cakeRecipesTable,
$authorsTable);




/*
if (isset($_GET['edit'])) {
$page = $CakeRecipeController->edit();
} elseif (isset($_GET['delete'])) {
$page = $CakeRecipeController->delete();
} elseif (isset($_GET['list'])) {
$page = $CakeRecipeController->listCakeRecipes();
} else {
$page = $CakeRecipeController->home();
}*/

$action = $_GET['action'] ?? 'home';
$page = $CakeRecipeController->$action();

$title = $page['title'];

if (isset($page['variables'])) {
$output = loadTemplate($page['template'],
$page['variables']);
} else {
$output = loadTemplate($page['template']);
}
 
} catch (PDOException $e) {
$title = 'An error has occurred';
$output = 'Database error: ' . $e->getMessage() . ' in '
. $e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../templates/layout.html.php';


