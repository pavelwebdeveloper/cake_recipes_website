<?php

namespace CakeRecipesdb\Controllers;
use \Ninja\DatabaseTable;

class Cake{
        private $authorsTable;
        private $cakeRecipesTable;
        
       
        
        public function __construct(DatabaseTable $cakeRecipesTable,
                 DatabaseTable $authorsTable) {
                 $this->cakeRecipesTable = $cakeRecipesTable;
                 $this->authorsTable = $authorsTable;
                 }
         
                 
        public function listCakes(){
                  
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

                           return ['template' => 'cake_recipes.html.php', 'title' => $title,
                                      'variables' => [
                                      'totalCakeRecipes' => $totalCakeRecipes,
                                      'cakes' => $cakes
                                      ]
                                   ];
                   
                 }
                 
        public function home(){
                          $title = 'Cake Recipes Database';

                          return ['template' => 'home.html.php', 'title' => $title];

                          include __DIR__ . '/../templates/layout.html.php';                   
                 }
                 
        public function delete(){
         
                          $this->cakeRecipesTable->delete($_POST['cakeId']);

                          header('location: /phpprojects/cake_recipes/public/index.php/cake/list');
                 }
                 
                 
        public function edit(){
                          if (isset($_POST['cake'])) {
                          $cake = $_POST['cake'];
                          $cake['cakeDate'] = new \DateTime();
                          $cake['authorId'] = 1;

                          $this->cakeRecipesTable->save($cake);

                          header('location: /phpprojects/cake_recipes/public/index.php/cake/list');

                          } else {
                           if (isset($_GET['id'])) {
                          $cake = $this->cakeRecipesTable->getItemById($_GET['id']);
                           }
                          $title = 'Add or edit cake recipe';


                          return ['template' => 'edit_cake_recipe.html.php', 'title' => $title,
                                        'variables' => [
                                        'cake' => $cake ?? null
                                        ]
                                    ];
                          }
                 }
}

