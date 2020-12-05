<?php

namespace Cakesdb;

class CakesdbRoutes  implements \Ninja\Routes {
          public function getRoutes() {
                                       
                                include __DIR__ . '/../../includes/DatabaseConnection.php';
                                //include __DIR__ . '/../classes/DatabaseTable.php';
                                $cakesTable = new \Ninja\DatabaseTable($pdo, 'cake', 'cakeId');
                                $authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');
                                
                                $cakeController = new \Cakesdb\Controllers\Cake($cakesTable, $authorsTable);
                                
                                $authorController = new \Cakesdb\Controllers\Register($authorsTable);
                                
                                //$pattern = 'phpprojects/cake_recipes/public/index.php'."[abc]";
                                
                                $routes = [
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
                                     ]
                                     ],
                                     'phpprojects/cake_recipes/public/index.php/cake/delete' => [
                                     'POST' => [
                                     'controller' => $cakeController,
                                     'action' => 'delete'
                                     ]
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
}

