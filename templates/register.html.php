<?php
if (!empty($errors)) :
?>
<div class="errors">
<p>Your account could not be created, please check the following:</p>
<ul>
<?php
foreach ($errors as $error) :
?>
<li><?= $error ?></li>
<?php
endforeach; ?>
</ul>
</div>
<?php
endif;
?>
<form action="" method="post">
<label for="email">Your email address</label><br>
<input name="author[email]" id="email" type="text" value="<?=$author['email'] ?? ''?>"><br>
<label for="name">Your name</label><br>
<input name="author[name]" id="name" type="text" value="<?=$author['name'] ?? ''?>"><br>
<label for="password">Password</label><br>
<input name="author[password]" id="password"
type="password" value="<?=$author['password'] ?? ''?>"><br><br>
<input type="submit" name="submit"
value="Register account"><br><br>
</form>

