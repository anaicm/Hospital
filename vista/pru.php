<?php
echo 'hola';
echo $_POST['username'];
echo $_POST['password'];
if(isset($_POST['login']))
echo "Jan";
else
 echo "June";

?>

<div class="login_box">
    <h2>Login</h2>
    <?php if (!empty($msg)): ?>
    <p><?php echo $msg; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <div class="form_login">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form_login">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form_login button">
            <input type="submit" id="login" name="login" value="Login">
        </div>
        <div class="contra_olvidar">
            <p><a href="#">¿Has olvidado tú contraseña?</a></p>
            <p><a href="index.php">Volver</a></p>
        </div>
    </form>
</div>