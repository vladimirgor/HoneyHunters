<?php
function dbLink(){
    try {
        $link = new PDO('mysql:dbname='. DB_NAME . ';host='. DB_HOST
            , DB_USER, DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
        return $link;

    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
        die;
    }
}
function Select($sql,$link){
    try {
        $stmt = $link->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = array();
        while( $row = $stmt->fetch() ) {
            $rows[] = $row;
        }
        return $rows;
    }
    catch (PDOException $e){
        echo "Select error: " . $e -> getMessage();
        die;
    }
}
function Insert($table, $object, $link){
    $columns = array();
    $values = array();

    foreach ( $object as $key => $value ) {
        $columns[] = $key;

        if( $value == NULL ){
            $values[] = "NULL";
        }else{

            $values[] = "'$value'";
        }
    }

    $columns_s = implode(",", $columns);
    $values_s = implode(",", $values);
    try {

        $stmt = $link -> prepare("INSERT INTO $table ($columns_s) VALUES($values_s)");
        $stmt -> execute();
        return $link -> lastInsertId();
    }
    catch (PDOException $e){
        echo "Insert error: " . $e -> getMessage();
        die;
    }
}