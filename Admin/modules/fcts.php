<?php

function tableExists($pdo, $table) {

    try {
        $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
    } 
    catch (Exception $e) {
        return FALSE;
    }
    return $result !== FALSE;
}

function rowExists($pdo, $table,$attr,$val) {
        $result = $pdo->prepare("SELECT COUNT(*) FROM $table WHERE $attr = $val;");
        $result->execute();
        return $result->fetchColumn();  
}

function dbconnect($servername,$dbname,$username,$password){
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr class='ligne'>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
  }


 

?>