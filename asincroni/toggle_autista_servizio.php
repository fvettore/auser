<?php
$idautisti=$pagina->parametri[2];
$idservizi=$pagina->parametri[1];

if(autistaAbilitato($idautisti, $idservizi)){
    $query="delete from auser.autisti_servizi where idautisti=? and idservizi=?";
    $smt=$db->prepare($query);
    $smt->bind_param("ii",$idautisti,$idservizi);
    $smt->execute();
}
else {
    $query="insert into auser.autisti_servizi set idautisti=?, idservizi=?";
    $smt=$db->prepare($query);
    $smt->bind_param("ii",$idautisti,$idservizi);
    $smt->execute();
}
echo "OK";

