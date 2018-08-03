<?php
$string= file_get_contents("dictionnaire.txt",FILE_USE_INCLUDE_PATH);
$dico= explode("\n",$string);
echo "Le nombre de mots du dico est : ".sizeof($dico)."<br>";
$i=0;
$p=0;
$q=0;
foreach($dico as $v){if(strlen($v)==15){$i+=1;}if(stristr($v,'w')){$p+=1;}if(substr($v,-1,1)=="q"){$q+=1;};}
echo "Mots faisant 15 charactères : ".$i."<br>";
echo "Mots contenant la lettre W : ".$p."<br>";
echo "Mots contenant la lettre Q : ".$q."<br>";
$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$top = $brut["feed"]["entry"];
echo "Top 10 des films :<br>";
$price=[];
$rent=[];
for($i=0;$i<10;$i++){
	foreach($top[$i]["im:name"] as $v){
		echo ($i+1).". ".$v."<br>";
	}
	array_push($price,substr($top[$i]["im:price"]["label"],1));
	array_push($rent,substr($top[$i]["im:rentalPrice"]["label"],1));
}
$m=0;
$dif=0;
$vieux=2400;
$f=[];
$rea=[];
$month=[];
$mini=[];
$blbl=[];
for($p=0;$p<100;$p++){
	foreach($top[$p]["im:name"] as $v){
		if($v=="Gravity"){
			echo '<br>Le film Gravity est : '.$p."ème<br>";
		}if($v=="The LEGO Movie"){
			echo "Le réalisateur du film The Lego Movie est :".$top[$p]["im:artist"]["label"];
		}
	}
	foreach($top[$p]["im:releaseDate"] as $v){
		$l=substr($v,0,4);
		$l2= +$l;
		if($l<2000 && $l2!=0){
			$m+=1;
		}if($dif<$l2&&$l2!=0){
			$dif=$l2;
		}if($vieux>$l2&&$l2!=0){
			$vieux=$l2;
		}
	}
	array_push($f,$top[$p]["category"]["attributes"]["term"]);
	array_push($rea,$top[$p]["im:artist"]['label']);
	array_push($month,explode(" ",$top[$p]["im:releaseDate"]["attributes"]["label"])[0]);
	if(strlen($top[$p]["im:rentalPrice"]["label"])!=false){
		array_push($mini,$mini[$top[$p]["im:name"]["label"]]=+substr($top[$p]["im:rentalPrice"]["label"],1));}
	}
	echo "Le nombre de films sortis avant 2000 est : ".$m." <br>";
	echo "Le film le plus récent est : ".$dif."<br>";
	echo "Le film le plus ancient est : ".$vieux."<br>";
	echo "Le genre le plus récurrent du tableau est : ".$f[max(array_count_values($f))]."<br>";
	echo "Le réalisateur qui revient le plus dans le top 100 est : ".$rea[max(array_count_values($rea))]."<br>";
	echo "Acheter le top 10 des films coûterait : ".array_sum($price)."$<br>";
	echo "Louer le top 10 des films coûterait : ".array_sum($rent)."$<br>";
	echo "Le mois ayant vu le plus de sorties au cinéma est : ".$month[max(array_count_values($month))]."<br>";
	for($i=0;$i<20;$i++){
		$test=array_search(min($mini),$mini);
		array_push($blbl, $test);
		unset($mini[$test]);
	}
	echo "<br> Les 10 films à voir avec un budget limité sont : <br>";
	for($i=0;$i<20;$i++){
		try{
			if($i%2==0){
				echo " ".$blbl[$i]."<br> ";
				if($i%2!=0){
					throw new Exception("Numero buggé");
				}
			}
		}catch(Exception $e){
			echo "Ceci est un ".$e->getMessage(),"\n";
		}
	}
	echo "<br><br>";
	?>
