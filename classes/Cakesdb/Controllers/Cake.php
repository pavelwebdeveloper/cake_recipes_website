<?php

namespace Cakesdb\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Cake{
        private $authorsTable;
        private $cakesTable;
        
       
        
        public function __construct(DatabaseTable $cakesTable, DatabaseTable $authorsTable,
Authentication $authentication) {
                 $this->cakesTable = $cakesTable;
                 $this->authorsTable = $authorsTable;
                 $this->authentication = $authentication;
                 }
         
                 
        public function listCakes(){
                  
                           $result = $this->cakesTable->findAll();

                           $cakes = [];
                           foreach ($result as $cake) {
                           $author = $this->authorsTable->findById($cake['authorId']);
                           $cakes[] = [
                           'cakeId' => $cake['cakeId'],
                           'cakeName' => $cake['cakeName'],
                           'cakeIngredients' => $cake['cakeIngredients'],
                           'cakeRecipe' => $cake['cakeRecipe'],
                           'cakeCuisine' => $cake['cakeCuisine'],
                           'cakePicture' => $cake['cakePicture'],
                           'cakeDate' => $cake['cakeDate'],
                           //'authorId' => $cake['authorId'],
                           'name' => $author['name'],
                           'email' => $author['email']
                           ];
                           }

                           $totalCakes = $this->cakesTable->totalRecords();

                           $title = 'Cake recipes list';

                           return ['template' => 'cake_recipes.html.php', 'title' => $title,
                                      'variables' => [
                                      'totalCakes' => $totalCakes,
                                      'cakes' => $cakes
                                      ]
                                   ];
                   
                 }
                 
        public function home(){
                          $title = 'Cake Recipes Database';                
                          
                          
                          return ['template' => 'home.html.php', 'title' => $title];

                          //include __DIR__ . '/../templates/layout.html.php';                   
                 }
                 
                 
        public function delete(){
         
                          $this->cakesTable->delete($_POST['cakeId']);

                          header('location: /phpprojects/cake_recipes/public/index.php/cake/list');
                 }
        
                 
        public function saveEdit() {
         
                         $author = $this->authentication->getUser();
         
                         $cake = $_POST['cake'];
                         //echo var_dump($cake);
                         //exit;
                         /*
                         echo var_dump($cake)."<br><br>";
                         echo var_dump($cake['cakeDate']);
                         echo var_dump($cake['authorId']);
                         exit;
                          * *
                          */
                         
                         if(empty($cake['cakeDate'])){
                         $cake['cakeDate'] = new \DateTime();
                         }
                         
                         $cake['authorId'] = $author['id'];
                         
                          
                         //$cake['authorId'] = 1;
                         $this->cakesTable->save($cake);
                         header('location: /phpprojects/cake_recipes/public/index.php/cake/list');
               }
                 
                 
        public function edit(){
         
         /*
        }
                          if (isset($_POST['cake'])) {
                          $cake = $_POST['cake'];
                          $cake['cakeDate'] = new \DateTime();
                          $cake['authorId'] = 1;

                          $this->cakeRecipesTable->save($cake);

                          header('location: /phpprojects/cake_recipes/public/index.php/cake/list');

                          } else {
          * *
          */
                           if (isset($_GET['id'])) {
                          $cake = $this->cakesTable->findById($_GET['id']);
                          }
                          $title = 'Add or edit cake recipe';


                          return ['template' => 'edit_cake_recipe.html.php', 'title' => $title,
                                        'variables' => [
                                        'cake' => $cake ?? null
                                        ]
                                    ];                          
                 }        
}

