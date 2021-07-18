<?php
function elaboraURL(){
    global $pagina;
    $URL=$_SERVER['REQUEST_URI'];
    $URL=str_replace("/auservoghera","",$URL);
    $URLparts = explode("/", $URL);
    $pagina->template=$URLparts[1];
    //parametri
    $conteggio=0;
    for($x=2;$x<count($URLparts);$x++){
        $pagina->parametri[$conteggio]=$URLparts[$x];
        $conteggio++;
    }

}
function autistaAbilitato($idautisti,$idservizi){
    global $db;
    $query="select idautisti_servizi from auser.autisti_servizi where idautisti=? and idservizi=?";
    $smt=$db->prepare($query);
    $smt->bind_param("ii",$idautisti,$idservizi);
    $smt->execute();
    $r=$smt->get_result();
    return($r->num_rows);   
}