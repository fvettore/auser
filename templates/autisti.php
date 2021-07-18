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
        var URL="./autisti_servizi/"+btn;
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