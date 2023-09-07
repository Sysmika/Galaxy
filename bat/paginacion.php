<?
 //******--------determinar las páginas---------******//
 $PagAnt		= $PagAct-1;
 $PagSig		= $PagAct+1;
 $PagUlt		= $PagTT / $PagMax;
 $Res			= $PagTT%$PagMax;
 if($Res>0) $PagUlt	= floor($PagUlt)+1;
?>

<nav>
  <ul class="pagination justify-content-center mt-4 small p-0">
    <? if($PagAct>1) {?>
      <li class="page-item cpoint small traslucido" onClick="load_post('<?= $PagDoc; ?>','pag=1<?= $var_page; ?>','gama<?=$_POST['acceso_id']?>')"><a class="page-link text-always-black">&laquo;&laquo;</a></li>
      <li class="page-item cpoint small traslucido" onClick="load_post('<?= $PagDoc; ?>','pag=<?= $PagAnt ?><?= $var_page; ?>','gama<?=$_POST['acceso_id']?>')"><a class="page-link text-always-black" >&laquo;</a></li>
            <? }?>
            <? if($PagUlt!=0) {?>
      <li class="page-item small traslucido"><a class="page-link text-always-black"><strong><?= $PagAct." de ".$PagUlt;?></strong></a></li>
         <? }?>
         <? if($PagAct<$PagUlt)  {?>
      <li class="page-item cpoint small traslucido" onClick="load_post('<?= $PagDoc; ?>','pag=<?= $PagSig ?><?= $var_page; ?>','gama<?=$_POST['acceso_id']?>')"><a class="page-link text-always-black">&raquo;</a></li>
      <li class="page-item cpoint small traslucido" onClick="load_post('<?= $PagDoc; ?>','pag=<?= $PagUlt ?><?= $var_page; ?>','gama<?=$_POST['acceso_id']?>')"><a class="page-link text-always-black">&raquo;&raquo;</a></li>
         <? }?>
  </ul> 
</nav>
<!--
<nav>
  <ul class="pagination justify-content-center mt-4">
    <li class="page-item">
      <a class="page-link bg-light" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link bg-light" href="#">1</a></li>
    <li class="page-item"><a class="page-link bg-light" href="#">2</a></li>
    <li class="page-item"><a class="page-link bg-light" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link bg-light" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>       

-->
    