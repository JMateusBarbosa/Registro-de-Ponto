
<?php
    use models\RegistroPontoModel;
    $listarModel = new RegistroPontoModel();
    $bolsistas = $listarModel->listarBolsistas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/assets/css/style.css?v=1.0">
    <script src="views/assets/js/script.js"></script>
    <title>Registrar Ponto</title>
</head>
<body>
    <header>
        <h1>Registrar Ponto</h1>
    </header>

    <nav>
        <ul>
            <li><a href="?route=home">Home</a></li>
            <li><a href="?route=cadastro">Cadastro de Bolsistas</a></li>
            <li><a href="?route=bolsistas">Bolsistas Cadastrados</a></li>
            <li><a href="?route=alterar">Alterar Cadastro</a></li>
            <li><a href="?route=excluir">Excluir Cadastro</a></li>
            <li><a href="?route=acompanhar">Acompanhar Progresso</a></li>
        </ul>
    </nav>

    <section>
        <!-- Formulário de Registro de Ponto aqui -->
        <form class="form-registro" method="post">
        <label for="bolsista">Selecione o Bolsista:</label>
            <select id="bolsista" name="bolsista" required>
                <?php foreach ($bolsistas as $value) : ?>
                    <option value="<?php echo $value['id']; ?>" data-nome="<?php echo $value['nome']; ?>">
                        <?php echo $value['nome']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="horario_entrada">Horário de Entrada:</label>
            <input type="datetime-local" id="horario_entrada" name="horario_entrada" required>

            <label for="horario_saida">Horário de Saída:</label>
            <input type="datetime-local" id="horario_saida" name="horario_saida" required>

            <!-- Movido para dentro do loop -->
            <?php foreach ($bolsistas as $value) : ?>
                <input type="hidden" name="nome_bolsista" value="<?php echo $value['nome']; ?>">
            <?php endforeach; ?>

            <button type="submit" name="bt-registrar">Registrar Ponto</button>
        </form>
        <?php
            if (isset($_POST['bt-registrar'])) {
                $bolsistaId = $_POST['bolsista'];
                $nomeBolsista = $_POST['nome_bolsista'];
                $horarioEntrada = $_POST['horario_entrada'];
                $horarioSaida = $_POST['horario_saida'];
            
                $registroModel = new RegistroPontoModel();
                $registroModel->registrarPonto($bolsistaId, $nomeBolsista, $horarioEntrada, $horarioSaida);
            }
            ?>

            <script>
                    document.getElementById('bolsista').addEventListener('change', function () {
                    var selectedOption = this.options[this.selectedIndex];
                    var nomeBolsista = selectedOption.getAttribute('data-nome');
                    
                    // Atualizando todos os campos ocultos com o mesmo nome
                    var camposNomeBolsista = document.getElementsByName('nome_bolsista');
                    for (var i = 0; i < camposNomeBolsista.length; i++) {
                        camposNomeBolsista[i].value = nomeBolsista;
                    }
                });
            </script>
    </section>

    <footer>
        <p>&copy; 2024 Sistema de Ponto</p>
    </footer>
</body>
</html>
