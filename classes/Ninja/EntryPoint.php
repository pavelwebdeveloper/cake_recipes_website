<?php

namespace Ninja;

class EntryPoint {
      private $route;
      private $method;
      private $routes;
      
             public function __construct(string $route, string $method, \Ninja\Routes $routes){
                      $this->route = $route;
                      $this->routes = $routes;
                      $this->method = $method;
                      $this->checkUrl();
                      }
                      
             private function checkUrl() {
                       if ($this->route !== strtolower($this->route)) {
                       http_response_code(301);
                       header('location: ' . strtolower($this->route));
                       }
             }
             
             private function loadTemplate($templateFileName, $variables = []){
                        extract($variables);
                        // Start the buffer
                        ob_start();
                        // Include the template. The PHP code will be executed, but the resulting HTML will be stored in the buffer
                        // rather than sent to the browser.
                        include __DIR__ . '/../../templates/' . $templateFileName;
                        // Read the contents of the output buffer and store them in the $output variable for use in layout.html.php
                        return ob_get_clean();                  
               }
                        
                     
             public function run() {
                          $routes = $this->routes->getRoutes();
                          //echo var_dump($routes);
                          //exit;
                          $controller = $routes[$this->route][$this->method]['controller'];
                          $action = $routes[$this->route][$this->method]['action'];
                          //echo var_dump($controller);
                          //exit;
                          
                          // if $controller is not set bacuse no routes match in the $routes array in the CakesdbRouts class then redirect                            //to home page
                          if(!isset($controller)){
                           http_response_code(301);
                           header('location: /phpprojects/cake_recipes/public/index.php?route=' . strtolower($route));
                          }
                          
                          //$method = $_SERVER['REQUEST_METHOD'];
                          //$route = $_SERVER['REQUEST_URI'];
                          $page =  $controller->$action();
                          $title = $page['title'];
                          if (isset($page['variables'])) {
                          $output = $this->loadTemplate($page['template'], $page['variables']);
                          } else {
                          $output = $this->loadTemplate($page['template']);
                          }
                          include __DIR__ . '/../../templates/layout.html.php';
                   }

      }

