<?php

namespace Cakesdb\Controllers;
use \Ninja\DatabaseTable;
class Register
{
    private $authorsTable;
       public function __construct(DatabaseTable $authorsTable)
       {
          $this->authorsTable = $authorsTable;
       }

       public function registrationForm()
       {
         return ['template' => 'register.html.php',
         'title' => 'Register an account'];
       }

       public function success()
       {
        return ['template' => 'registersuccess.html.php',
        'title' => 'Registration Successful'];
       }

       public function registerUser() {
         // echo var_dump($_POST);
         // exit;
         $author = $_POST['author'];

         // Assume the data is valid to begin with
         $valid = true;
         // But if any of the fields have been left blank
         // set $valid to false
         if (empty($author['name'])) {
         $valid = false;
         }
         if (empty($author['email'])) {
         $valid = false;
         }
         if (empty($author['password'])) {
         $valid = false;
         }
         // If $valid is still true, no fields were blank
         // and the data can be added
         if ($valid == true) {

         $this->authorsTable->save($author);
         header('Location: phpprojects/cake_recipes/public/index.php/author/success');
         } else {
          // If the data is not valid, show the form again
         return ['template' => 'register.html.php',
         'title' => 'Register an account'];
         }
       }

}

