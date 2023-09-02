<?
session_start();
	if(isset($_SESSION["usuario"])){
		header ("Location: //".$_SERVER[HTTP_HOST]."/panel.php");
	}
$_SESSION['token'] = uniqid('log_');
$error = false;
if(isset($_SESSION["error"])) $error = '<div class="alert alert-warning">'.$_SESSION["error"].'</div>';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="canonical" href="https://sysmika.org/">
  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
  </style>

    
    <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
</head>
<body class="text-center">
    
<main class="form-signin">
  <form action="inc/login.php" method="post">
    <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
    <img class="mb-2" src="img/logo/logo.png" alt="" width="100">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
      <?=$error?>
    <div class="form-floating">
      <input type="email" class="form-control" name="email" placeholder="name@example.com">
      <label for="email">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" placeholder="Password">
      <label for="password">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">Orion System <small>(class GALAXY)</small></p>
    <p class="mt-5 mb-3 text-muted">&copy; 1999–<?= date("Y");?></p>
  </form>
</main>


    
  </body>
</html>
