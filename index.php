<?php
include './includes/functions.php';
include './includes/db.php';
include './includes/config.php';

elaboraURL();    
if($pagina->template==='asincroni'){
     include "asincroni.php";
}
else {
    include "header.php";
    include "body.php";//a sua volta includerà un template
    include "footer.php";
}
