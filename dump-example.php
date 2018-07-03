<?php


set_time_limit(0);
ignore_user_abort(true);
ob_end_flush();

include './lib/MySqlDump.php';
$dbConfig = include './DBconfig.php';

$backupPath = dirname(__FILE__).'/data';
if(!is_dir($backupPath)){
    mkdir($backupPath,0777);
}

$time = -microtime(true);


$dump = new MySqlDump($dbConfig);
$dumpFile = $backupPath .'/dump_test.sql.gz';

$dump->onProgress = function ($output) {
    echo str_repeat("<div></div>",1024).$output." ->Complete<br>";
    flush();
};

$dump->save($dumpFile);



$time += microtime(true);
echo "Finshed (in $time s)";