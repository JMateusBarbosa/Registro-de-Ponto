<!-- Views/templates/bolsistas.php -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="views/assets/css/teste.css?v=1.0">

    <title>Bolsistas Cadastrados</title>
</head>
<body>
    <header>
        <h1>Bolsistas Cadastrados</h1>
    </header>

    <nav>
        <ul>
            <li><a href="?route=home">Home</a></li>
            <li><a href="">Alterar Cadastro</a></li>
            <li><a href="">Excluir Cadastrado</a></li>
            <li><a href="">Registrar Ponto</a></li>
            <li><a href="">Acompanhar Progresso</a></li>
        </ul>
    </nav>

    <table id="customers">
        <tr>
                <th>Codigo</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Turno</th>
                <th>Data em que foi cadastrado</th>
        </tr>
    
        <?php 
             $bolsistas = \Models\BolsistasModel::listarBolsistas();
             if (!empty($bolsistas)) {
                foreach ($bolsistas as $value) {
            ?>
                <tr>
                    <td><?php echo $value['id']?></td>
                    <td><?php echo $value['nome']?></td>
                    <td><?php echo $value['telefone']?></td>
                    <td><?php echo $value['turno']?></td>
                    <td><?php echo $value['data_cadastro']?></td>
                </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='5'>Nenhum bolsista cadastrado.</td></tr>";
            }
            ?>
    </table>
    <footer>
        <p>&copy; 2024 Sistema de Ponto</p>
    </footer>
</body>
</html>
