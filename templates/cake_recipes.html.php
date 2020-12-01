
<?php //var_dump($cakes);?>

<p><?=$variables['totalCakeRecipes']?> cake recipes have been submitted to the Internet Cake Recipe Database.</p>

<?='<ul>'?>
<?php foreach ($cakes as $cake): ?>
<blockquote>
<p> 
 <?php //var_dump($cake); echo "<br>";?>
 <?='<li>'?>
 <?="<b>Cake</b> ".htmlspecialchars($cake['cakeName'], ENT_QUOTES, 'UTF-8')."<br>"?>
 <?="<b>ingredients</b>: ".htmlspecialchars($cake['cakeIngredients'], ENT_QUOTES, 'UTF-8')."<br>"?>
 <?="<b>recipe</b>: ".htmlspecialchars($cake['cakeRecipe'], ENT_QUOTES, 'UTF-8')."<br>"?>
 <?="<b>cuisine</b>: ".htmlspecialchars($cake['cakeCuisine'], ENT_QUOTES, 'UTF-8')."<br>"?>
 
(by <a href="mailto:<?php
echo htmlspecialchars($cake['email'], ENT_QUOTES,
'UTF-8'); ?>"><?php
echo htmlspecialchars($cake['name'], ENT_QUOTES,
'UTF-8'); ?></a> on <?php
$date = new DateTime($cake['cakeDate']);
echo $date->format('jS F Y');
?>)
</p>

<a href="index.php?action=edit&id=<?=$cake['cakeId']?>">
Edit the cake recipe</a>

<form action="index.php?action=delete" method="post">
 <input type="hidden" id="cakeId" name="cakeId"
         value="<?=$cake['cakeId'];?>">
 <input class="submitBtn" type="submit" value="Delete the recipe">
  </form>
<?='</li>'?>
</blockquote>
<?php endforeach; ?>
<?='</ul>'?>

