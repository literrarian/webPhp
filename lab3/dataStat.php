<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'Лабораторная 3'</title>
</head>
<body>
<main>
<form action="" method="get">
    <label for="region">
        Введите регион: <input type="text" id="region" name="region">
    </label><br><br>
    <button type="submit" id="submit">Показать</button>
</form><br>



<?php
if (isset($_GET['region'])) {
    $arrayResidents = getRegResidents($_GET['region']);
    if ($arrayResidents == 0) {
        echo "Введите нормальное название";
    } elseif ($arrayResidents == -1) {
        echo "<br/>"."Там был Вася, да и только"."<br/>";
    } else {
        echo '<p>Жители ' . $_GET['region'] . ':<br>';
        foreach ($arrayResidents as $resident){
            if ($resident['gender'] == 'female') {
                echo '<label style="color: hotpink">' . $resident['firstName'] . '</label>';
            } elseif ($resident['gender'] == 'male') {
                echo '<label style="color: deepskyblue">' . $resident['firstName'] . '</label>';
            }
            echo ' ' . $resident['lastName'] . ' ' . $resident['age'] . ' ' . $resident['email'] . '</br>';
        }
        echo '</p>';
    }
}
function getRegResidents($currRegion): int|array {
    if ($currRegion=='') {
        return 0;
    }
    $arrayResidents = array();
    $doesExist = false;
    $file = fopen('dump.txt', 'r');
    error_reporting(E_ERROR | E_PARSE);
    if ($file) {
        while (($line = fgetcsv($file, null, ';')) !== false) {
            [$id, $firstName, $middleName,$lastName, $gender, $city, $region, $email, $phone, $birthDate,
                $post, $company, $weight, $height, $address, $postalCode, $countryCode] = $line;

            if ($region==$currRegion)  {
                $doesExist = true;
                $current_date = date('Y-m-d');
                $current_date_obj = new DateTime($current_date);
                $birth_date_obj = new DateTime($birthDate);
                $diff = $current_date_obj->diff($birth_date_obj);
                $age_years = $diff->y;
                $arrayResidents[] = array('firstName' => $firstName, 'lastName' => $lastName,
                    'gender' => $gender, 'age' => $age_years, 'email' => $email);
            }
        }

        $lastNameColumn  = array_column($arrayResidents, 'lastName');
        $firstNameColumn  = array_column($arrayResidents, 'firstName');
        array_multisort($lastNameColumn, SORT_ASC, $firstNameColumn, SORT_ASC, $arrayResidents);
        fclose($file);
    } else {
        echo "Ошибочка";
        return 0;
    }
    if ($doesExist) {
        return $arrayResidents;
    }
    return -1;
}
$wholeData = file_get_contents('dump.txt');
$holidays = array(
    '01-01',
    '07-01',
    '14-02',
    '23-02',
    '08-03',
    '01-05',
    '31-12'
);
$maleCount = 0;
$femaleCount = 0;
$femaleWeight = 0;
$maleWeight = 0;
$femaleHeight = 0;
$maleHeight = 0;
$femaleAge = 0;
$maleAge = 0;
$HolidayBirthed = array();

$current_date = date('Y-m-d');
$current_date_obj = new DateTime($current_date);
$lines = explode("\n", $wholeData);
foreach ($lines as $line){

    $fields = explode(';', $line);

    if (count($fields)!=17)
    {continue;}
    $birth_date = $fields[9];
    $birth_date_obj = new DateTime($birth_date);
    $diff = $current_date_obj->diff($birth_date_obj);
    $age_years = $diff->y;
    $dayMonth = $birth_date_obj->format('d-m');
    if (in_array($dayMonth,$holidays))
    {
        $HolidayBirthed[$fields[3]] = $birth_date_obj;
    }
    if ($fields[4]==='female'){
        $femaleCount++;
        $femaleWeight+= intval($fields[12]);
        $femaleHeight+= intval($fields[13]);
        $femaleAge+=$age_years;
    }
    if ($fields[4]==='male'){
        $maleCount++;
        $maleWeight+= intval($fields[12]);
        $maleHeight+= intval($fields[13]);
        $maleAge+=$age_years;
    }

}
$femaleHeight = round($femaleHeight / $femaleCount);
$femaleWeight = round($femaleWeight / $femaleCount);
$femaleAge = round($femaleAge / $femaleCount);
$maleHeight = round($maleHeight / $maleCount);
$maleWeight = round($maleWeight / $maleCount,0);
$maleAge = round($maleAge / $maleCount,0);
$maleMedAge = array_fill(0,3,0);
$femaleMedAge = array_fill(0,3,0);;
$maleMedWeight = array_fill(0,3,0);
$femaleMedWeight = array_fill(0,3,0);
$maleMedHeight = array_fill(0,3,0);;
$femaleMedHeight = array_fill(0,3,0);;

foreach ($lines as $line) {
    $fields = explode(';', $line);
    if (count($fields) != 17) {
        continue;
    }
    $birth_date = $fields[9];
    $birth_date_obj = new DateTime($birth_date);
    $diff = $current_date_obj->diff($birth_date_obj);
    $age_years = $diff->y;

    if ($fields[4] === 'female') {
        intval($fields[12]) > $femaleWeight ? $femaleMedWeight[0] += 1 : (intval($fields[12]) < $femaleWeight ? $femaleMedWeight[1] += 1 : $femaleMedWeight[2] += 1);
        intval($fields[13]) > $femaleHeight ? $femaleMedHeight[0] += 1 : (intval($fields[13]) < $femaleHeight ? $femaleMedHeight[1] += 1 : $femaleMedHeight[2] += 1);
        $age_years > $femaleAge ? $femaleMedAge[0] += 1 : ($age_years < $femaleAge ? $femaleMedAge[1] += 1 : $femaleMedAge[2] += 1);
    }
    if ($fields[4] === 'male') {
        intval($fields[12]) > $maleWeight ? $maleMedWeight[0] += 1 : (intval($fields[12]) < $maleWeight ? $maleMedWeight[1] += 1 : $maleMedWeight[2] += 1);
        intval($fields[13]) > $maleHeight ? $maleMedHeight[0] += 1 : (intval($fields[13]) < $maleHeight ? $maleMedHeight[1] += 1 : $maleMedHeight[2] += 1);
        $age_years > $maleAge ? $maleMedAge[0] += 1 : ($age_years < $maleAge ? $maleMedAge[1] += 1 : $maleMedAge[2] += 1);

    }
}


print("Женщин: $femaleCount" . PHP_EOL);
echo "<br>";
print("Средний рост: $femaleHeight" . PHP_EOL);
echo "<ul>";
echo "<li>".'Больше среднего '.$femaleMedHeight[0]."</li>";
echo "<li>".'Средний '.$femaleMedHeight[2]."</li>";
echo "<li>".'Меньше среднего '.$femaleMedHeight[1]."</li>";
echo "</ul>";
print("Средний вес: $femaleWeight" . PHP_EOL);
echo "<ul>";
echo "<li>".'Больше среднего '.$femaleMedWeight[0]."</li>";
echo "<li>".'Средний '.$femaleMedWeight[2]."</li>";
echo "<li>".'Меньше среднего '.$femaleMedWeight[1]."</li>";
echo "</ul>";
print("Средний возраст: $femaleAge" . PHP_EOL);
echo "<ul>";
echo "<li>".'Больше среднего '.$femaleMedAge[0]."</li>";
echo "<li>".'Средний '.$femaleMedAge[2]."</li>";
echo "<li>".'Меньше среднего '.$femaleMedAge[1]."</li>";
echo "</ul>";

print("Мужчин: $maleCount" . PHP_EOL);
echo "<br>";
print("Средний рост: $maleHeight" . PHP_EOL);
echo "<ul>";
echo "<li>".'Больше среднего '.$maleMedHeight[0]."</li>";
echo "<li>".'Средний '.$maleMedHeight[2]."</li>";
echo "<li>".'Меньше среднего '.$maleMedHeight[1]."</li>";
echo "</ul>";
print("Средний вес: $maleWeight" . PHP_EOL);
echo "<ul>";
echo "<li>".'Больше среднего '.$maleMedWeight[0]."</li>";
echo "<li>".'Средний '.$maleMedWeight[2]."</li>";
echo "<li>".'Меньше среднего '.$maleMedWeight[1]."</li>";
echo "</ul>";
print("Средний возраст: $maleAge" . PHP_EOL);
echo "<ul>";
echo "<li>".'Больше среднего '.$maleMedAge[0]."</li>";
echo "<li>".'Средний '.$maleMedAge[2]."</li>";
echo "<li>".'Меньше среднего '.$maleMedAge[1]."</li>";
echo "</ul>";
echo "\n";

$groupedByDate = array();
foreach ($HolidayBirthed as $name => $datetime) {
    $date = $datetime->format('m-d');
    if (!isset($groupedByDate[$date])) {
        $groupedByDate[$date] = array();
    }
    $groupedByDate[$date][] = $name;
}
foreach ($groupedByDate as $date => $names) {
    echo "Дата: $date" ."<br>";
    foreach ($names as $name) {
        echo "  - $name"."<br>";
    }
    echo "\n";
}



?>
</main>
</body>
</html>
