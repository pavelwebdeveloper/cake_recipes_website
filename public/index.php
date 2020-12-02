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
$cakeRecipesTable = new DatabaseTable($pdo, 'cake', 'cakeId');
$authorsTable = new DatabaseTable($pdo, 'author', 'id');
$action = $_GET['action'] ?? 'home';
// select a default controller (“cake”) if no $_GET['controller'] variable is set:
$controllerName = $_GET['controller'] ?? 'cake';

// redirect to the lowercase URL if required
if ($action == strtolower($action) && $controllerName == strtolower($controllerName)) {
 //  take the name from $controllerName and get the class name by making the first letter uppercase (the ucfirst 
//  function does this for any string) and then appending the string Controller
$className = ucfirst($controllerName) . 'Controller';
//  include the relevant file and create the controller instance
include __DIR__ . '/../controllers/' . $className . '.php';
$controller = new $className($cakeRecipesTable, $authorsTable);
$page = $controller->$action();
}
else {
http_response_code(301);
header('location: index.php?controller=' . strtolower($controllerName) . '&action=' . strtolower($action));
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


