<h1>Upload image</h1>
<?php showMessage()?>
<form action="index.php" method="post" enctype="multipart/form-data">
<div class="form-group">
    <label for="file">Select Image:</label>
    <input type="file" name="file" id="file" class="form-control">
</div>

<button class="btn btn-primary mt-3" name="action" value="uploadImage">Send</button>
</form>

<?php
$files=glob('upload/*',GLOB_ONLYDIR);//получаем только пути к папкам
 
$files=glob('upload/*');
foreach($files as $file){
if(!is_dir($file)){
    echo "<img src='$file'>";
}  
}
dump($files); 

/* $files=glob('upload/small_*.{jpg,png,gif}',GLOB_BRACE);//выбери определенные файлы
dump($files); */

?>