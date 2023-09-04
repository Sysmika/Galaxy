<?
include( 'inc/conect.php' );
//echo'<pre>';print_r($_SESSION);echo'</pre>';
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
<meta charset="utf-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="canonical" href="https://sysmika.org/panel.php">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script defer src="js/bootstrap.js"></script> 
<script defer src="js/orion.js"></script> 
<script defer src="js/sidebars.js"></script>
</head>
<body>
<div class="offcanvas offcanvas-top" id="topcanvas">
  <div class="offcanvas-header">
    <h1 class="offcanvas-title">Heading</h1>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <p>Some text lorem ipsum.</p>
    <button class="btn btn-secondary" type="button">A Button</button>
  </div>
</div>
  <aside>
    <div class="d-flex flex-column flex-shrink-0 bg-light">
      <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
        <li class="nav-item"><a href="#" class="nav-link active py-3 border-bottom" aria-current="page" title="Dashboard" data-bs-toggle="tooltip" data-bs-placement="right"> <i class="bi bi-house" data-bs-toggle="offcanvas" data-bs-target="#topcanvas"></i></a> </li>
        <li> <a href="#" onClick="linkAction ('clientes.php','','alpha','search')" class="nav-link py-3 border-bottom" title="Clientes" data-bs-toggle="tooltip" data-bs-placement="right"> <i class="bi bi-people-fill"></i> </a> </li>
        <li> <a href="#" onClick="linkAction ('gestores.php','','alpha','search')" class="nav-link py-3 border-bottom" title="Gestores" data-bs-toggle="tooltip" data-bs-placement="right"> <i class="bi bi-boxes"></i> </a> </li>
        <li> <a href="#" onClick="linkAction ('parametros.php','','alpha','search')" class="nav-link py-3 border-bottom" title="Parametros" data-bs-toggle="tooltip" data-bs-placement="right"> <i class="bi bi-diagram-3"></i> </a> </li>
      </ul>
      <div class="dropdown border-top"> <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false"> <img src="img/logo/logo.png" alt="mdo" width="24" height="24" class="rounded-circle"> </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
          <li><a class="dropdown-item" href="#"  onClick="linkAction ('settings/config.php','','alpha','search')">Settings</a></li>
          <!--<li><a class="dropdown-item" href="#">Profile</a></li>-->
          <li><a class="dropdown-item" href="https://soporte.sysmika.ar" target="_blank">Support</a></li>
          <li><a class="dropdown-item" href="#"  onClick="linkAction ('about.php','','alpha','search')">About</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item text-danger fw-bolder" href="inc/logout.php"><i class="bi bi-x-square"></i> Sign out</a></li>
        </ul>
      </div>
    </div>
  </aside>
  <div id="alpha" class="bg-white">
      <pre><? print_r($_SESSION)?></pre>
  </div>
    <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="modal-response">
        Modal body..
      </div>
    </div>
  </div>
</div>
</body>
</html>
