<?php
$tables = \DB::select('SHOW TABLES');
foreach ($tables as $t) {
    $name = array_values((array)$t)[0];
    echo $name . "\n";
}
