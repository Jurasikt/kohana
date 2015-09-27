<?php 
$url = URL::base().'public/img/s_';

 ?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">

  <title>Upload</title>
  <link   href = '<?=URL::base()?>public/css/bootstrap.css' rel="stylesheet">
  <script src  = '<?=URL::base()?>public/js/jquery.min.js' ></script>
  <link   href = '<?=URL::base()?>public/css/carousel.css' rel="stylesheet">
  <script src  = '<?=URL::base()?>public/js/bootstrap.min.js'></script>
</head>
<body>
  <div class="container">
    <div class="headers">
      <h1>Описание для фоток</h1>
    </div>
    <form class="form-horizontal" action="<?=URL::base()?>upload/finish" method="POST">
    <?php  for ($i=0; $i < count($name); $i++) { ?>
      <div class="form-group">
        <div class="col-md-3">
          <img src=<?=$url.$name[$i]?> class="img-thumbnail">
        </div>
        <div class="col-sm-3">
          <textarea class="form-control" rows="3" name=<?=$name[$i]?>></textarea>
        </div>
      </div>
    <?php }?>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-3">
        <button type="submit" class="btn btn-default">Завершить</button>
      </div>
    </div>
    </form>
  </div>
</body>
</html>