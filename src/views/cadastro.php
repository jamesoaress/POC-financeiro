<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>POC Controle Financeiro - Cadastro Seguro</title>
    <?php
    /**
     * @var string $csrf_token
     
     */
    ?>
</head>
<body>
    <h1>Cadastro de Novo Usuário</h1>
    
    <!-- Formulário protegido contra ataques CSRF -->
    <form method="POST" action="index.php">
        <!-- Campo oculto para roteamento no index.php -->
        <input type="hidden" name="acao" value="cadastrar">
        
        <!-- Token CSRF gerado pelo backend -->
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

        <div style="margin-bottom: 10px;">
            <label>Nome:</label><br>
            <input type="text" name="nome" required size="50" autocomplete="name">
        </div>

        <div style="margin-bottom: 10px;">
            <label>E-mail:</label><br>
            <input type="email" name="email" required size="50" autocomplete="email">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Senha:</label><br>
            <input type="password" name="senha" required size="50" autocomplete="new-password">
        </div>

        <button type="submit">Cadastrar Segurança</button>
    </form>

    <br>
    <a href="index.php">Voltar ao Dashboard</a>
</body>
</html>