<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POC Controle Financeiro</title>

    <?php
    /**
     * @var string $csrf_token
     * @var array $transacoes
     */
    ?>
    
</head>

<body>
    <h1>Nova Transação</h1>

    <form method="POST" action="index.php">
        <input type="hidden" name="crsf_token" value="<?= htmlspecialchars($csrf_token) ?>">
        <label>Descrição (Tente injetar o XSS aqui): </label>
        <input type="text" name="descricao" required size="50" placeholder="<script>alert('Fui Hackeado')</script>">
        <label>Valor: </label>
        <input type="number" name="" step="0.01" required>
        <button type="submit">Salvar</button>
    </form>

    <h2>Extrato de Transações</h2>
    <ul>
        <?php foreach ($transacoes as $t): ?>
            <li>
                <?= $t['descricao'] ?> - R$ <?= number_format($t['valor'], 2, ',', '.') ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>