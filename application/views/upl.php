<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Upload</title>

  <link href=  '<?=URL::base()?>public/css/bootstrap.css' rel="stylesheet">
  <link   href='<?=URL::base()?>public/css/carousel.css' rel="stylesheet">
  <script src= '<?=URL::base()?>public/js/jquery.min.js' ></script>
  <script src= '<?=URL::base()?>public/js/bootstrap.min.js'></script>
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
            <li><a href="<?=URL::base()?>image">Image</a></li>
            <li><a href="<?=URL::base()?>">Back to main</a></li>

          </ul>
          <form class="navbar-form navbar-left" >
            <div class="form-group">
              <input type="text" class="form-control" placeholder="не кликабельно">
            </div>
            <button  class="btn btn-default">Submit</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Upload<span class="sr-only">(current)</span></a></li>

          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>
<div class="zero-50"></div>
<div class="zero-50"></div>
  <div class="container">
    <h2 class="headers"> Загрузка фото (допустимый формат jpg.) </h2>
    <form action="<?=URL::base()?>upload/next" method="post" enctype="multipart/form-data">
    <input type="file"  min="1" max="10" multiple="true" name="file[]"> <br>
    <input type="submit" value="Загрузить" class="btn"><br>
    </form>   
  </div>

</body>
</html>

<!-- min="1" max="10" multiple="true"-->