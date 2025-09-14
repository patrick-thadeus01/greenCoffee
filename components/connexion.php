<?php
$db_name = 'mysql:host = localhost;dbname=shop_db';
$db_user = 'root';
$dbpassword = '';

$conn = new PDO($db_name, $db_user, $dbpassword);

function unique_id()
{
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charlength = strlen($chars);
    $randomString = ' ';

    for ($i=0; $i < 20; $i++) {
        $randomString.=$chars[mt_rand(0, $charlength - 1)]; 
    }
    return $randomString;
}
?>
