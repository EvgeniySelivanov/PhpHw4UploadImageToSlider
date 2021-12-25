<?php




function uploadImageHomework()
{
  $linkFolder = $_POST['linkFolder']; // 123
  $file = $_FILES['file'];  // array

  extract($file); //реструктуризация массива (разбили на переменные)
  if ($error == 4) {
    setMessage('File not selected');
    redirect('sliderControl');
  }
  $accessType = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
  if (!in_array($type, $accessType)) {         //проверяет совпадет ли тип картинки со значениями в массиве $accessType
    setMessage('File is not image!!!');
    redirect('sliderControl');
  }
  if ($size > 50 * 1024 * 1024) {     //ограничили размер в 50 мегабайт
    setMessage('Size is over!!!');
    redirect('sliderControl');
  }

  $name = time() . rand(0, 1000) . '_' . $name; //для рандомного имени файла
  
  move_uploaded_file($tmp_name, "images/$linkFolder/$name"); //перемести файл из временной директории в ту которую мы назвали 

  cropImage("images/$linkFolder/$name", 300, false, 'medium');
  cropImage("images/$linkFolder/$name", 150, true, 'small');


  redirect('sliderControl');
}



function createSlider()
{
  $folderName = clearString($_POST['folderName']);
  if (!file_exists("images/{$folderName}")) //проверяет существование папки и если нет то создаём директорию
  {
    mkdir("images/{$folderName}"); //создаем директорию
  }

  redirect('sliderControl');
}



function RDir()
{
  $linkFolder = $_POST['linkFolder'];
  // если путь существует и это папка
  if (file_exists("images/$linkFolder") and is_dir("images/$linkFolder")) {
    // открываем папку
    $dir = opendir("images/$linkFolder");
    while (false !== ($element = readdir($dir))) {
      // удаляем только содержимое папки
      if ($element != '.' and $element != '..') {
        $tmp = "images/$linkFolder" . '/' . $element;
        chmod($tmp, 0777);
        // если элемент является папкой, то
        // удаляем его используя нашу функцию RDir
        if (is_dir($tmp)) {
          RDir($tmp);
          // если элемент является файлом, то удаляем файл
        } else {
          unlink($tmp);
        }
      }
    }
    // закрываем папку
    closedir($dir);
    // удаляем саму папку
    if (file_exists("images/$linkFolder")) {
      rmdir("images/$linkFolder");
    }
  }
  redirect('sliderControl');
}
