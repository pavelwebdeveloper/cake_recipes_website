<?php

// Include the file that creates the $pdo variable and connects to the database
include_once __DIR__ .
'/../includes/DatabaseConnection.php';
// Include the file that provides the `totalJokes` function
include_once __DIR__ .
'/../includes/DatabaseFunctions.php';
// Call the function
echo totalCakeRecipes($pdo)."<br>";

$cakeRecipe1 = getCakeRecipe($pdo, 1);
echo $cakeRecipe1['cakeRecipe']."<br>";


$cakeRecipe2 = getCakeRecipe($pdo, 2);
echo $cakeRecipe2['cakeRecipe'];

$date = new DateTime();

echo "<br>".$date->format('Y-m-d H:i:s');


/*
updateCakeRecipe($pdo, 12, 'Apricot feast', 'apricots 20, flour 1,5 kg, sour cream 1,5 cups, sugar 200gr', 'mix apricots and flour, stir, add sour cream and sugar, mix again then bake for 1 hour at 220C', 'American cuisine', 'images/apricot_feast_cake.jpg', 1);

/*
insertCakeRecipe($pdo, 'Besquit', 'Chokolate 40gr, milk 1liter, flour 1kg, sugar 50gr, hazelnuts 100gr, 3 eggs', 'Stir the ingredients together, add the eggs, stir again for 5 minutes, bake in the oven at 150C', 'European Cuisine', 'images/besquit_cake.jpg', 1);


insertCakeRecipe($pdo, 'Lemon Pound Cake', '1 cup unsalted butter, 1 cup granulated sugar, 2 lemons, 3 eggs, 2 cups of flour', 'Stir the ingredients together, add the eggs, bake in the oven at 250C', 'European Cuisine', 'images/lemon_pound_cake.jpg', 1);
 

