<?php
include('../api/api_log.php');
?>
<link rel="stylesheet" href="../css/log.css">
<div class="login-card">
<form action="login.php" method="POST">
    <div class="input-group">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="input-group">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
    </div>
    <div class="input-group">
        <button type="submit">Entrar</button>
    </div>
</form>

</div>
