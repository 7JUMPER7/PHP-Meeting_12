<?php
    class Tools {
        static function connect($dbname, $host='localhost:3306', $user='root', $pass='root') {
            try {
                $cs = "mysql:host=$host;dbname=$dbname;charset=utf8";
                $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES UTF8"
                );
                $pdo = new PDO($cs, $user, $pass, $options);
                return $pdo;
            } catch(PDOException $ex) {
                echo $ex->getMessage();
                return false;
            }
        }
        static function createDb($pdo, ...$queries) {
            $errors = false;
            foreach($queries as $k => $v) {
                $pdo->exec($v);
                $err = $pdo->errorCode();
                if($err) {
                    echo "<div>$k. $err</div>";
                    $errors = true;
                }
            }
            return $errors;
        }
    }
?>