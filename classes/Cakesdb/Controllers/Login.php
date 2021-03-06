<?php

namespace Cakesdb\Controllers;

class Login
{
 private $authentication;
 
public function __construct(\Ninja\Authentication
$authentication)
{
$this->authentication = $authentication;
}

public function loginForm() {
return ['template' => 'login.html.php',
'title' => 'Log In'];
}

public function processLogin() {
if ($this->authentication->login($_POST['email'],
$_POST['password'])) {
header('location: /phpprojects/cake_recipes/public/index.php/login/success');
}
else {
return ['template' => 'login.html.php',
'title' => 'Log In',
'variables' => [
'error' => 'Invalid username/password.'
]
];
}
}

public function logout() {
session_destroy();
unset($_SESSION);
return ['template' => 'logout.html.php',
'title' => 'You have been logged out'];
}


public function success() {
return ['template' => 'loginsuccess.html.php',
'title' => 'Login Successful'];
}

 
public function error()
{
return ['template' => 'loginerror.html.php', 'title'
=> 'You are not logged in'];
}
}

