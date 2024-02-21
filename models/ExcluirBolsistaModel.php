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
        // 1. Identifique as tabelas relacionadas
        $tabelasRelacionadas = ['registros_ponto'];

        try {
            // 2. Inicie uma transação para garantir a consistência
            \MySql::connect()->beginTransaction();

            // 3. Exclua registros relacionados nas tabelas
            foreach ($tabelasRelacionadas as $tabela) {
                $stmtRelacionada = \MySql::connect()->prepare("DELETE FROM $tabela WHERE bolsista_id = ?");
                $stmtRelacionada->execute([$bolsistaId]);
            }

            // 4. Exclua o bolsista
            $stmt = \MySql::connect()->prepare("DELETE FROM bolsistas WHERE id = ?");
            $stmt->execute([$bolsistaId]);

            // 5. Comite a transação se tudo estiver OK
            \MySql::connect()->commit();

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
        } catch (\PDOException $e) {
            // 6. Desfaça a transação em caso de erro
            \MySql::connect()->rollBack();
            echo "Erro durante a exclusão: " . $e->getMessage();
        }
        
    }
}

}
?>
