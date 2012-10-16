<?php
require_once 'calculaCamino.php';
//$camino= calculaCamino::getCalculoCamino("2","53");
$cont=0;
for ($i=1;$i<=84;$i++)
{
	if ($i==76) $i=80;
	$camino= calculaCamino::getCalculoCamino("39",$i);
	
	echo "<br>###################################<br>";
	foreach ($camino as $mostra)
	{
			
		echo $mostra."-> camino <br>";
		
			
		//$i++;
	}
	echo "################################### <br>";
	$cont++;
}
echo "<br>$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$<br>";
echo "cantidad de caminos realizados: ".$cont;
echo "<br>$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$<br>";
var_dump($camino);




?>