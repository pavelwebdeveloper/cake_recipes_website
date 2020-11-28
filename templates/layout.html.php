<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="cake_recipes.css">
<title><?=$title?></title>
</head>
<body>
<header>
<h1>Internet Cake Recipes Database</h1>
</header>
<nav>
 <ul>
<li><a href="index.php">Home</a></li>
<li><a href="cake_recipes.php">Cake Recipes List</a></li>
<li><a href="edit_cake_recipe.php">Add a new Cake Recipe</a></li>
</ul>
</nav>
<main>
<?=$output?>
</main>
<footer>
&copy; IJDB <?php if(date('Y')>2020){echo "2020&ndash;".date('Y');} else { echo date('Y');}?>
</footer>
</body>
</html>
