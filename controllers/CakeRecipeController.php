<?php

class CakeRecipeController{
        private $authorsTable;
        private $cakeRecipesTable;
        
        public function __construct(DatabaseTable $cakeRecipesTable,
                 DatabaseTable $authorsTable) {
                 $this->cakeRecipesTable = $cakeRecipesTable;
                 $this->authorsTable = $authorsTable;
                 }
                 
                 public function listCakeRecipes(){
                  
                  //echo $result = $this->cakeRecipesTable->findAll();
                  
                  
                  $result = $this->cakeRecipesTable->findAll();

                  $cakes = [];
                  foreach ($result as $cake) {
                  $author = $this->authorsTable->getItemById($cake['authorId']);
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


                  $totalCakeRecipes = $this->cakeRecipesTable->totalRecords();

                  $title = 'Cake recipes list';

                  // Start the buffer
                  //ob_start();

                  // Include the template. The PHP code will be executed,
                  // but the resulting HTML will be stored in the buffer
                  // rather than sent to the browser.
                  //include __DIR__ . '/../templates/cake_recipes.html.php';
                  // Read the contents of the output buffer and store them
                  // in the $output variable for use in layout.html.php
                  //$output =  ob_get_clean();
                  
                  return ['template' => 'cake_recipes.html.php', 'title' => $title];
                   
                 }
                 
                 public function home(){
                  $title = 'Cake Recipes Database';
                  //ob_start();
                  //include __DIR__ . '/../templates/home.html.php';
                  //$output = ob_get_clean();
                  
                  return ['template' => 'home.html.php', 'title' => $title];
                  
                  include __DIR__ . '/../templates/layout.html.php';
                   
                 }
                 
                 public function delete(){
                  $this->cakeRecipesTable->delete($_POST['cakeId']);

                  header('location: index.php?action=listCakeRecipes');
                 }
                 
                 public function edit(){
                 if (isset($_POST['cake'])) {
                 $cake = $_POST['cake'];
                 $cake['cakeDate'] = new DateTime();
                 $cake['authorId'] = 1;
                 $this->cakeRecipesTable->save($cake);


                 header('location: index.php?action=listCakeRecipes');
                 } else {
                  if (isset($_GET['id'])) {
                 $cake = $this->cakeRecipesTable->getItemById($_GET['id']);
                  }
                 $title = 'Add or edit cake recipe';
                 //ob_start();
                 //include __DIR__ . '/../templates/edit_cake_recipe.html.php';
                 //$output = ob_get_clean();
                 
                 return ['template' => 'edit_cake_recipe.html.php', 'title' => $title];
                 }
                 }
}

