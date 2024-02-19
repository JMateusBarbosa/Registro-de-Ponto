<?php

namespace controllers;

use models\RegistroPontoModel;

class RegistroPontoController extends Controller
{
    public function __construct($view, $model)
    {
        parent::__construct($view, $model);
    }

    public function index()
    {
        if (isset($_POST['bt-registrar'])) {
            $bolsistaId = $_POST['bolsista'];
            $nomeBolsista = $_POST['nome_bolsista'];
            $horarioEntrada = $_POST['horario_entrada'];
            $horarioSaida = $_POST['horario_saida'];
        
            // Verificar se o horário de saída é maior que o de entrada
            $entradaTimestamp = strtotime($horarioEntrada);
            $saidaTimestamp = strtotime($horarioSaida);
        
            if ($saidaTimestamp <= $entradaTimestamp) {
                echo "<script>alert('O horário de saída deve ser maior que o de entrada.');</script>";
                // Você pode adicionar mais lógica aqui, como não chamar o método registrarPonto
            } else {
                // Obtendo a data atual no formato 'Y-m-d'
                $dataAtual = date('Y-m-d');
                        
                $registroModel = new RegistroPontoModel();
                $registroModel->registrarPonto($bolsistaId, $nomeBolsista, $horarioEntrada, $horarioSaida);
            }
        }
        
        $this->view->render('registroPonto.php');
    }


}
?>
