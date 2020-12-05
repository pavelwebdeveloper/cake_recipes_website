
<?php //echo var_dump($cake); ?>
<form action="" method="post">
<input type="hidden" name="cake[cakeId]"
value="<?=$cake['cakeId'] ?? ''?>
">
<label for="cake_name">Edit your cake name here:</label><br>
<input type="text" id="cakeName" name="cake[cakeName]" value="<?=$cake['cakeName'] ?? ''?>"><br>
        <label for="cake_ingredients">Edit the necessary ingredients for your cake here:</label><br>
<textarea id="cakeIngredients" name="cake[cakeIngredients]"
          rows="3" cols="40"><?=$cake['cakeIngredients'] ?? ''?>
</textarea><br>
 <label for="cake_recipe_text">Edit your cake recipe here:</label><br>
<textarea id="cakeRecipe" name="cake[cakeRecipe]"
rows="3" cols="40"><?=$cake['cakeRecipe'] ?? ''?>
</textarea><br>
<label for="cake_cuisine">Edit the cake cuisine here:</label><br>
<input type="text" id="cakeCuisine" name="cake[cakeCuisine]" value="<?=$cake['cakeCuisine'] ?? ''?>"><br>
<label for="cake_picture">Edit the picture path here:</label><br>
<input type="text" id="cakePicture" name="cake[cakePicture]" placeholder="images/besquit_cake.jpg" value="<?=$cake['cakePicture'] ?? ''?>"><br><br>
<input type="submit" value="Save the edited cake recipe"><br>
</form>

