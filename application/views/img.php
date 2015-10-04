<?php 
$i   = URL::site().'public/img/m_';
$s   = URL::site().'public/img/s_';
$len = round(count($all)/2);
$active = 'active';
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">

  <title> Image </title>
  <link href=  '<?=URL::base()?>public/css/bootstrap.css' rel="stylesheet">
  <script src= '<?=URL::base()?>public/js/jquery.min.js' ></script>
  <link   href='<?=URL::base()?>public/css/carousel.css' rel="stylesheet">
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
            <li class="active"><a href="#">Image<span class="sr-only">(current)</span></a></li>
            <li><a href="<?=URL::base()?>">Back to main</a></li>

          </ul>
          <form class="navbar-form navbar-left" >
            <div class="form-group">
              <input type="text" class="form-control" placeholder="не кликабельно">
            </div>
            <button  class="btn btn-default">Submit</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?=URL::base()?>upload">Upload</a></li>

          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>

<!-- c -->

<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  <?php foreach ($img as $key => $name) : ?>
    <div class="item <?=$active?>">
      <img src="<?=$i.$key?>">
      <div class="carousel-title carousel-caption">
        <h2>Случайное фото</h2>
        <h3><?=$name?></h3>
      </div>
    </div>
  <?php 
  if ($active == 'active') $active = '';
  endforeach;
  ?>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <!-- <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> -->
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <!-- <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> -->
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="color-crem">
  <div class="container">
    <div class="headers">
      <h1>Мои отчеты о покатушках</h1>
    </div>
    <?php for ($i=0; $i < $len; $i++) : ?>

    <div class="row">
      <div class="col-md-6 headers">
        <div class = "margin-all-sm">
          <img src="<?=$s.$all[$i*2]['file']?>" class = "img-rounded pnt">
          <div class = "headers">
            <h4><?=$all[$i*2]['title'] ?></h4>
          </div>
        </div>
      </div>

      <?php if (isset($all[2*$i+1])) : ?>
      <div class="col-md-6 headers">
        <div class = "margin-all-sm">
          <img src="<?=$s.$all[$i*2+1]['file']?>" class = "img-rounded pnt">
          <div class = "headers">
            <h4><?=$all[$i*2+1]['title']?></h4>
          </div>
        </div>
      </div>
      <?php endif;?>
    </div>
    <?php endfor;?>


  </div>
</div>

<footer class="color-bl">
  <div class="container">
  <h2>Contact: example@example.com</h2>
  </div>
  <div class="zero-50"></div>
</footer>

<!-- modal -->

<div class="lock">
  <div class="modal-shim">
    <div class="modal-m">
      <h3 id ='esc' class="pnt">esc</h3>
      <img class="img-thumbnail" id= "modal">
      <div>
        vdfzsvfds
      </div>
    </div>
  </div>
</div>

</body>
<script type="text/javascript">
  var url = 'public/img/m_';
  $('.carousel').carousel({
    interval: 6500
  });

  $(".img-rounded").click(function(event){
    $(".lock").show();
    var x = $(event.currentTarget).attr("src");
    x = url+x.substring(x.search('s_')+2,x.length);
    $("#modal").attr("src", x);
    $('body').css('overflow','hidden');
  });

  $("#esc").click(function(){
    $(".lock").hide();
    $('body').css('overflow','visible');
  });
</script>
</html>