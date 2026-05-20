<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>POC Controle Financeiro - Login</title>
    <link rel="stylesheet" href="style.css">

    <?php
    /**
     * @var string $csrf_token
     */
    ?>
    
</head>
<nav class="navbar">
        <a href="index.php?action=dashboard" class="navbar-brand">POC Financeiro</a>
        <ul class="navbar-menu">
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <li><a href="index.php?action=dashboard">Meu Painel</a></li>
                <li><a href="index.php?action=logout" class="btn-sair-nav">Sair</a></li>
            <?php else: ?>
                <li><a href="index.php?action=login">Acessar Conta</a></li>
                <li><a href="index.php?action=cadastro">Abrir Conta</a></li>
            <?php endif; ?>
        </ul>
    </nav>

<body>
    <div class="container">
        <h1>Acesso ao Sistema</h1>

        <?php if (isset($erro)): ?>
            <p class="mensagem-erro"><?= htmlspecialchars($erro) ?></p>
        <?php endif; ?>

        <form method="POST" action="index.php?action=login" class="form-auth">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required autocomplete="email">
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn-submit">Entrar</button>
        </form>

        <p class="link-redirecionamento">
            Não possui conta? <a href="index.php?action=cadastro">Cadastre-se aqui</a>
        </p>
    </div>
</body>

</html>