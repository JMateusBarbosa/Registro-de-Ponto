<?php
    namespace models;

    class AlterarBolsistaModel extends Model {

        public function alterarCadastro() {
            if (isset($_POST["bt-alterar"])) {
                $bolsistaId = $_POST["bolsistaId"];
                $novoNome = $_POST["novo_nome"];
                $novoTelefone = $_POST["novo_telefone"];
                $novoTurno = $_POST["novo_turno"];

                $stmt = \MySql::connect()->prepare("UPDATE bolsistas SET nome = ?, telefone = ?, turno = ? WHERE id = ?");
                $stmt->execute([$novoNome, $novoTelefone, $novoTurno, $bolsistaId]);

                if ($stmt->rowCount() > 0) {
                    echo "<script> 
                            function sucesso() {
                                alert('Cadastro alterado com sucesso!');
                            }
                            sucesso();
                            window.location.href = 'http://localhost/registro_de_ponto/bolsistas';
                          </script>";
                } else {
                    echo "Erro durante a atualização: " . print_r($stmt->errorInfo(), true);
                }
            }
        }

        public function listarBolsistas() {
            $stmt = \MySql::connect()->prepare("SELECT id, nome, telefone, turno FROM bolsistas");
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getBolsistaById($bolsistaId) {
            $stmt = \MySql::connect()->prepare("SELECT id, nome, telefone, turno FROM bolsistas WHERE id = ?");
            $stmt->execute([$bolsistaId]);
            return $stmt->fetch();
        }
    }
?>
