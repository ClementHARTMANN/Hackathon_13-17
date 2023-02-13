<?php
$options = array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  
$json = file_get_contents("https://ciqual.anses.fr/",false,stream_context_create($options));

$tabDepartements = json_decode($json);

// echo '<table class="table table-striped">';
// for ($i=0; $i < count($tabDepartements); $i++) 
// { 
//     echo "<tr onclick=GetIdDepartement(".$tabDepartements[$i]->id.")>";
//     echo "<td>".$tabDepartements[$i]->id."</td>";
//     echo "<td>".$tabDepartements[$i]->libelle."</td>";
//     echo "</tr>";
// }
// echo "</table>";

?>