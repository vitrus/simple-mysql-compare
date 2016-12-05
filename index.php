<?php

error_reporting(E_ALL);

// include configurations
require('config.php');

// connect to both databases defined in $databases
makeDatabaseConnections($databases);

if (!empty($_GET['table'])) {

    // if a table is given, compare this table
    tableCompareAction($databases, $_GET['table']);

} else {

    // otherwise, compare the database as a whole
    databaseCompareAction($databases);

}

/**
 * Connect to both databases, store the connection in $databases['config']
 *
 * @param $databases
 */
function makeDatabaseConnections(&$databases)
{
    // connect with both database
    foreach ($databases as $key => $db) {

        // create the connection
        $databases[$key]['connection'] = new PDO(
            'mysql:host='.$db['config']['host'].';dbname='.$db['config']['name'].';charset=utf8',
            $db['config']['user'],
            $db['config']['password']
        );

        // change connection properties
        $databases[$key]['connection']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $databases[$key]['connection']->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $databases[$key]['connection']->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        ); // default fetch mode: assoc
    }
}

function tableCompareAction(&$databases, $tableName)
{

    $all_columns = [];

    foreach ($databases as $key => $db) {

        $stmt = $db['connection']->prepare(
            "SHOW COLUMNS FROM `".$tableName."`"
        ); // too bad a table name cannot be parameterized
        $stmt->execute([]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            // add this row to the list of all columns
            $all_columns[] = $row['Field'];
            $databases[$key]['columns'][$row['Field']] = $row;
        }
    }

    $all_columns = array_unique($all_columns);

    include("table-overview.template.php");
}

function databaseCompareAction(&$databases)
{

    foreach ($databases as $key => $db) {

        $stmt = $db['connection']->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_NUM); // numeric, so every table is under (column index) 0
        foreach ($tables as $table) {
            $databases[$key]['tables'][] = $table[0];
        }
    }

    // create one array with all the tablenames from both databases
    $all_tables = array_unique(array_merge($databases[0]['tables'], $databases[1]['tables']));
    sort($all_tables); // order them alphabetically

    include("database-overview.template.php");
}

