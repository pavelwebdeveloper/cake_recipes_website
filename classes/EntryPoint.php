<?php

class EntryPoint {
      private $route;
      private $routes;
      
             public function __construct($route, $routes){
                      $this->route = $route;
                      $this->routes = $routes;
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
                        include __DIR__ . '/../templates/' . $templateFileName;
                        // Read the contents of the output buffer and store them in the $output variable for use in layout.html.php
                        return ob_get_clean();                  
               }
                        
                     
             public function run() {
                          $page = $this->routes->callAction($this->route);
                          $title = $page['title'];
                          if (isset($page['variables'])) {
                          $output = $this->loadTemplate($page['template'], $page['variables']);
                          } else {
                          $output = $this->loadTemplate($page['template']);
                          }
                          include __DIR__ . '/../templates/layout.html.php';
                   }

      }

