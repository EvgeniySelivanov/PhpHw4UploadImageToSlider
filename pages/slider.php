<h1>Slider </h1>

<?php
$sliders = glob('images/*', GLOB_ONLYDIR);
foreach ($sliders as $slider) :
?>
 
  <section class="regular slider">
    <?php
    $images = glob($slider . '/small_*.{jpg,gif,png}', GLOB_BRACE);
    foreach ($images as $img) :
    ?>

      <div>
        <a href="<?= str_replace('small_', '', $img)  ?>" data-fancybox><img src="<?= $img ?>"></a>
      </div>

    <?php endforeach ?>
  </section>
<?php endforeach ?>









<!--  <section class="regular slider">
      <div>
        <img src="images\Animals\small_1640197203855_IMG_1526">
      </div>
      <div>
        <img src="images\Animals\small_1640195920233_IMG_1638.JPG">
      </div>
      <div>
        <img src="images\Animals\small_1640195951853_ПРАЗДНИК ПАП готовый вариант.jpg">
      </div>
      <div>
        <img src="images\Animals\small_1640195951853_ПРАЗДНИК ПАП готовый вариант.jpg">
      </div>
</section>  -->