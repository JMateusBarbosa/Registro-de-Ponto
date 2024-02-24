<?php

namespace models;

class ProgressoModel extends Model
{
    public function listarBolsistas()
    {
        $stmt = \MySql::connect()->prepare("SELECT id, nome, telefone, turno FROM bolsistas");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function obterRegistrosPonto($bolsistaId)
    {
        $stmt = \MySql::connect()->prepare("SELECT nome_bolsista, data_registro, horario_entrada, horario_saida FROM registros_ponto WHERE bolsista_id = ?");
        $stmt->execute([$bolsistaId]);
        return $stmt->fetchAll();
    }


    
    public function horasTrabalhadasPorDia($bolsistaId)
    {
    $registros = $this->obterRegistrosPonto($bolsistaId);

    $horasTrabalhadas = [];

    foreach ($registros as $registro) {
        $nomeBolsista =  $registro['nome_bolsista'];
        $dataRegistro = date('Y-m-d', strtotime($registro['data_registro']));
        $horaEntrada = strtotime($registro['horario_entrada']);
        $horaSaida = strtotime($registro['horario_saida']);

        // Verifica se as horas de entrada e saída são válidas
        if ($horaSaida !== false && $horaEntrada !== false) {
            $diferencaHoras = gmdate('H:i', $horaSaida - $horaEntrada); // Formata a diferença em horas e minutos

            $horasTrabalhadas[] = [
                'nome_bolsista'  => $nomeBolsista,
                'data_registro' => $dataRegistro,
                'horario_entrada' => date('H:i:s', $horaEntrada),
                'horario_saida' => date('H:i:s', $horaSaida),
                'horas_trabalhadas' => $diferencaHoras
            ];
        }
    }

    return $horasTrabalhadas;
}


    
}
?>
