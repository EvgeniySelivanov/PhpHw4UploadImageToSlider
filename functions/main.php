<?php
session_start();

require_once 'homeWork.php';
require_once 'messages.php';
require_once 'helpers.php';


$page = clearString($_GET['page'] ?? 'home');
$action = clearString($_POST['action'] ?? ''); //'sendMail' в action подставляет название функции которую надо запустить, название в value кнопки на которую нажали
if ($action) {
    $action(); //переменная актион равно сенд меил по этому выходит sendMail()
}

function sendMail()
{                                           //если существует отправка(мэил это имя кнопки)
    $name = clearString($_POST['name']);
    $email = clearString($_POST['email']);
    $message = clearString($_POST['message']);

    if (!$name || !$email || !$message) {
        // echo '<div class="alert alert-danger"> error</div>';
        // $_SESSION['message'] = '<div class="alert alert-danger"> error</div>';     //key session
        setMessage('Error');
        setOldData(compact('name', 'email', 'message')); //compact создаёт из переменных ассоциативный массив

    } else {
        //email

        $to = 'genyaselivanovzp@gmail.com';
        $subject = 'Mail from site';
        $mess = "Name:$name <br> Email:$email;<br> Message:$message";

        if (mail($to, $subject, $mess)) {
            //echo '<div class="alert alert-success"> Thank!</div>';
            setMessage('Thank', 'success');
        } else {
            // echo '<div class="alert alert-danger"> error try again</div>';
            setMessage('Error.Try again');
        }
    }
    //header('Location:index.php?page=contacts');
    //exit; //останавливает выполнение php 
    redirect('contacts');
}

function ajaxSendMail()
{
    $name = clearString($_POST['name']);
    $email = clearString($_POST['email']);
    $message = clearString($_POST['message']);

    if (!$name || !$email || !$message) {

        echo json_encode(['text' => 'Error', 'success' => false]); //закодировали в джейсон для передачи в джава скрипт

    } else {
        //email

        $to = 'genyaselivanovzp@gmail.com';
        $subject = 'Mail from site';
        $mess = "Name:$name <br> Email:$email;<br> Message:$message";

        if (mail($to, $subject, $mess)) {

            echo json_encode(['text' => 'Thank', 'success' => true]);
        } else {

            echo json_encode(['text' => 'Error', 'success' => false]);
        }
    }

    exit;
}




/*
[name] => 1365401196_teplye-oboi-1-1024x557.jpeg
[type] => image/jpeg
[tmp_name] => D:\STUDENTS\web\OSPanel\userdata\php_upload\php38AD.tmp
[error] => 0
[size] => 125674
*/

function uploadImage()
{
    $file = $_FILES['file'];
    extract($file); //реструктуризация массива (разбили на переменные)
    if ($error == 4) {
        setMessage('File not selected');
        redirect('upload-image');
    }
    $accessType = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($type, $accessType)) {         //проверяет совпадет ли тип картинки со значениями в массиве $accessType
        setMessage('File is not image!!!');
        redirect('upload-image');
    }
    if ($size > 50 * 1024 * 1024) {     //ограничили размер в 50 мегабайт
        setMessage('Size is over!!!');
        redirect('upload-image');
    }

    if (!file_exists('upload')) //проверяет существование папки и если нет то создаём директорию
    {
        mkdir('upload'); //создаем директорию
    }
    $name = time() . rand(0, 1000) . '_' . $name; //для рандомного имени файла
    move_uploaded_file($tmp_name, "upload/$name"); //перемести файл из временной директории в ту которую мы назвали 

    cropImage("upload/$name", 300, false,'medium');
    cropImage("upload/$name", 150, true,'small');


    redirect('upload-image');
}

function cropImage($path, $dest_width, $crop,$size)
{
    //создаем изоборажение на основе пути
    $funcCreate='imagecreatefrom' . getTypeImage($path);
    $src =$funcCreate($path); //создай джипег на основе указанного пути
    $src_width = imagesx($src); // возвращает ширину изображение
    $src_height = imagesy($src); //высота изображения


    if ($crop) {                                                //если обрезать
        $dest = imagecreatetruecolor($dest_width, $dest_width); //создали квадрат
        if ($src_width > $src_height) {
            imagecopyresized($dest, $src, 0, 0, ($src_width - $src_height) / 2, 0, $dest_width, $dest_width, $src_height, $src_height);  //скопировали из большо картинки в маленькую
        } else {
            imagecopyresized($dest, $src, 0, 0, 0, ($src_height - $src_width) / 2, $dest_width, $dest_width, $src_width, $src_width);
        }
    }

else{                                                //пропорциональное изменение размеров

    $dest_height  =  $dest_width / ( $src_width/$src_height);//вычисляем соотношение сторон
    $dest = imagecreatetruecolor($dest_width, $dest_height);////создали прямоугольник
    imagecopyresized($dest,$src,0,0,0,0,$dest_width, $dest_height,$src_width,$src_height);
}

$funcSave='image' . getTypeImage($path);//===image+расширение(imagejpeg) как встроеная функция
extract (pathinfo($path));//извлекли $dirname,$size,$basename
//imagejpeg($dest, 'upload/crop.jpg');//создать изображение в заданной директории
$funcSave($dest,"$dirname/{$size}_$basename");

}


function getTypeImage($path){
$info=pathinfo($path);
return  strtolower($info['extension'])=='jpg'?'jpeg':$info['extension'];//если в инфо есть jpg возвращай jpeg иначе возвращай содержимое $info['extention']  и преобразовали в нижний регистр

}





/* $year=date('Y');
$months=date('m');
if(!file_exists('upload/'. $year))
{
    mkdir('upload/'.$year);
}
if(!file_exists("upload/$year/$months")){
    mkdir("upload/$year/$months");
} */
