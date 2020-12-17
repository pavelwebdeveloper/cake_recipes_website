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
              /*echo "Inside the loadTemplate function"."<br>";
                           echo var_dump($variables);
                           exit;*/
                       extract($variables);
                        
                        // Start the buffer
                        ob_start();
                        // Include the template. The PHP code will be executed, but the resulting HTML will be stored in the buffer
                        // rather than sent to the browser.
                        include __DIR__ . '/../../templates/' . $templateFileName;
                        // Read the contents of the output buffer and store them in the $output variable for use in layout.html.php
                        return ob_get_clean();                  
               }
               
               // function to detect the current browser
                   private function detectBrowser() {
                    if(stripos($_SERVER["HTTP_USER_AGENT"],"Chrome") >0 && stripos($_SERVER["HTTP_USER_AGENT"],"Edg") >0){
                     $browser = "Microsoft Edge";
                    } else if (stripos($_SERVER["HTTP_USER_AGENT"],"Firefox") >0) {
                     $browser = "Firefox";
                    }  else if (stripos($_SERVER["HTTP_USER_AGENT"],"Chrome") >0) {
                     $browser = "Chrome";
                    } else if (stripos($_SERVER["HTTP_USER_AGENT"],"Trident") >0) {
                     $browser = "Internet Explorer";
                    } else {
                     $browser = "an unknown browser";
                    }
                    return $browser;
                   }
                        
                     
             public function run() {
                          $routes = $this->routes->getRoutes();
                          //echo var_dump($this->routes->getAuthentication()->isLoggedIn());
                          //exit;
                          if ( isset($routes[$this->route]['login']) && !$this->routes->getAuthentication()->isLoggedIn()) {
                         // if (isset($routes[$this->route]['login']) && isset($routes[$this->route]['login']) && !$this->routes->getAuthentication()->isLoggedIn()) {
                          //echo "Hi Pasha Ura";
                          //exit;
                          header('location: /phpprojects/cake_recipes/public/index.php/login/error');
                          }
                          else {
                          $controller = $routes[$this->route][$this->method]['controller'];
                          $action = $routes[$this->route][$this->method]['action'];
                          //echo var_dump($controller)."<br>";
                          //echo var_dump($action)."<br>";
                          //exit;
                          
                          // if $controller is not set bacuse no routes match in the $routes array in the CakesdbRouts class then redirect                            //to home page
                          if(!isset($controller)){
                          //echo "Hi Pavel Hi dear friend!!";
                          //exit;
                           http_response_code(301);
                           header('location: /phpprojects/cake_recipes/public/index.php?route=' . strtolower($route));
                          }
                          
                          $browser = "the current browser is ".$this->detectBrowser();
                                                    
                          
                          //$method = $_SERVER['REQUEST_METHOD'];
                          //$route = $_SERVER['REQUEST_URI'];
                          $page =  $controller->$action();
                          $page['variables']['browser'] = $this->detectBrowser();
                         
                          /*
                          echo var_dump($page['variables']);
                          echo "Ura";
                          exit;
                           * *
                           */
                          $title = $page['title'];
                          if (isset($page['variables'])) {
                           /*
                           echo "1st option";
                           echo var_dump($page['variables']);
                           exit;
                            * *
                            */
                          $output = $this->loadTemplate($page['template'], $page['variables']);
                          } else {
                           /*
                           echo "2nd option";
                           echo $page['template'];
                           exit;
                            * *
                            */
                          $output = $this->loadTemplate($page['template'], $page['variables']);
                          }
                          include __DIR__ . '/../../templates/layout.html.php';
                          }
                   }
                   
                   
      }

