<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cake recipes</title>
</head>
<body>
<?php if (isset($error)): ?>
<p>
<?=$error; ?>
</p>
<?php else: ?>
<?php foreach ($cakeRecipes as $cakeRecipe): ?>
<blockquote>
<p>
<?=htmlspecialchars($cakeRecipe,
ENT_QUOTES, 'UTF-8') ?>
</p>
</blockquote>
<?php endforeach; ?>
<?php endif; ?>
</body>
</html>
