<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css\reset.css" rel="stylesheet">
    <link href="css\sidebar.css" rel="stylesheet"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
</head>
<body>
    <!-- <div class = "back"> -->
        <!-- <sidebar> -->
            <!-- <input class = "back" type="button" value="前に戻る" style="width:200px;height:50px" onClick="window.history.go(-1);" /> -->
        <!-- </sidebar> -->
    <!-- </div> -->
    <!-- <script src="JS\header.js"></script> -->
    <p class="pagetop"><a href="#wrap">TOP▲</a></p>
    <script>
$(document).ready(function() {
  var pagetop = $('.pagetop');
    $(window).scroll(function () {
       if ($(this).scrollTop() > 100) {
            pagetop.fadeIn();
       } else {
            pagetop.fadeOut();
            }
       });
       pagetop.click(function () {
           $('body, html').animate({ scrollTop: 0 }, 200);
              return false;
   });
});
</script>
</body>
</html>







