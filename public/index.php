<?php

// This is the cakes website controller

function loadTemplate($templateFileName, $variables = [])
{
         extract($variables);
         // Start the buffer
         ob_start();
         // Include the template. The PHP code will be executed, but the resulting HTML will be stored in the buffer
         // rather than sent to the browser.
         include __DIR__ . '/../templates/' . $templateFileName;
         // Read the contents of the output buffer and store them in the $output variable for use in layout.html.php
         return ob_get_clean();                  
}

try {
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';
$cakeRecipesTable = new DatabaseTable($pdo, 'cake', 'cakeId');
$authorsTable = new DatabaseTable($pdo, 'author', 'id');

$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

 
 // testing if $route has lower case value
if ($route == strtolower($route)) {
 if ($route === 'phpprojects/cake_recipes/public/index.php/cake/list') {
include __DIR__ . '/../classes/controllers/CakeController.php';
$controller = new CakeController($cakeRecipesTable,
$authorsTable);
$page = $controller->listCakes();
 } elseif ($route === 'phpprojects/cake_recipes/public/index.php') { 
include __DIR__ . '/../classes/controllers/CakeController.php';
$controller = new CakeController($cakeRecipesTable,
$authorsTable);
$page = $controller->home();
 } elseif ($route === 'phpprojects/cake_recipes/public/index.php/cake/edit') {
include __DIR__ . '/../classes/controllers/CakeController.php';
$controller = new CakeController($cakeRecipesTable,
$authorsTable);
$page = $controller->edit();
 } elseif ($route === 'phpprojects/cake_recipes/public/index.php/cake/delete') {
include __DIR__ . '/../classes/controllers/CakeController.php';
$controller = new CakeController($cakeRecipesTable,
$authorsTable);
$page = $controller->delete();
 } elseif ($route === 'phpprojects/cake_recipes/public/index.php/register') {
include __DIR__ .
'/../classes/controllers/RegisterController.php';
$controller = new RegisterController($authorsTable);
$page = $controller->showForm();
} else {
// telling the search engine that redirect is permanent with code 301 
http_response_code(301);
header('location: /phpprojects/cake_recipes/public/index.php?route=' . strtolower($route));
}
}

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


