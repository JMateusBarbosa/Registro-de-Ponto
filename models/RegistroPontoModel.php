<?php

namespace models;

class RegistroPontoModel extends Model
{
    public function listarBolsistas()
    {
        $stmt = \MySql::connect()->prepare("SELECT id, nome FROM bolsistas");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    

    

    public function registrarPonto($bolsistaId, $nomeBolsista, $horarioEntrada, $horarioSaida)
    {
        try {
            $dataAtual = date('Y-m-d H:i:s');  // Obtém a data e hora atual no formato adequado

            $registros_ponto = \MySql::connect()->prepare("INSERT INTO registros_ponto (bolsista_id, nome_bolsista, horario_entrada, horario_saida, data_registro) VALUES (?, ?, ?, ?, ?)");
            $registros_ponto->execute([$bolsistaId, $nomeBolsista, $horarioEntrada, $horarioSaida, $dataAtual]);

            // Verifica se ocorreu algum erro durante a execução da query
            if ($registros_ponto->errorCode() !== '00000') {
                $errorInfo = $registros_ponto->errorInfo();
                throw new \PDOException($errorInfo[2], $errorInfo[1]);
            }

            // Verifica se foi afetada alguma linha
            if ($registros_ponto->rowCount() > 0) {
                echo "<script>
                    function registro() {
                        alert('Registro realizado!');
                    }
                    registro();
                  </script>";
            } else {
                throw new \Exception("Erro: Nenhuma linha foi afetada durante a inserção.");
            }
        } catch (\PDOException $e) {
            echo "Erro MySQL durante o insert: " . $e->getMessage();
        } catch (\Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>