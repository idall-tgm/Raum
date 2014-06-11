<?php
require_once '/var/www/vendor/propel/propel1/runtime/lib/Propel.php';

Propel::init("/var/www/Raum/build/conf/-conf.php");

set_include_path("/var/www/Raum/build/classes" .PATH_SEPARATOR . get_include_path());

$benutzer = new Benutzer();
$benutzer->setBname('admin3');
$benutzer->setPasswort('geheim');
$benutzer->setIstadmin(true);
$benutzer->save();


$benutzer1 = new Benutzer();
$benutzer1->setBname('tgm3');
$benutzer1->setPasswort('unbekannt');
$benutzer1->setIstadmin(FALSE);
$benutzer1->save();


$benutzer2= new Benutzer();
$benutzer2->setBname('aaaa');
$benutzer2->setPasswort('blabla');
$benutzer2->setIstadmin(FALSE);
$benutzer2->save();


$jahrgang=new Jahrgang();
$jahrgang->setJbez('4AHITA');
$raum= new Raum();
$raum->setRnr('H1127A');
$raum->setHatBeamer(TRUE);
$raum->setJahrgang($jahrgang);
$raum->save();


$jahrgang1=new Jahrgang();
$jahrgang1->setJbez('4YHITA');
$raum1=new Raum();
$raum1->setRnr('H928A');
$raum1->setHatBeamer(TRUE);
$raum1->setJahrgang($jahrgang1);
$raum1->save();


$jahrgang2=new Jahrgang();
$jahrgang2->setJbez('4CHITMA');
$raum2=new Raum();
$raum2->setRnr('H129BA');
$raum2->setHatBeamer(FALSE);
$raum2->setJahrgang($jahrgang2);
$raum2->save();

echo"Daten in die Datenbank gespeichert";
echo"<hr>";

echo"<h2>Erste Abfrage:</h2>";
$raum = RaumQuery::create()->orderByRnr()->find();
foreach($raum as $r){
	echo"<br>";
	echo "Raumnummer:".$r -> getRnr();
	echo"<br>";
	echo "Jahrgangsbezeichnung:".$r -> getJbez();
	echo "<br>";
	
	if($r-> getHatBeamer()==1){
	echo"Hat Beamer:JA";
	}else{
	echo"Hat Beamer:NEIN";
	}
	
	echo "<br>";
	echo "<hr>";
}

echo"<h2>Zweite Abfrage:</h2>";
$benutzer = BenutzerQuery::create()->filterByIstadmin(true)->orderByBname()->find();
foreach($benutzer as $b){
        echo"<br>";
        echo "Name:".$b -> getBname();
        echo "<br>";
	echo "Admin:".$b -> getIstadmin();
	echo "<br>";
        echo "<hr>";
}

echo"<h2>Dritte Abfrage:</h2>";
$raum = RaumQuery::create()->filterByHatbeamer(true)->limit(1)->find();
foreach($raum as $r){
        echo"<br>";
        echo "Beamer:".$r -> getHatbeamer();
        echo "<br>";
        echo "Raum-Nummer:".$r -> getJbez();
        echo "<br>";
        echo "<hr>";
}

?>
