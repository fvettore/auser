<?php
$query="insert into auser.autisti set cognome=? , nome=?";
$smt=$db->prepare($query);
$smt->bind_param("ss", urldecode($pagina->parametri[1]),urldecode($pagina->parametri[2]));
$smt->execute();
echo "OK";

