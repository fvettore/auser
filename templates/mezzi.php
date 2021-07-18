<a href="<?=SITE_URL?>">&lt;-HOME</a>
<br>
<br>
<h4>Gestione Mezzi</h4>

<table class="table table-striped">
 <thead>
      <tr>
        <th>codice</th>
        <th>descrizione</th>
        <th>targa</th>
       </tr>
  </thead>

<?php
$query="select * from mezzi where disabilitato<>1 order by codice";

$res=$db->query($query);
while ($l=$res->fetch_array()){
    
    $idmezzi=$l['idmezzi'];
    $codice=$l['codice'];
    $descrizione=$l['descrizione'];
    $targa=$l['targa'];
    echo "<tr id=\"tr$idmezzi\">\n";    
    //echo "    <td>$codice</td>\n";
    echo "    <td><input class=\"form-control\" id=\"codice_$idmezzi\" value=\"$codice\"></input></td>\n";
    //echo "    <td>$descrizione</td>\n";
    echo "    <td><input class=\"form-control\" id=\"descrizione_$idmezzi\" value=\"$descrizione\"></input></td>\n";
    //echo "    <td>$targa</td>\n";
    echo "    <td><input class=\"form-control\" id=\"targa_$idmezzi\" value=\"$targa\"></input></td>\n";
    echo "    <td><button id=\"DEL$idmezzi\" type=\"button\" class=\"btn btn-danger\"><b>🗑</b></button></td>\n";
    echo "</tr>";
    
}
?>
  <tr>
      <td> <input placeholder="Codice mezzo" class="form-control" id="insertCodice"></td>
      <td> <input placeholder="Descrizione" class="form-control" id="insertDescrizione"></td>
      <td> <input placeholder="Targa" class="form-control" id="insertTarga"></td>
      <td><button type="button" class="btn btn-success"><b>✓</b></button></td>
  </tr>  
</table>
<script>
$( document ).ready(function() {
    
     $("button.btn-danger").click(function(){
        var btn = $(this).attr("id").substr(3);
        //var URL="./asincroni/elimina_mezzo/"+btn;
        var URL=encodeURI("./asincroni/modifica/mezzi/idmezzi/"+btn+"/disabilitato/1");
        if (confirm("ATTENZIONE: tutti i servizi che fanno riferimento a questo mezzo verranno eliminati!\nVuoi veramente eliminare il mezzo?")){     
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
        targa=$('#insertTarga').val();
        var URL=encodeURI("./asincroni/inserisci_mezzo/"+codice+"/"+descrizione+"/"+targa);
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
            var URL=encodeURI("./asincroni/modifica/mezzi/idmezzi/"+id+"/"+campo+"/"+valore);
            $.get(URL,function(data){    
                if(valore!==data){
                    alert("Problemi di caricamento. Verifica valore inserito!!");
                }
            });
        }
    });
    
    
});
</script>