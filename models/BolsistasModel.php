<?php
// models/BolsistasModel.php

    namespace models;

    class BolsistasModel extends Model
    {
        public static function listarBolsistas(){
            $livros = \MySql::connect()->prepare("SELECT * FROM bolsistas");
            $livros->execute();
            return $livros->fetchAll();
            }
    }
?>
