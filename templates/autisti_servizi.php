<?php
$idautisti=$pagina->parametri[0];
$query="select * from autisti where idautisti=?";
$smt=$db->prepare($query);
$smt->bind_param("i",$idautisti);
$smt->execute();
$res=$smt->get_result();
$l=$res->fetch_array();
$nome=$l['nome'];
$cognome=$l['cognome'];
?>
<a href="<?=SITE_URL?>">&lt;-HOME</a>&lt;-<a href="<?=SITE_URL."/autisti"?>">AUTISTI</a>
<h3>Assegnazione servizi autista <?="$cognome $nome"?></h3>
    
<table class="table table-striped">
    <thead>
      <tr>
        <th>codice</th>
        <th>descrizione</th>
        <th>abilitato</th>
       </tr>
    </thead>
    
<?php
$query="select * from auser.servizi where disabilitato <>1 order by codice";
$res=$db->query($query);
while($l=$res->fetch_array()){
    $idservizi=$l["idservizi"];
    $codice=$l['codice'];
    $descrizione=$l['descrizione'];
    if(autistaAbilitato($idautisti, $idservizi))$checked="checked";
    else $checked=""
?>        
     <tr>
         <td> <?=$codice?> </td>
         <td> <?=$descrizione?> </td>
         <td> <input class="form-check-input" type="checkbox" <?=$checked?> id="check_<?=$idservizi?>"> </td>
     </tr>    
<?php        
    }
?>
</table>
    
<script>
$( document ).ready(function() {
    $(":checkbox").change(function(){
        var checkid = $(this).attr("id").substr(6);
        var URL="<?=SITE_URL?>/asincroni/toggle_autista_servizio/"+checkid+"/<?=$idautisti?>";   
        
         $.get(URL,function(data){
                //alert(data);
                if(data==='OK'){                       
                   
                }
            });
    });
});    
</script>    
