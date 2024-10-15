<?php

$lines = file('БД.csv');
$count = 0;
foreach ($lines as &$line) {
    $line = $count . ' | ' . $line;
    $count++;
}


$content = implode(PHP_EOL, $lines);
$content = iconv("windows-1251", "utf-8", $content);
file_put_contents('newFile.csv', $content);

