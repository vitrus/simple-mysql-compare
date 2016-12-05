<?php

error_reporting(E_ALL);

// include configurations
require('config.php');

// connect to both databases defined in $databases
makeDatabaseConnections($databases);

if(!empty($_GET['table'])){

    // if a table is given, compare this table
    tableCompareAction( $databases, $_GET['table'] );

} else {

    // otherwise, compare the database as a whole
    databaseCompareAction( $databases );

}

/**
 * Connect to both databases, store the connection in $databases['config']
 *
 * @param $databases
 */
function makeDatabaseConnections(&$databases){
    // connect with both database
    foreach ($databases as $key => $db) {
        $databases[$key]['connection'] = mysqli_connect(
            $db['config']['host'],
            $db['config']['user'],
            $db['config']['password']
        );

        mysqli_select_db($databases[$key]['connection'], $db['config']['name']);
    }
}

function tableCompareAction(&$databases, $tableName){

    $all_columns = array();

    foreach($databases as $key => $db){
        $result = mysqli_query($db['connection'], "SHOW COLUMNS FROM `".$tableName."`");
        while($row = mysqli_fetch_assoc($result)){
            // add this row to the list of all columns
            $all_columns[] = $row['Field'];
            $databases[$key]['columns'][$row['Field']] = $row;
        }
    }

    $all_columns = array_unique( $all_columns );

    include("table-overview.template.php");
}

function databaseCompareAction(&$databases){

    foreach ($databases as $key => $db) {

        $result = mysqli_query($db['connection'], "SHOW TABLES");
        while ($row = mysqli_fetch_row($result)) {
            //echo debug($row, 'ROW');
            $databases[$key]['tables'][] = $row[0];
        }
    }

    $all_tables = array_unique(array_merge($databases[0]['tables'], $databases[1]['tables']));
    sort($all_tables);

    include("database-overview.template.php");
}

