
<?php
$lines = file('вар2.csv');
$count = 0;
foreach ($lines as &$line) {
    $line = preg_replace('/\s*#\s*$/u', '', $line);
    $line = $count . '|' . $line;
    $count++;
}
//$lines[0] = 'name|summary|article|category|pic';
file_put_contents('вар2.csv', $lines . implode(PHP_EOL, $lines) . PHP_EOL);
echo($lines[0]);
