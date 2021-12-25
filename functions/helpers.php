<?php
function dump($array)
{
    echo '<pre>' . print_r($array, true) . '</pre>'; //точка работает в конкатенации как плюс в JS
}
function clearString(string $str)
{
    return htmlentities(trim($str));
}
function redirect($page)
{
    header('Location:index.php?page=' . $page);
    exit;
}