<?php
//GLI UNICI ASINCRONI ACCETTATI SONO QUESTI
//(si poteva includere automaticamente, ma è meglio stare sul sicuro)
if($pagina->parametri[0]=='elimina_mezzo'){
    include "./asincroni/elimina_mezzo.php";
}
elseif($pagina->parametri[0]=='inserisci_mezzo'){
    include "./asincroni/inserisci_mezzo.php";
}
elseif($pagina->parametri[0]=='inserisci_servizio'){
    include "./asincroni/inserisci_servizio.php";
}
elseif($pagina->parametri[0]=='elimina_servizio'){
    include "./asincroni/elimina_servizio.php";
}
elseif($pagina->parametri[0]=='inserisci_autista'){
    include "./asincroni/inserisci_autista.php";
}
elseif($pagina->parametri[0]=='elimina_autista'){
    include "./asincroni/elimina_autista.php";
}
elseif($pagina->parametri[0]=='modifica'){
    include "./asincroni/modifica.php";
}
elseif($pagina->parametri[0]=='toggle_autista_servizio'){
    include "./asincroni/toggle_autista_servizio.php";
}