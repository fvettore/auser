<?php
include './includes/functions.php';
include './includes/db.php';
include './includes/config.php';

elaboraURL();    
//chiamato script asincrono da JS
if($pagina->template==='asincroni'){
     include "asincroni.php";
}
//altrimenti serve la pagina WEB completa
else {
    include "header.php";
    include "body.php";//a sua volta includerà un template
    include "footer.php";
}
