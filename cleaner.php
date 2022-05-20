<?php
/*
/* anilgnca@gmail.com
/* Table Clear for ci_sessions
*/
date_default_timezone_set('Europe/Istanbul');
        //DB Config
        $hostName = "localhost";
        $dbName = "test";
        $dbUserName = "root";
        $dbUserPassword = "";
        try {
            $conn = new PDO("mysql:host=$hostName;dbname=$dbName", $dbUserName, $dbUserPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $now = new DateTime();
        $now->sub(new \DateInterval('PT7200S'));
        $time = $now->getTimestamp();
        $sql = 'DELETE FROM `ci_sessions` WHERE `timestamp` <= :tmp';
        $sqlQuery = $conn->prepare($sql);
        $sqlQuery->bindParam("tmp", $time, PDO::FETCH_ASSOC);
        $sqlQuery->execute();
?>
