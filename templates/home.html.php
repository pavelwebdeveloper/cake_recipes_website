<?php 

// counting visits to this page with a cookie
/*
if($browser=='Chrome'){
   if (!isset($_COOKIE['visits'])) {
   $_COOKIE['visits'] = 0;
   }
   $visits = $_COOKIE['visits'];
   
   if ($_COOKIE['visits'] > 1) {
   echo "This is visit number $visits.";
   } else {
   // First visit
   echo 'Welcome to our website! Click here for a tour!';
   }
   $visits++;
   setcookie('visits', $visits, time() + 3600 * 24 * 365);
} else {
   if (!isset($_COOKIE['visits'])) {
   $_COOKIE['visits'] = 0;
   }
   $visits = $_COOKIE['visits'] + 1;
   setcookie('visits', $visits, time() + 3600 * 24 * 365);
   if ($visits > 1) {
   echo "This is visit number $visits.";
   } else {
   // First visit
   echo 'Welcome to our website! Click here for a tour!';
   }
}*/
 

// counting visits to this page with a session

session_start();
if (!isset($_SESSION['visits'])) {
$_SESSION['visits'] = 0;
}
$_SESSION['visits'] = $_SESSION['visits'] + 1;
if ($_SESSION['visits'] > 1) {
echo 'This is visit number ' . $_SESSION['visits'];
} else {
// First visit
echo 'Welcome to my website! Click here for a tour!';
}

echo "<h2>Internet Cake Database</h2>
<p>Welcome to the Internet Cake Database</p>";

