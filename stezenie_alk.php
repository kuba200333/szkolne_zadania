<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="stezenie_alk.css" type="text/css" />
</head>
<body>

    <header>
     <h2>Szacowana zawartość alkoholu we krwi </h2></br>
    </header>

    <div id="lewy">
    <form action="" method="get">
Rodzaj alkoholu:
<select name="napoj">
    <option></option>       
    <option>Piwo 5%</option>
    <option>Wino 12%</option>
    <option>Wódka 40%</option>
    </select> <br>

Zawartość napoju (ml): <input name="ilosc" type="text" /> <br>
Płeć: <select name="plec">
    <option></option>       
    <option>Kobieta</option>
    <option>Mężczyzna</option>
    </select> <br>

Waga: <input name="waga" type="text" /> 
<input value="Wyślij" type="submit" />
</div>

<div id="prawy">

    <?php
    if(isset($_GET["napoj"])){
    #Ilość wypitego czystego alkoholu w gramach
    $napoj="$_GET[napoj]";
    $ilosc="$_GET[ilosc]";
    $zaw_alk_w_100ml_piwa=4;
    $zaw_alk_w_100ml_wina=10;
    $zaw_alk_w_100ml_wodki=33.3;

    if ($napoj=="Piwo 5%"){
        $A=$zaw_alk_w_100ml_piwa*$ilosc/100;
    }

    if ($napoj=="Wino 12%"){
        $A=$zaw_alk_w_100ml_wina*$ilosc/100;
    }

    if ($napoj=="Wódka 40%"){
        $A=$zaw_alk_w_100ml_wodki*$ilosc/100;
    }

    #Współczynnik wynoszący (w przybliżeniu) 0,7 dla mężczyzn i 0,6 dla kobiet
    $plec="$_GET[plec]";

    if ($plec=="Mężczyzna") { 
    $K=0.7;
    }
    if ($plec=="Kobieta") { 
    $K=0.6;
    }   

    #Masa ciała w kg

    $W="$_GET[waga]";
   

    #Obliczenia
    $zawartosc_alkoholu=($A)/($K*$W);
    print "<h2>Szacowana zawartość alkoholu we krwi wynosi:</h2>";
    echo round($zawartosc_alkoholu,2)."‰";
    }

?>
</div>
</form>
<footer>
    Stronę wykonał: Jakub Wierciński
</footer>

</body>
</html>
