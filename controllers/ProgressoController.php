<?php
    namespace controllers;

    use models\ProgressoModel;

    
    class ProgressoController extends Controller {
        
        public function __construct($view, $model) {
            parent::__construct($view, $model);
        }

        public function index() {
            if (isset($_POST['bolsista'])) {
                $bolsistaId = $_POST['bolsista'];
        
                $progressoModel = new ProgressoModel();
                $horasTrabalhadas = $progressoModel->horasTrabalhadasPorDia($bolsistaId);
            }
        
            $this->view->render('progresso.php', ['horasTrabalhadas' => $horasTrabalhadas]);
        }
    }
?>
