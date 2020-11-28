
<?php //echo var_dump($cake); ?>
<form action="" method="post">
<input type="hidden" name="cakeId"
value="<?=$cake['cakeId'] ?? ''?>
">
<label for="cake_name">Edit your cake name here:
</label>
<input type="text" id="cake_name" name="cake_name" value="<?=$cake['cakeName'] ?? ''?>">
        <label for="cake_ingredients">Edit the necessary ingredients for your cake here:
</label>
<textarea id="cake_ingredients" name="cake_ingredients"
rows="3" cols="40"><?=$cake['cakeIngredients'] ?? ''?>
</textarea>
 <label for="cake_recipe_text">Edit your cake recipe here:
</label>
<textarea id="cake_recipe_text" name="cake_recipe_text"
rows="3" cols="40"><?=$cake['cakeRecipe'] ?? ''?>
</textarea>
<label for="cake_cuisine">Edit the cake cuisine here:
</label>
<input type="text" id="cake_cuisine" name="cake_cuisine" value="<?=$cake['cakeCuisine'] ?? ''?>">
<label for="cake_picture">Edit the picture path here:
</label>
<input type="text" id="cake_picture" name="cake_picture" placeholder="images/besquit_cake.jpg" value="<?=$cake['cakePicture'] ?? ''?>">
<input type="submit" value="Save the edited cake recipe">
</form>

