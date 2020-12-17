<?php

if (isset($error)):
echo '<div class="errors">' . $error . '</div>';
endif;
?>
<form method="post" action="">
<label for="email">Your email address</label><br>
<input type="text" id="email" name="email"><br>
<label for="password">Your password</label><br>
<input type="password" id="password" name="password"><br><br>
<input type="submit" name="login" value="Log in">
</form>
<p>Don't have an account? <a href="/phpprojects/cake_recipes/public/index.php/author/register">Click here to register an account</a></p>

