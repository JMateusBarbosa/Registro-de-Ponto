<?php
use models\ProgressoModel;

$progressoModel = new ProgressoModel();
$bolsistas = $progressoModel->listarBolsistas();

if (isset($_POST['bolsista'])) {
    $bolsistaId = $_POST['bolsista'];
    $horasTrabalhadas = $progressoModel->horasTrabalhadasPorDia($bolsistaId); // Corrija a chamada do método aqui
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/assets/css/telaProgresso.css?v=1.0">

    <title>Acompanhar Progresso</title>
</head>
<body class="tela-progresso">
    <header>
        <h1>Acompanhar Progresso</h1>
    </header>

    <nav>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Cadastro de Bolsistas</a></li>
            <li><a href="">Bolsistas Cadastrados</a></li>
            <li><a href="">Alterar Cadastro</a></li>
            <li><a href="">Excluir Cadastro</a></li>
            <li><a href="">Registrar Ponto</a></li>
            
        </ul>
    </nav>

    <section>
        <form method="post" name="form-progresso">
            <label for="bolsista">Selecione o Bolsista:</label>
            <select id="bolsista" name="bolsista" required>
                <?php foreach ($bolsistas as $value) : ?>
                    <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="consultar-horas">Consultar Horas</button>
        </form>

        <?php if (isset($horasTrabalhadas) && is_array($horasTrabalhadas) && !empty($horasTrabalhadas)): ?>
        <h2>Horas Trabalhadas</h2>
        <table class="progresso-table">
            <thead>
                <tr>
                    <th>Data de Registro</th>
                    <th>Entrada</th>
                    <th>Saída</th>
                    <th>Horas Trabalhadas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($horasTrabalhadas as $registro): ?>
                    <tr>
                        <td><?php echo $registro['data_registro']; ?></td>
                        <td><?php echo $registro['horario_entrada']; ?></td>
                        <td><?php echo $registro['horario_saida']; ?></td>
                        <td><?php echo isset($registro['horas_trabalhadas']) ? $registro['horas_trabalhadas'] : 'N/A'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>Nenhum registro de ponto disponível para o bolsista selecionado.</p>
        <?php endif; ?>


    </section>

    <footer>
        <p>&copy; 2024 Sistema de Ponto</p>
    </footer>
</body>
</html>


