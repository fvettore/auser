<?php
$query="insert into auser.mezzi set codice=? , descrizione=?, targa=?";
$smt=$db->prepare($query);
$smt->bind_param("sss", urldecode($pagina->parametri[1]),urldecode($pagina->parametri[2]),urldecode($pagina->parametri[3]));
$smt->execute();
echo "OK";

