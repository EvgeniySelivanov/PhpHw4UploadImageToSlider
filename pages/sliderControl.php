<h1>Slider Control</h1>
<?php

use function PHPSTORM_META\type;

showMessage() ?>

<form action="index.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="file">Name Slider:</label>
        <input type="text" name="folderName" id="folderName" class="form-control">
    </div>

    <button class="btn btn-primary mt-3" name="action" value="createSlider">Create</button>
</form>

<hr>


<form action="index.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <p>Select slider</p>
        <select name="linkFolder" id="linkFolder">
            <?php
            $files = glob('images/*', GLOB_ONLYDIR);
            foreach ($files as $file) {
                echo "<option>" . mb_substr($file, 7) . "</option>";
            }
            ?>
        </select>
        <br>
        <div class="select-image">
            <label for="file">Select Image:</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
    </div>

    <button class="btn btn-primary mt-3" name="action" value="uploadImageHomework">Upload</button>
</form>



<hr>



<form action="index.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <p>Delete slider</p>
        <select name="linkFolder" id="linkFolder">
            <?php
            $files = glob('images/*', GLOB_ONLYDIR);
            foreach ($files as $file) {

                if (is_dir($file)) {

                    echo "<option>" . mb_substr($file, 7, (strlen($file) - 7)) . "</option>";
                }
            }
            ?>
        </select>
    </div>

    <button class="btn btn-primary mt-3 btn-delete" name="action" value="RDir">Delete</button>
</form>