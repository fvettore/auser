<?php
$db = new mysqli('localhost', 'auser', 'cippalippa', 'auser');
if($db->connect_errno){
    die("Servizio temporaneamente in manutenzione" );    
}
$db->set_charset('utf8');