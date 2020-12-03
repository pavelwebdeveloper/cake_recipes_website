<?php

// This is the cakes website controller
//require_once __DIR__ . '/../library/connections.php';
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

//if no route variable is set, use 'joke/home'
//$route = $_GET['route'] ?? 'cake/home';
$route = substr($_SERVER['REQUEST_URI'],43);
//$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

/*
echo "Hi there !!!!!!!!!!!!!!!!!!"."<br>";
echo $_SERVER['REQUEST_URI']."<br>";
echo substr($_SERVER['REQUEST_URI'],43)."<br>";
echo ltrim($_SERVER['REQUEST_URI'], '/phpprojects/cake_recipes/public/index.php')."<br>";
exit;

echo strtok('/')."<br>";
echo strtok('/')."<br>";
echo strtok('/')."<br>";
echo strtok('/')."<br>";
 
/*
echo $route."<br>";
echo strtolower($route);
exit;
 * 
 */
 
 if($route === 'cake/delete'){
  $_GET['id']="";
 }
 
 
 
if ($route == strtolower($route)) {
if ($route === 'cake/list') {
include __DIR__ . '/../classes/controllers/CakeController.php';
$controller = new CakeController($cakeRecipesTable,
$authorsTable);
$page = $controller->listCakes();
} elseif ($route === '') { 
include __DIR__ . '/../classes/controllers/CakeController.php';
$controller = new CakeController($cakeRecipesTable,
$authorsTable);
$page = $controller->home();
} elseif ($route === 'cake/edit' || $route === 'cake/edit?id='.$_GET['id']) {
include __DIR__ . '/../classes/controllers/CakeController.php';
$controller = new CakeController($cakeRecipesTable,
$authorsTable);
$page = $controller->edit();
} elseif ($route === 'cake/delete') {
include __DIR__ . '/../classes/controllers/CakeController.php';
$controller = new CakeController($cakeRecipesTable,
$authorsTable);
$page = $controller->delete();
} elseif ($route === 'register') {
include __DIR__ .
'/../classes/controllers/RegisterController.php';
$controller = new RegisterController($authorsTable);
$page = $controller->showForm();
} else { 
http_response_code(301);
header('location: /phpprojects/cake_recipes/public/index.php/');
}
}





/*
if (isset($_GET['edit'])) {
$page = $controller->edit();
} elseif (isset($_GET['delete'])) {
$page = $controller->delete();
} elseif (isset($_GET['list'])) {
$page = $controller->listCakeRecipes();
} else {
$page = $controller->home();
}*/



// testing if $action has lower case value if not then redirecting and telling the search engine that redirect is permanent with code 301
/*
if ($action == strtolower($action)) {
$page = $controller->$action();
} else {
http_response_code(301);
header('location: index.php?action=' . strtolower($action));
}
 * *
 */


//$page = $controller->$action();

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


