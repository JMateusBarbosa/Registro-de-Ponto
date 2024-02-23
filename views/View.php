<?php
	namespace views;

	class View{

		const DEFAULT = 'alterarBolsista.php';
		const DEFAULT_FOOTER = 'footer.php';
		
		public function render($body,$header = null,$footer = null){
			if($header == null)
			{
				include('views/templates/'.self::DEFAULT);
			}

			
		}

	}
?>