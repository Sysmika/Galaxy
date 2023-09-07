
<nav class="navbar navbar-expand-lg bg-light"> 
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="container-fluid"> <a class="navbar-brand" href="#"><i class="bi bi-activity"></i> Config</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="bi bi-chevron-expand"></span> </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"></li>
        <a class="nav-link active" aria-current="page" href="#" onClick="linkAction('settings/config.php','','alpha','search')"><i class="bi bi-filetype-css"></i> Customize</a>
        </li>
        <?
        ksort( $_SESSION[ 'ACCESO' ][ 'Config' ] );
        foreach ( $_SESSION[ 'ACCESO' ][ 'Config' ] as $KII => $VII ) {
          ?>
        <li class="nav-item"></li>
        <a class="nav-link active text-capitalize" aria-current="page" href="#" onClick="linkAction ('<?=$KII?>.php','','alpha','search')"><i class="bi bi-archive"></i>
        <?=$VII?>
        </a>
        </li>
        <? }?>
      </ul>
    </div>
  </div>
</nav>
