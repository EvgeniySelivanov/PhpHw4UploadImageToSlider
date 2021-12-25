<?php require_once 'functions/main.php' ?>
<!--вызов функции проверки строк ввода-->
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="style/style.css">

  <link rel="stylesheet" type="text/css" href="js/slick/slick.css" />
  <link rel="stylesheet" type="text/css" href="js/slick/slick-theme.css" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
  <link rel="stylesheet" href="style/styleSlider.css">
  <title>Home work 4 PHP upload images</title>
</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Project</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link <?= $page == 'home' ? 'active' : '' ?>" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $page == 'contacts' ? 'active' : '' ?>" aria-current="page" href="index.php?page=contacts">Contacts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $page == 'upload-image' ? 'active' : '' ?>" aria-current="page" href="index.php?page=upload-image">Upload</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $page == 'sliderControl' ? 'active' : '' ?>" aria-current="page" href="index.php?page=sliderControl">Slider Control</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $page == 'slider' ? 'active' : '' ?>" aria-current="page" href="index.php?page=slider">Slider</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>

  <div class="container">
    <?php

    if (file_exists('pages/' . $page . '.php')) {

      require 'pages/' . $page . '.php';
      clearOldData();
    } else {
      require 'pages/404.php';
    }
    ?>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="js/slick/slick.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('.regular').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
    });
  </script>
  <script src="js/script.js"></script>
</body>

</html>