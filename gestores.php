<?
include( 'inc/conect.php' );

?>

<div class="container bg-light mt-5 border rounded p-2">
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container-fluid"> <a class="navbar-brand" href="#">Gestores</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">  <button type="button" data-id="nuevo" class="btn btn-light myModal" data-bs-toggle="modal" data-bs-target="#myModal">
    Nuevo
  </button> </li>
            <li>&nbsp;&nbsp;</li>
            
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
    
<div class="container border-top mt-2 pb-1">
  <div class="row bg-white border rounded p-2">
    <div class="col">
      #
    </div>
    <div class="col">
      Nombre
    </div>
    <div class="col">
      Actions
    </div>
  </div>
    
  <? $gestores = $CNSLTS->full_list('gestores',"");
    foreach($gestores as $each_g){
    ?>
  <div class="row bg-light mt-1 p-1 border-bottom">
    <div class="col">
      <?=$each_g['id']?>
    </div>
    <div class="col">
      <?=$each_g['nombre']?>
    </div>
    <div class="col">
      <i class="bi bi-save myModal" data-id="<?=$each_g['id']?>" data-id="<?=$each_g['id']?>" data-bs-toggle="modal" data-bs-target="#myModal"></i>
      <i class="bi bi-trash"></i>
    </div>
  </div>
  <? }?>
    
    
</div>    
    
</div>
<script>
const myLink = gebc("myModal");

myLink.forEach(boton => {
    boton.addEventListener('click', () => {
      var idC = boton.getAttribute('data-id');
      event.preventDefault(); // This will prevent the link from navigating
      linkAction ('bat/gestores.php','id='+idC,'modal-response','search')
    });
});
    
</script>


