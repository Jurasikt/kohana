<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <title>Articles</title>
    <link   href = '<?=URL::base()?>public/css/bootstrap.css' rel="stylesheet">
    <script src  = '<?=URL::base()?>public/js/jquery.min.js' ></script>
    <link   href = '<?=URL::base()?>public/css/carousel.css' rel="stylesheet">
    <script src  = '<?=URL::base()?>public/js/bootstrap.min.js'></script>
  </head>

<body>
<div class="navbar-wrapper">
  <div class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
   
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=URL::base()?>">VeloBy</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li class="active"><a>Articles<span class="sr-only">(current)</span></a></li>
            <li><a href="<?=URL::base()?>">Back to main</a></li>

          </ul>
          <form class="navbar-form navbar-left" >
            <div class="form-group">
              <input type="text" class="form-control" placeholder="не кликабельно">
            </div>
            <button  class="btn btn-default">Submit</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="<?=URL::base()?>articles/write">Write articles</a></li>

          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>

<div class="zero-50"></div>
<div class="zero-50"></div>
<div class="headers"> <h1> Полезные вещи </h1></div>
<div class="container">
  <div class="col-md-2"></div>
  <div class="col-md-8">
  <?php foreach ($all as $id => $title) :?>
    <li>
      <a href="articles/id<?=$id?>"><?=$title?></a>
    </li>
  <?php endforeach; ?>
  </div>
  <div class="col-md-2"></div>
</div>


<div class="zero-50"></div>



</body>
</html>  