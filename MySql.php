<?php
class MySql
{
    private static $pdo;

    public static function connect()
    {
        if (!isset(self::$pdo)) {
            self::$pdo = new PDO('mysql:host=localhost;dbname=registro', 'root', '');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$pdo;
    }
}
?>
