<a href=<?=SITE_URL?>>&lt;-HOME</a>
<br>
<br>
<h4>Gestione tipologie di servizi</h4>
<table class="table table-striped">
 <thead>
      <tr>
        <th>codice</th>
        <th>descrizione</th>
        <th>colore</th>
       </tr>
  </thead>

<?php
$query="select * from servizi where disabilitato <>1 order by codice";

$res=$db->query($query);
while ($l=$res->fetch_array()){
    
    $idservizi=$l['idservizi'];
    $codice=$l['codice'];
    $descrizione=$l['descrizione'];
    $colore=$l['colore'];
    echo "<tr id=\"tr$idservizi\">\n";    
    //echo "    <td>$codice</td>\n";
    echo "    <td><input class=\"form-control\" id=\"codice_$idservizi\" value=\"$codice\"></input></td>\n";
    //echo "    <td>$descrizione</td>\n";
    echo "    <td><input class=\"form-control\" id=\"descrizione_$idservizi\" value=\"$descrizione\"></input></td>\n";
    //echo "    <td>$targa</td>\n";
    echo "    <td><input class=\"form-control\" id=\"colore_$idservizi\" value=\"$colore\"></input></td>\n";
    echo "<td id=\"col_$idservizi\" style=\"background-color: #$colore\">&nbsp</td>\n";
    echo "    <td><button id=\"DEL$idservizi\" type=\"button\" class=\"btn btn-danger\"><b>🗑</b></button></td>\n";
    echo "</tr>";
    
}
?>
  <tr>
      <td> <input placeholder="Codice servizio" class="form-control" id="insertCodice"></td>
      <td> <input placeholder="Descrizione" class="form-control" id="insertDescrizione"></td>
      <td> <input placeholder="Colore" class="form-control" id="insertColore"></td>
      <td><button type="button" class="btn btn-success"><b>✓</b></button></td>
  </tr>  
</table>
<script>
$( document ).ready(function() {
    
     $("button.btn-danger").click(function(){
        var btn = $(this).attr("id").substr(3);
        var URL=encodeURI("./asincroni/modifica/servizi/idservizi/"+btn+"/disabilitato/1");
        if (confirm("ATTENZIONE: tutti gli impegni  di servizo che fanno riferimento a questa tipologia verranno eliminati!\nVuoi veramente eliminare il mezzo?")){     
            $.get(URL,function(data){
                //alert(data);
                if(data==='1'){                       
                    $('#tr'+btn).hide();
                }
            });
        }
        
    });
    
     $("button.btn-success").click(function(){
        codice=$('#insertCodice').val();
        descrizione=$('#insertDescrizione').val();
        colore=$('#insertColore').val();
        var URL=encodeURI("./asincroni/inserisci_servizio/"+codice+"/"+descrizione+"/"+colore);
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
            //alert($(this).attr("id"));
            var btn=$(this).attr("id");

            var splitvalues=btn.split("_");
            var valore=$(this).val();
            var campo=splitvalues[0];
            var id=splitvalues[1];
            var URL=encodeURI("./asincroni/modifica/servizi/idservizi/"+id+"/"+campo+"/"+valore);
            $.get(URL,function(data){    
                if(valore!==data){
                    alert("Problemi di caricamento. Verifica valore inserito!!");
                }
                else{
                    if(campo=='colore'){
                        $("#col_"+id).css("background-color","#"+valore);
                    }
                }

            });
        }
    });
    
});
</script>