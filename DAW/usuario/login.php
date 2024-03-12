<!DOCTYPE html>
<?php session_start();?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="login_ok.php">
        <label>Email</label><br>
        <input type="text" id="email" name="login" value="<?php echo @$_SESSION['log_val'];?>" required>
        <?php
            if(isset($_SESSION['log_erro'])){
                echo "<p id='log_erro'>Usuário Incorreto</p>";
                unset($_SESSION['log_erro']);
            }else{echo"<br>";}
        ?>
        <br>
        <label>Senha</label><br>
        <input type="password" id="password" name="password" required><br>
        <?php
            if(isset($_SESSION['senha_erro'])){
                echo "<p id='log_erro'>Senha Incorreta</p>";
                unset($_SESSION['senha_erro']);
            }else{echo"<br>";}
        ?>
        <button type="submit" id="submit">Enviar</button>
    </form>
</body>
</html>