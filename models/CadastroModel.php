<?php


namespace models;

class CadastroModel extends Model
{
    public function cadastrarBolsista()
    {
        date_default_timezone_set('America/Sao_Paulo');

        if (isset($_POST["bt_enviar"])) {
            $nome = $_POST["nome"];
            $telefone = $_POST["telefone"];
            $turno = $_POST["turno"];

            try {
                $bolsistas = \MySql::connect()->prepare("INSERT INTO bolsistas (nome, telefone, turno, data_cadastro) VALUES (?, ?, ?, ?)");
                $bolsistas->execute(array($nome, $telefone, $turno, date('Y-m-d H:i:s')));

                // Verifica se ocorreu algum erro durante a execução da query
                if ($bolsistas->errorCode() !== '00000') {
                    $errorInfo = $bolsistas->errorInfo();
                    throw new \PDOException($errorInfo[2], $errorInfo[1]);
                }

                // Verifica se foi afetada alguma linha
                if ($bolsistas->rowCount() > 0) {
                    echo "<script> function cadastro(){
                        alert('Cadastro realizado!')
                    }
                    cadastro();</script>";
                } else {
                    echo "Erro: Nenhuma linha foi afetada durante a inserção.";
                }
            } catch (\PDOException $e) {
                echo "Erro durante o insert: " . $e->getMessage();
            }
        }
    }
}
?>
