<?php

/**
 * @brief 
 * @details Konfiguration der Datenbank 
 * @package IHK-Projekt
 * @filesource
 * @source
 * @author Aykut Acarer
 * @link https://localhost/php/IHK-Projekt/project
 * @remark 20220128 AcarA Anlegen der Konfiguration
 */

$host = 'localhost:3306';
$user = 'root';
$pass = '';
$db_name = 'neu_kiz_projekt';

try {
    //Datenbank Verbindung

    $conn = new PDO("mysql:host=$host;dbname=$db_name;", $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
} catch (PDOException $e) {
    echo $e->getMessage();
}
