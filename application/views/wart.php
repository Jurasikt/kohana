<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <title>Write Articles</title>
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
            <li class="active"><a>Write articles<span class="sr-only">(current)</span></a></li>
            <li><a href="<?=URL::base()?>">Back to main</a></li>

          </ul>
          <form class="navbar-form navbar-left" >
            <div class="form-group">
              <input type="text" class="form-control" placeholder="не кликабельно">
            </div>
            <button  class="btn btn-default">Submit</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="<?=URL::base()?>articles">Articles</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>

<div class="zero-50"></div>
<div class="zero-50"></div>
<div class="container">
  

<form method="post" action="save">
  <div class="form-group">
  <div class="headers">
  <?php if (isset($title)): ?>
    <h1>Правка: <?=$title?></h1>
  <?php else: ?>
    <h1>Новая статья</h1>
  <?php endif; ?>
  </div>
    <div class="col-md-8">
      <label>Title</label>
      <input  class="form-control" name="title" placeholder="Title" value="<?=isset($title)?$title:''?>">      
    </div>
  </div>
  <div class="zero-50"></div>
  <div class="form-group">
    <input type="hidden" name = "id" value="<?=isset($id)?$id:''?>">
    <div class="col-md-8">
      <div class="zero-50"></div>
      <textarea class="form-control" rows="15" name='text'>
        <?=isset($text)?$text:''?>
      </textarea>
      <div class="zero-50"></div>
      <button type="submit" class="btn btn-default">Save</button>
    </div>
    
  </div>
</form>
</div>
<div class="zero-50"></div>


</body>
</html>  