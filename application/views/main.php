<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <title>Kohana Template</title>
    <link href= '<?=URL::base()?>public/css/bootstrap.css' rel="stylesheet">
    <link href= '<?=URL::base()?>public/css/cover.css' rel="stylesheet">
    <script src= '<?=URL::base()?>public/js/jquery.min.js' ></script>
  </head>
<body>
    <div class="site-wrapper">
    <div class="flex">
      <div class="cover-container">
        <div class="masthead clearfix">
          <div class="inner">
            <h3 class="masthead-brand">VeloBy</h3>
            <nav>
              <ul class="nav masthead-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="<?=URL::base()?>image">Image</a></li>
                <li><a href="<?=URL::base()?>upload">Upload Image</a></li>
                <li><a href="<?=URL::base()?>articles">Articles</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <?php if (!$login) { ?>
      <a class="btn-xt" id="signin">Login</a>
      <?php } ?>
    </div>

      <div class="site-wrapper-inner">
            
          
          <div class="inner cover cover-container">
            <h1 class="cover-heading">Мои путешествия.</h1>
            <p class="lead">Для того чтобы, что-то увидеть авторизуйтесь.</p>
          </div>
      </div>
      
      <!-- row -->

  </div> 


  <!-- modal dlg -->

<div class="lock" id="sign">
  <div class="modal-shim">
    <div class="modal-m">
      <div class="headers"><h1>Sign Up</h1> </div>
      <div class="zero-20"></div>
      <div class="form-error"></div>
      <form id = "form-sign">
        <div class="margin-all-sm">
          <p>Enter login</p>
          <input type="text" class="form-control" name = "login" placeholder="Login">
          <div class="zero-20"></div>
          <p>Enter Password</p>
          <input type="password" class="form-control" name = "password" placeholder="Password">
        </div>
        <div class="flex">
          <div class="btn btn-success btn-md margin-left-sm" id = "btn-sign">Login</div>
          <div class="btn btn-danger btn-md margin-left-sm cancel1" >Cancel</div>
        </div>
        <div class="zero-20"></div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
 var site = '<?=URL::site()?>'+'ajax/login';
 var img  = '<?=URL::site()?>'+'image';
  $("#signin").click(function(event){
    $("#sign").show();
    $('body').css('overflow','hidden');
  });
  
  $(".btn-danger").click(function(){
    $('.form-error').html('');
    $(".lock").hide();
    $('body').css('overflow','visible');
  });

$('#btn-sign').click(function() {
  var form = $('#form-sign').serialize();
  $.post(site,form,function(json){
    $('.form-error').html(''); 
    if (json.success == false) {
      for (var i = json.error.length - 1; i >= 0; i--) {
        $('.form-error').append('<li> '+json.error[i]+'</li>');
      };      
    } else {
      $(".lock").hide();
      $('body').css('overflow','visible');
      window.location.replace(img);
    }
  },'json');
});

</script>

</body>
</html>