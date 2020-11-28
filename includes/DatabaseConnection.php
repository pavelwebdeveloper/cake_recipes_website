<?php

$pdo = new PDO('mysql:host=localhost;dbname=cake_recipes;charset=utf8',
'proxyClient', 'iMi20GYnzHXRrJ9B');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

