<?php

namespace Cakesdb;

class CakesdbRoutes  implements \Ninja\Routes {
 
          private $authorsTable;
          private $cakesTable;
          private $authentication;
          
          public function __construct()
                   {
                   include __DIR__ . '/../../includes/DatabaseConnection.php';
                   $this->cakesTable = new \Ninja\DatabaseTable($pdo, 'cake', 'cakeId');
                   $this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');
                   $this->authentication =  new \Ninja\Authentication($this->authorsTable, 'email', 'password');
                   }
 
          public function getRoutes(): array {   
           
            
                                
                                
                                $cakeController = new \Cakesdb\Controllers\Cake($this->cakesTable, $this->authorsTable,
                                        $this->authentication);
                                
                                $authorController = new \Cakesdb\Controllers\Register($this->authorsTable);
                                
                                $loginController = new \Cakesdb\Controllers\Login($this->authentication);
                                                                                             
                                $routes = [
                                    'phpprojects/cake_recipes/public/index.php/login' => [
                                    'GET' => [
                                    'controller' => $loginController,
                                    'action' => 'loginForm'
                                        ],
                                    'POST' => [
                                    'controller' => $loginController,
                                    'action' => 'processLogin'
                                    ]
                                    ],
                                    'phpprojects/cake_recipes/public/index.php/login/success' => [
                                    'GET' => [
                                    'controller' => $loginController,
                                    'action' => 'success'
                                    ],
                                    'login' => true
                                    ],
                                    'phpprojects/cake_recipes/public/index.php/logout' => [
                                    'GET' => [
                                    'controller' => $loginController,
                                    'action' => 'logout'
                                    ]
                                    ],
                                    'phpprojects/cake_recipes/public/index.php/author/register' => [
                                    'GET' => [
                                    'controller' => $authorController,
                                    'action' => 'registrationForm'
                                    ],
                                    'POST' => [
                                    'controller' => $authorController,
                                    'action' => 'registerUser'
                                    ]
                                    ],
                                    'phpprojects/cake_recipes/public/index.php/author/success' => [
                                    'GET' => [
                                    'controller' => $authorController,
                                    'action' => 'success'
                                    ]
                                    ],
                                     'phpprojects/cake_recipes/public/index.php/cake/edit' => [
                                     'POST' => [
                                     'controller' => $cakeController,
                                     'action' => 'saveEdit'
                                     ],
                                     'GET' => [
                                     'controller' => $cakeController,
                                     'action' => 'edit'
                                     ],
                                     'login' => true
                                     ],
                                     'phpprojects/cake_recipes/public/index.php/cake/delete' => [
                                     'POST' => [
                                     'controller' => $cakeController,
                                     'action' => 'delete'
                                     ],
                                     'login' => true
                                     ],
                                     'phpprojects/cake_recipes/public/index.php/cake/list' => [
                                     'GET' => [
                                     'controller' => $cakeController,
                                     'action' => 'listCakes'
                                     ]
                                     ],
                                     'phpprojects/cake_recipes/public/index.php' => [
                                     'GET' => [
                                     'controller' => $cakeController,
                                     'action' => 'home'
                                     ]
                                     ],
                                     'phpprojects/cake_recipes/public/index.php/login/error' => [
                                     'GET' => [
                                     'controller' => $loginController,
                                     'action' => 'error'
                                     ]
                                     ]
                                  ];
                                
                                return $routes;
                           


/*
                                        if ($route === 'phpprojects/cake_recipes/public/index.php/cake/list') {
                                        //include __DIR__ . '/../classes/controllers/CakeController.php';
                                        $controller = new \CakeRecipesdb\Controllers\Cake($cakeRecipesTable,
                                        $authorsTable);
                                        $page = $controller->listCakes();
                                    } elseif ($route === 'phpprojects/cake_recipes/public/index.php') { 
                                        //include __DIR__ . '/../classes/controllers/CakeController.php';
                                        $controller = new \CakeRecipesdb\Controllers\Cake($cakeRecipesTable,
                                        $authorsTable);
                                        $page = $controller->home();
                                    } elseif ($route === 'phpprojects/cake_recipes/public/index.php/cake/edit') {
                                        //include __DIR__ . '/../classes/controllers/CakeController.php';
                                        $controller = new \CakeRecipesdb\Controllers\Cake($cakeRecipesTable,
                                        $authorsTable);
                                        $page = $controller->edit();
                                    } elseif ($route === 'phpprojects/cake_recipes/public/index.php/cake/delete') {
                                       //include __DIR__ . '/../classes/controllers/CakeController.php';
                                       $controller = new \CakeRecipesdb\Controllers\Cake($cakeRecipesTable,
                                       $authorsTable);
                                       $page = $controller->delete();
                                    } elseif ($route === 'phpprojects/cake_recipes/public/index.php/register') {
                                       //include __DIR__ . '/../classes/controllers/RegisterController.php';
                                       $controller = new \CakeRecipesdb\Controllers\Register($authorsTable);
                                       $page = $controller->showForm();
                                   } else {
                                      // telling the search engine that redirect is permanent with code 301 
                                      http_response_code(301);
                                      header('location: /phpprojects/cake_recipes/public/index.php?route=' . strtolower($route));
                                   }
                                   return $page;     
 * *
 */                  
                              }
                              
            public function getAuthentication():  \Ninja\Authentication
                     {
                     return $this->authentication;
                     }
}

