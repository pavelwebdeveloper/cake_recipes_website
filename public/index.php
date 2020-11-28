<?php

// This is the cakes website controller
//require_once __DIR__ . '/../library/connections.php';



$title = 'Cake Recipes Database';
ob_start();
include __DIR__ . '/../templates/home.html.php';
$output = ob_get_clean();
include __DIR__ . '/../templates/layout.html.php';


