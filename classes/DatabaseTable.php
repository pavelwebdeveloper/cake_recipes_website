<?php

class DatabaseTable
{
       private $pdo;
       private $table;
       private $primaryKey;
       
       public function __construct(PDO $pdo, string $table, string $primaryKey) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        }

       private function query($sql, $parameters = []) {
       $query = $this->pdo->prepare($sql);
       $query->execute($parameters);
       return $query;
       }

       private function processDates($fields) {
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
       public function totalRecords() {
        // Call the query function and pass it the empty $parameters array
       $query = $this->query('SELECT COUNT(*) FROM '.$this->table);
       $row = $query->fetch();
       return $row[0];
       }


       // a shorter version of the function to get a specific cake recipe from the database
       public function getItemById($id) {
        // Create the array of $parameters for use in the query function
       $parameters = [':id' => $id];
       // call the query function and provide the $parameters array
       $query = $this->query('SELECT * FROM `'.$this->table.'`WHERE `'.$this->primaryKey.'` = :id', $parameters);
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

       private function insert($fields) {
       $query = 'INSERT INTO '.$this->table.' (';

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

       $fields = $this->processDates($fields);

         $this->query($query, $fields);

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
       private function update($fields) {
        
                        
        $query = 'UPDATE `'.$this->table.'` SET ';

        // Loop through the array of fields
         foreach ($fields as $key => $value) {
       $query .= '`' . $key . '` = :' . $key . ',';
       }
       $query = rtrim($query, ',');
       $query .= ' WHERE `'.$this->primaryKey.'` = :primaryKey';

       $fields = $this->processDates($fields);

       // Set the :primaryKey variable
       $fields['primaryKey'] = $fields[$this->primaryKey];  
      
       $this->query($query, $fields);
         
       }

       /*
       function getAllCakeRecipes($pdo) {
       $cakes = query($pdo, 'SELECT cakeId, cakeName, cakeIngredients, cakeRecipe, cakeCuisine, cakePicture, cakeDate, name, email FROM cake INNER JOIN author ON authorId = author.id');
       return $cakes->fetchAll();
       }
        * *
        */


       // a function to  retrieve all the records from any database table
       public function findAll() {
       $result = $this->query('SELECT * FROM `' . $this->table . '`');
       return $result->fetchAll();
       }

       public function delete($id) {
       $parameters = [':id' => $id];
       $this->query('DELETE FROM `' . $this->table . '`
       WHERE `'.$this->primaryKey.'` = :id', $parameters);
       }

       public function save($record) {        
        
       try {
       if ($record[$this->primaryKey] == '') {
       $record[$this->primaryKey] = null;
       }
       $this->insert($record);
       }
       catch (PDOException $e) {
       $this->update($record);
       }
       
       }
       
}
