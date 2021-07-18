<?php
//SOLO QUESTI TEMPLATE SONO AUTORIZZATI E INCLUSI
if($pagina->template===''){
    include "./templates/home.php";
}
elseif($pagina->template==='mezzi'){
    include "./templates/mezzi.php";
}
elseif($pagina->template==='servizi'){
        include "./templates/servizi.php";
}
elseif($pagina->template==='autisti'){
        include "./templates/autisti.php";
}



