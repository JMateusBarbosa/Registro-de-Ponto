<?php
use models\ExcluirBolsistaModel;

$excluirModel = new ExcluirBolsistaModel();
$bolsistas = $excluirModel->listarBolsistas();
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $excluirModel->excluirBolsista($_POST['bolsista']);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/assets/css/style.css?v=1.0">

    <title>Excluir Cadastro</title>
</head>
<body>
    <header>
        <h1>Excluir Cadastro</h1>
    </header>

    <nav>
        <ul>
            <li><a href="?route=home">Home</a></li>
            <li><a href="?route=cadastro">Cadastro de Bolsistas</a></li>
            <li><a href="?route=bolsistas">Bolsistas Cadastrados</a></li>
            <li><a href="?route=alterar">Alterar Cadastro</a></li>
            <li><a href="?route=registro">Registrar Ponto</a></li>
            <li><a href="?route=acompanhar">Acompanhar Progresso</a></li>
        </ul>
    </nav>

    <section>
        <!-- Conteúdo da Formulário de Exclusão de Cadastro aqui -->
        <form class="form-excluir" method="post">
            <label for="bolsista">Selecione o Bolsista:</label>
            <select id="bolsista" name="bolsista" required>
                <!-- bolsistas cadastrados no sistema -->
                <?php foreach ($bolsistas as $value) : ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="bt-excluir">Excluir Cadastro</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Sistema de Ponto</p>
    </footer>
</body>
</html>


