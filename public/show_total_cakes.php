<?php

// Include the file that creates the $pdo variable and connects to the database
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


/*
updateCakeRecipe($pdo, 12, 'Apricot feast', 'apricots 20, flour 1,5 kg, sour cream 1,5 cups, sugar 200gr', 'mix apricots and flour, stir, add sour cream and sugar, mix again then bake for 1 hour at 220C', 'American cuisine', 'images/apricot_feast_cake.jpg', 1);

/*
insertCakeRecipe($pdo, 'Besquit', 'Chokolate 40gr, milk 1liter, flour 1kg, sugar 50gr, hazelnuts 100gr, 3 eggs', 'Stir the ingredients together, add the eggs, stir again for 5 minutes, bake in the oven at 150C', 'European Cuisine', 'images/besquit_cake.jpg', 1);


insertCakeRecipe($pdo, 'Lemon Pound Cake', '1 cup unsalted butter, 1 cup granulated sugar, 2 lemons, 3 eggs, 2 cups of flour', 'Stir the ingredients together, add the eggs, bake in the oven at 250C', 'European Cuisine', 'images/lemon_pound_cake.jpg', 1);
 
 
 // add_cake_recipe.php code

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
 
 
// cake_recipes.php code
 * 
 
 *try {
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';

//$output = 'Database connection established.';

$cakeRecipesTable = new DatabaseTable($pdo, 'cake', 'cakeId');
$authorsTable = new DatabaseTable($pdo, 'author', 'id');
$result = $cakeRecipesTable->findAll();


$cakes = [];
foreach ($result as $cake) {
$author = $authorsTable->getItemById($cake['authorId']);
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


$totalCakeRecipes = $cakeRecipesTable->totalRecords();

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

// delete_cake_recipe.php
 
if (isset($_POST['cakeId'])) {
try {
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';

$cakesTable = new DatabaseTable($pdo, 'cake', 'cakeId');
$cakesTable->delete($_POST['cakeId']);


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
  
 

// edit_cake_recipe.php code

include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';

$cakesTable = new DatabaseTable($pdo, 'cake', 'cakeId');

try {
if (isset($_POST['cake'])) {
 $cake = $_POST['cake'];
$cake['cakeDate'] = new DateTime();
$cake['authorId'] = 1;
$cakesTable->save($cake);
 
 
header('location: cake_recipes.php');
} else {
 if (isset($_GET['id'])) {
$cake = $cakesTable->getItemById($_GET['id']);
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


// DatabaseFunctions.php code

function query($pdo, $sql, $parameters = []) {
$query = $pdo->prepare($sql);
$query->execute($parameters);
return $query;
}

function processDates($fields) {
// Loop through the array of fields
  foreach ($fields as $key => $value) {
   // If any of the values are a DateTime object
    if ($value instanceof DateTime) {
     // Then replace the value in the array with the date
     // in the format Y-m-d H:i:s
    $fields[$key] = $value->format('Y-m-d H:i:s');
    }
  }
return $fields;
}


// a shorter version of the function to count the number of cake recipes stored in the database
function totalRecords($database, $table) {
 // Call the query function and pass it the empty $parameters array
$query = query($database, 'SELECT COUNT(*) FROM '.$table);
$row = $query->fetch();
return $row[0];
}


// a shorter version of the function to get a specific cake recipe from the database
function getItemById($pdo, $table, $primaryKey, $id) {
 // Create the array of $parameters for use in the query function
$parameters = [':id' => $id];
// call the query function and provide the $parameters array
$query = query($pdo, 'SELECT * FROM `'.$table.'`WHERE `'.$primaryKey.'` = :id', $parameters);
return $query->fetch();
}

/*
function insertCakeRecipe($pdo, $cakeName, $cakeIngredients, $cakeRecipe, $cakeCuisine, $cakePicture, $authorId) {
$query = 'INSERT INTO cake (`cakeName`, `cakeIngredients`, `cakeRecipe`, `cakeCuisine`, `cakePicture`, `cakeDate`,
`authorId`) VALUES (:cakeName, :cakeIngredients, :cakeRecipe, :cakeCuisine, :cakePicture, CURDATE(), :authorId)';
$parameters = [':cakeName' => $cakeName, ':cakeIngredients' => $cakeIngredients, ':cakeRecipe' => $cakeRecipe, ':cakeCuisine' => $cakeCuisine, ':cakePicture' => $cakePicture, ':authorId' => $authorId];
query($pdo, $query, $parameters);
}
*/

/*
function insert($pdo, $table, $fields) {
$query = 'INSERT INTO '.$table.' (';

// Loop through the array of fields
foreach ($fields as $key => $value) {
$query .= '`' . $key . '`,';
}
$query = rtrim($query, ',');
$query .= ') VALUES (';

// Loop through the array of fields
foreach ($fields as $key => $value) {
$query .= ':' . $key . ',';
}
$query = rtrim($query, ',');
$query .= ')';

$fields = processDates($fields);
  
  query($pdo, $query, $fields);
  
}


/*
function updateCakeRecipe($pdo, $cakeId, $cakeName, $cakeIngredients, $cakeRecipe, $cakeCuisine, $cakePicture, $authorId) {
 $query = 'UPDATE `cake` SET `authorId` = :authorId, `cakeName` = :cakeName, `cakeIngredients` = :cakeIngredients, `cakeRecipe` = :cakeRecipe, `cakeCuisine` = :cakeCuisine, `cakePicture` = :cakePicture WHERE `cakeId` = :id';
$parameters = [':id' => $cakeId, ':cakeName' => $cakeName, ':cakeIngredients' => $cakeIngredients, ':cakeRecipe' => $cakeRecipe, ':cakeCuisine' => $cakeCuisine, ':cakePicture' => $cakePicture, ':authorId' => $authorId];
query($pdo, $query, $parameters);
}
 * *
 */
//modified update function with the possibility to send parameters to the query function dynamically
/*
function update($pdo, $table, $primaryKey, $fields) {
 $query = 'UPDATE `'.$table.'` SET ';
  
 // Loop through the array of fields
  foreach ($fields as $key => $value) {
$query .= '`' . $key . '` = :' . $key . ',';
}
$query = rtrim($query, ',');
$query .= ' WHERE `'.$primaryKey.'` = :primaryKey';

$fields = processDates($fields);

// Set the :primaryKey variable
$fields['primaryKey'] = $fields[$primaryKey];  
        
query($pdo, $query, $fields);
}


function getAllCakeRecipes($pdo) {
$cakes = query($pdo, 'SELECT cakeId, cakeName, cakeIngredients, cakeRecipe, cakeCuisine, cakePicture, cakeDate, name, email FROM cake INNER JOIN author ON authorId = author.id');
return $cakes->fetchAll();
}


// a function to  retrieve all the records from any database table
function findAll($pdo, $table) {
$result = query($pdo, 'SELECT * FROM `' . $table . '`');
return $result->fetchAll();
}

function delete($pdo, $table, $primaryKey, $id) {
$parameters = [':id' => $id];
query($pdo, 'DELETE FROM `' . $table . '`
WHERE `'.$primaryKey.'` = :id', $parameters);
}

function save($pdo, $table, $primaryKey, $record) {
try {
if ($record[$primaryKey] == '') {
$record[$primaryKey] = null;
}
insert($pdo, $table, $record);
}
catch (PDOException $e) {
update($pdo, $table, $primaryKey, $record);
}
}


