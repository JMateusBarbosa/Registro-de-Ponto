<?php

namespace models;

class ExcluirBolsistaModel extends Model
{
    public function listarBolsistas()
    {
        $stmt = \MySql::connect()->prepare("SELECT id, nome, telefone, turno FROM bolsistas");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function excluirBolsista($bolsistaId)
    {
        if (isset($_POST["bt-excluir"])) {
            $stmt = \MySql::connect()->prepare("DELETE FROM bolsistas WHERE id = ?");
            $stmt->execute([$bolsistaId]);

            if ($stmt->rowCount() > 0) {
                echo "<script> 
                        function sucesso() {
                            alert('Cadastro excluído com sucesso!');
                        }
                        sucesso();
                        window.location.href = 'http://localhost/registro_de_ponto/bolsistas';
                      </script>";
            } else {
                echo "Erro durante a exclusão: " . print_r($stmt->errorInfo(), true);
            }
        }
    }
}
?>
