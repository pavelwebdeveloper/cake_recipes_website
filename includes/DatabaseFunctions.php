<?php

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


