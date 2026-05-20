<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>POC Controle Financeiro - Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <?php
    /**
     * @var string $csrf_token
     * @var array $transacoes
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
    <div class="container dashboard-container">

        <header class="cabecalho-sistema">
            <span class="info-usuario">
                Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!
            </span>
            <a href="index.php?action=logout" class="btn-sair">Sair do Sistema</a>
        </header>

        <h1>Nova Transação</h1>

        <form method="POST" action="index.php?action=dashboard" class="form-transacao">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">

            <div class="form-group row">
                <label for="descricao">Descrição (Tente injetar o XSS aqui):</label>
                <input type="text" id="descricao" name="descricao" required placeholder="<script>alert('Hackeado')</script>">
            </div>

            <div class="form-group row">
                <label for="valor">Valor:</label>
                <input type="number" id="valor" name="valor" step="0.01" required>
            </div>

            <button type="submit" class="btn-submit">Salvar</button>
        </form>

        <h2>Extrato de Transações</h2>
        <ul class="lista-transacoes">
            <?php foreach ($transacoes as $t): ?>
                <li>
                    <?= $t['descricao'] ?> - R$ <?= number_format($t['valor'], 2, ',', '.') ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>


</html>