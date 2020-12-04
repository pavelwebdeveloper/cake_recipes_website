<?php

class CakeRecipesdbRoutes {
          public function callAction($route) {
                                       /*
                                                 function autoloader($className) {
                                      $file = __DIR__ . '/../classes/' . $className . '.php';
                                      include $file;
                                      }
                                      spl_autoload_register('autoloader');
                                      * *
                                      */
                                include __DIR__ . '/../includes/DatabaseConnection.php';
                                include __DIR__ . '/../classes/DatabaseTable.php';
                                $cakeRecipesTable = new DatabaseTable($pdo, 'cake', 'cakeId');
                                $authorsTable = new DatabaseTable($pdo, 'author', 'id');

                                        if ($route === 'phpprojects/cake_recipes/public/index.php/cake/list') {
                                        include __DIR__ . '/../classes/controllers/CakeController.php';
                                        $controller = new CakeController($cakeRecipesTable,
                                        $authorsTable);
                                        $page = $controller->listCakes();
                                    } elseif ($route === 'phpprojects/cake_recipes/public/index.php') { 
                                        include __DIR__ . '/../classes/controllers/CakeController.php';
                                        $controller = new CakeController($cakeRecipesTable,
                                        $authorsTable);
                                        $page = $controller->home();
                                    } elseif ($route === 'phpprojects/cake_recipes/public/index.php/cake/edit') {
                                        include __DIR__ . '/../classes/controllers/CakeController.php';
                                        $controller = new CakeController($cakeRecipesTable,
                                        $authorsTable);
                                        $page = $controller->edit();
                                    } elseif ($route === 'phpprojects/cake_recipes/public/index.php/cake/delete') {
                                       include __DIR__ . '/../classes/controllers/CakeController.php';
                                       $controller = new CakeController($cakeRecipesTable,
                                       $authorsTable);
                                       $page = $controller->delete();
                                    } elseif ($route === 'phpprojects/cake_recipes/public/index.php/register') {
                                       include __DIR__ .
                                       '/../classes/controllers/RegisterController.php';
                                       $controller = new RegisterController($authorsTable);
                                       $page = $controller->showForm();
                                   } else {
                                      // telling the search engine that redirect is permanent with code 301 
                                      http_response_code(301);
                                      header('location: /phpprojects/cake_recipes/public/index.php?route=' . strtolower($route));
                                   }
                                   return $page;                       
                              }
}

