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
            $horarioEntrada = $_POST['horario_entrada'];
            $horarioSaida = $_POST['horario_saida'];

            $registroModel = new RegistroPontoModel();
            $registroModel->registrarPonto($bolsistaId, $horarioEntrada, $horarioSaida);
        }
        $this->view->render('registroPonto.php');
    }


}
?>
