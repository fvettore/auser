<?php
///////////////////////////////////////////////////////////////////////////////
//passato parametro id autista per associazione servizi
if($pagina->parametri[0]){
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
     <tr">
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
<?php    
}

///////////////////////////////////////////////////////////////////////////////
//NORMALE GESTIONE ANAGRAFICO -  NO DETTAGLIO
else{
    
?>
<a href="<?=SITE_URL?>">&lt;-HOME</a>
<br>
<br>
<h4>Gestione Autisti</h4>
<table class="table table-striped">
 <thead>
      <tr>
        <th>cognome</th>
        <th>nome</th>
        <th></th>
       </tr>
  </thead>

<?php
$query="select * from autisti where disabilitato <>1 order by cognome";

$res=$db->query($query);
while ($l=$res->fetch_array()){
    
    $idautisti=$l['idautisti'];
    $cognome=$l['cognome'];
    $nome=$l['nome'];
    echo "<tr id=\"tr$idautisti\">\n";    
    //echo "    <td>$codice</td>\n";
    echo "    <td><input class=\"form-control\" id=\"cognome_$idautisti\" value=\"$cognome\"></input></td>\n";
    echo "    <td><input class=\"form-control\" id=\"nome_$idautisti\" value=\"$nome\"></input></td>\n";
    echo "    <td><button id=\"EDIT$idautisti\" type=\"button\" class=\"btn btn-warning\"><b>🖊️</b></button></td>\n";
    echo "    <td><button id=\"DEL$idautisti\" type=\"button\" class=\"btn btn-danger\"><b>🗑</b></button></td>\n";
    echo "</tr>";
    
}
?>
  <tr>
      <td> <input placeholder="Cognome" class="form-control" id="insertCognome"></td>
      <td> <input placeholder="Nome" class="form-control" id="insertNome"></td>
      <td><button type="button" class="btn btn-success"><b>✓</b></button></td>
  </tr>  
</table>
<script>
$( document ).ready(function() {
    
     $("button.btn-danger").click(function(){
        var btn = $(this).attr("id").substr(3);
        var URL=encodeURI("./asincroni/modifica/autisti/idautisti/"+btn+"/disabilitato/1");
        if (confirm("ATTENZIONE: tutti i servizi che fanno riferimento a questo autista verranno eliminati!\nVuoi veramente eliminare il mezzo?")){     
            $.get(URL,function(data){
                //alert(data);
                if(data==='1'){                       
                    $('#tr'+btn).hide();
                }
            });
        }        
    });
    
    $("button.btn-warning").click(function(){
        var btn = $(this).attr("id").substr(4);
        var URL="./autisti/"+btn;
        location.assign(URL);
    });
    
     $("button.btn-success").click(function(){
        cognome=$('#insertCognome').val();
        nome=$('#insertNome').val();
        var URL=encodeURI("./asincroni/inserisci_autista/"+cognome+"/"+nome);
        $.get(URL,function(data){
            //alert(data);
            if(data==='OK'){                       
              location.reload();
            }
            else alert("problema di caricamento")
        });
    });
    
    $("input.form-control").change(function(){
        if($(this).attr("id").indexOf("_")>0){
            var btn=$(this).attr("id");
            var splitvalues=btn.split("_");
            var valore=$(this).val();
            var campo=splitvalues[0];
            var id=splitvalues[1];
            var URL=encodeURI("./asincroni/modifica/autisti/idautisti/"+id+"/"+campo+"/"+valore);
            $.get(URL,function(data){    
                if(valore!==data){
                    alert("Problemi di caricamento. Verifica valore inserito!!");
                }
            });
        }
    });
    
});
</script>
<?php
}