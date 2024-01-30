<?php
    use models\AlterarBolsistaModel;
    $alterarModel = new AlterarBolsistaModel();
    $bolsistas = $alterarModel->listarBolsistas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/assets/css/style.css?v=1.0">
    <title>Alterar Cadastro</title>
</head>
<body>
    <header>
        <h1>Alterar Cadastro</h1>
    </header>

    <nav>
        <ul>
            <li><a href="?route=home">Home</a></li>
            <li><a href="?route=cadastro">Cadastro de Bolsistas</a></li>
            <li><a href="?route=bolsistas">Bolsistas Cadastrados</a></li>
            <li><a href="?route=excluir">Excluir Cadastro</a></li>
            <li><a href="?route=registro">Registrar Ponto</a></li>
            <li><a href="?route=acompanhar">Acompanhar Progresso</a></li>
        </ul>
    </nav>

    <section>
        <form method="post">
            <label for="bolsista">Selecione o Bolsista:</label>
            <select id="bolsista" name="bolsista" required>
                <?php foreach ($bolsistas as $value) : ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="bt-selecionar">Selecionar Bolsista</button>
        </form>

        <?php
            if (isset($_POST['bt-selecionar'])) {
                $selectedBolsistaId = $_POST['bolsista'];
                $selectedBolsista = $alterarModel->getBolsistaById($selectedBolsistaId);
        ?>

        <form method="post">
            <input type="hidden" name="bolsistaId" value="<?php echo $selectedBolsista['id']; ?>">
            <p>
                <label for="novo_nome">Novo Nome:</label>
                <input type="text" name="novo_nome" value="<?php echo $selectedBolsista['nome']; ?>" required>
            </p>
            <p>
                <label for="novo_telefone">Novo Telefone para Contato:</label>
                <input type="text" name="novo_telefone" value="<?php echo $selectedBolsista['telefone']; ?>" required>
            </p>
            <p>
                <label for="novo_turno">Novo Turno:</label>
                <select id="novo_turno" name="novo_turno" required>
                    <option value="Manha" <?php echo ($selectedBolsista['turno'] == 'Manha') ? 'selected' : ''; ?>>Manhã</option>
                    <option value="Tarde" <?php echo ($selectedBolsista['turno'] == 'Tarde') ? 'selected' : ''; ?>>Tarde</option>
                </select>
            </p>

            <button type="submit" name="bt-alterar">Alterar Cadastro</button>
        </form>

        <?php } ?>
    </section>

    <footer>
        <p>&copy; 2024 Sistema de Ponto</p>
    </footer>
</body>
</html>

<?php 
    $alterarModel->alterarCadastro();
?>
