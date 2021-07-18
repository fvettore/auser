<?php
/******************************************************************************
 *  modifica record
 */

$tabella=$pagina->parametri[1];
$campoid=$pagina->parametri[2];
$id=$pagina->parametri[3];
$campo= urldecode($pagina->parametri[4]);
$valore= urldecode($pagina->parametri[5]);
//$query="UPDATE $tabella set $campo = ? where $campoid = ?";
$query="UPDATE ? set $campo = ? where $campoid = ?";
$smt=$db->prepare($query);
$smt->bind_param("ssi",$tabella,$valore,$id);
$smt->execute();
//check valore corretto: query al contrario- restituisce alla pagina che ha chiamato l'asincrono
$query="select $campo from auser.$tabella where $campoid=?";
$p=$db->prepare($query);
$p->bind_param("i",$id);
$p->execute();
$res=$p->get_result();
$l=$res->fetch_array();
echo $l[0];   
