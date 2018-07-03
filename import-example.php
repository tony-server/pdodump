<?php

set_time_limit(0);
ignore_user_abort(true);
ob_end_flush();

$dbConfig = include './DBconfig.php';

$backupPath = dirname(__FILE__).'/data';
$dumpFile = $backupPath .'/dump_test.sql.gz';

$time = -microtime(true);

$import = new \main\lib\MySqlImport($dbConfig);
$import->onProgress = function ($output) {
    echo str_repeat("<div></div>",1024).$output." ->Complete<br>";
    flush();
};
$import->load($dumpFile);


$time += microtime(true);
echo "数据恢复成功 (in $time s)";