
# Session Cleaner

Session tablosunda oluşan zamanlı birikmenin önlenmesi amacı oluşturulmuş bir scripttir. Script, tek başına bağımsız olarak çalıştırılacak şekilde planlandığı için ayrı tutulmuştur.

Scriptin çalışma mantığı "ci_sessions" tablosunda yer alan "timestamp" kaydını, scriptin çalıştığı andan 2 saat öncesine kadar olacak şekilde eşleşerek bu kayıtları temizlemektir.

## Ortam Değişkenleri

Bu projeyi çalıştırmak için aşağıdaki ortam değişkenlerini .env dosyanıza eklemeniz gerekecek

`$hostName`
`$dbName`
`$dbUserName`
`$dbUserPassword`

  
# Detay
```
<?php
/*
/* 20.05.2022 - 11:44
/* anilgnca@gmail.com
*/
date_default_timezone_set('Europe/Istanbul'); //LOCAL
        //DB Config
        $hostName = "localhost";    //MYSQL HOST
        $dbName = "test";           //MYSQL DATABASE NAME
        $dbUserName = "root";       //MYSQL USERNAME
        $dbUserPassword = "";       //MYSQL PASSWORD
        //TRY CONNECT TO DATABASE
        try {
            $conn = new PDO("mysql:host=$hostName;dbname=$dbName", $dbUserName, $dbUserPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        $now = new DateTime();
        //2 HOURS ARE ADDED TO THE CURRENT TIME
        $now->sub(new \DateInterval('PT7200S'));
        $time = $now->getTimestamp();
        //SQL QUERY FOR DELETE ACTION
        $sql = 'DELETE FROM `ci_sessions` WHERE `timestamp` <= :tmp';
        $sqlQuery = $conn->prepare($sql);
        $sqlQuery->bindParam("tmp", $time, PDO::FETCH_ASSOC);
        $sqlQuery->execute();
        //COMPLETE
?>
```
