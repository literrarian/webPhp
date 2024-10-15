<?php
header('Content-type: text/plain; charset=utf-8');
$wholeData = file_get_contents('OLDBASE.TXT');
$genderCount = 0;
$newEmail = validateEmails($wholeData);
$newIndex=preg_replace_callback('/^(\d+),/m', function($matches) {
    return str_pad($matches[1], 6, '0', STR_PAD_LEFT) . ',';
}, $newEmail);
$newGenders = cleanGenders($newIndex);

//$newGenders = preg_replace_callback('/^(\d+),([^,]+),([^,]+),([^,]+),([^,]+),/', function($matches) {
//    $gender = $matches[5];
//    echo ($gender);
//    if (!($gender === 'male' || $gender === 'female')) {
//        $gender = 'none';
//    }
//    return "{$matches[1]},{$matches[2]},{$matches[3]},{$matches[4]},{$gender},";
//}, $newIndex, -1, $genderCount);

//echo "Ошибки в поле gender: $genderCount";
$newPhones = preparePhone($newGenders);
$weighted = roundWeight($newPhones);
file_put_contents('dump.txt', str_replace(",", ";", $weighted));


function cleanGenders($content){
    $genderCount = 0;
    $lines = explode("\n", $content);
    $updatedLines = [];
    foreach ($lines as $line) {
        $fields = explode(',', $line);
        if (isset($fields[4])) {
            $gender = $fields[4];
            if (!($gender === 'male' || $gender === 'female')) {
                $fields[4] = 'none';
                $genderCount++;
            }
            $updatedLines[] = implode(',', $fields);
        }
    }
    echo "Ошибки в поле gender: $genderCount";
    return implode("\n", $updatedLines);
}
 function validateEmails($content) {
     $emailCount = 0;
     $currentEmailCount = 0;
     $lines = explode("\n", $content);
     $updatedLines = [];
     foreach ($lines as $line) {
         $fields = explode(',', $line);
         if (isset($fields[7])) {
             $email = $fields[7];
             $cleanedEmail = preg_replace('/[^a-zA-Z0-9._%+\-@]/', '', $email, -1, $currentEmailCount);
             $emailCount+=$currentEmailCount; //возможно надо делать +1, если currentEmailCount !=0
             if (substr_count($email, '@') > 1) {
                 $parts = explode('@', $email, 2);
                 $cleanedEmail = $parts[0] . '@' . preg_replace('/@+/', '', $parts[1]);
                 $emailCount++;
             }
             //$cleanedEmail = preg_replace('/@+/', '@', $cleanedEmail,$emailCount);

             if (!str_contains($cleanedEmail,'@')){
                 $pos = strlen($fields[1])+strlen($fields[2])+strlen($fields[3]);
                 $cleanedEmail= substr($cleanedEmail, 0, $pos). "@" . substr($cleanedEmail, $pos);
                 $emailCount++;
             }
             if (!str_contains($cleanedEmail,'.com')){
                 $cleanedEmail= $cleanedEmail . '.com';
                 $emailCount++;
             }
             if (preg_match('/^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.(com)$/', $cleanedEmail)) {
                $fields[7] = $cleanedEmail;
             }
             else{
                 $fields[7] = 'invalid';
                 $emailCount++;
             }
             //возможны дубликаты в подсчетах
         }
         $updatedLines[] = implode(',', $fields);
     }
     echo "Ошибки в поле email: $emailCount ";
     return implode("\n", $updatedLines);
}

 function preparePhone($content){
     $lines = explode("\n", $content);
     $updatedLines = [];
     foreach ($lines as $line) {
         $fields = explode(',', $line);
         if(isset($fields[8])) {
             $phone = $fields[8];
         }
         else{
             continue;
         }
             if (strlen($phone)-2 == 10) {
                if(!preg_match('/\d{3}-\d{3}-{4}/',$phone)){
                    $cleanedLine = preg_replace('/\D/', '', $phone);
                    $formattedLine = substr($cleanedLine, 0, 3) . '-' . substr($cleanedLine, 3, 3) . '-' . substr($cleanedLine, 6);
                        $fields[8] = $formattedLine;
                    }
             }
             if (strlen($phone)-2==9){
                 if(!preg_match('/\d{2}-\d{3}-{4}/',$phone)){
                     $cleanedLine = preg_replace('/\D/', '', $phone);
                     $formattedLine = substr($cleanedLine, 0, 2) . '-' . substr($cleanedLine, 2, 3) . '-' . substr($cleanedLine, 5);
                     $fields[8] = $formattedLine;
                 }
             }
             if (strlen($phone)-2==8){
                 if(!preg_match('/\d{2}-\d{3}-{4}/',$phone)){
                     $cleanedLine = preg_replace('/\D/', '', $phone);
                     $formattedLine = substr($cleanedLine, 0, 1) . '-' . substr($cleanedLine, 1, 3) . '-' . substr($cleanedLine, 4);
                     $fields[8] = $formattedLine;
                 }
             }
         $updatedLines[] = implode(',', $fields);
     }
     return implode("\n", $updatedLines);

 }

//echo ($newPhones);
function roundWeight($content){
    $lines = explode("\n", $content);
    $updatedLines = [];
    foreach ($lines as $line) {
        $fields = explode(',', $line);
        $fields[12] = (int)round(floatval($fields[12]),0);
        $updatedLines[] = implode(',', $fields);
    }
    return implode("\n", $updatedLines);
}


