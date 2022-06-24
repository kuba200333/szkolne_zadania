<?php
/*
Zmienne liczba(x) są przypisywane do listy $liczby_wytypowane. System losuje liczby do listy $lotto.
Potem listy są sortowane i porównywane ze sobą.
*/
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lotek</title>
    <link rel="stylesheet" href="totolotek.css" type="text/css" />
<body>
    <header>
        Generator szczęśliwych liczb
    </header>
    <div id="lewy">
    <br>
    <b>Wprowadź 6 niepowtarzalnych liczb z przedziału 1-49.</b><br>

    <form action="" method="get">
        Wprowadź liczbę 1: <input name="liczba1" type="text" /> 
        Wprowadź liczbę 2: <input name="liczba2" type="text" /> 
        Wprowadź liczbę 3: <input name="liczba3" type="text" /> 
        Wprowadź liczbę 4: <input name="liczba4" type="text" /> 
        Wprowadź liczbę 5: <input name="liczba5" type="text" /> 
        Wprowadź liczbę 6: <input name="liczba6" type="text" /> <br><br>
        <hr>
        <h3>Czy jesteś pełnoletni? <h3><br>
        Tak<input type="checkbox" name="tak"/>
        Nie<input type="checkbox" name="nie"/> <br>
        <input value="Wyślij" type="submit" /> <br>
    </div>
    <div id="prawy">
        <?php
       if(isset($_GET["tak"])){

        $liczba1="$_GET[liczba1]";
        $liczba2="$_GET[liczba2]";
        $liczba3="$_GET[liczba3]";
        $liczba4="$_GET[liczba4]";
        $liczba5="$_GET[liczba5]";
        $liczba6="$_GET[liczba6]";

 
        $ile_wylosowano = 0;
        $lotto = [];
        $liczby_wytypowane=[$liczba1,$liczba2,$liczba3,$liczba4,$liczba5,$liczba6];

        for ($i=1; $i<=6; $i++)
        {
        do
        {
            $r = rand(1, 49);
            $nastepna = true;
            for ($j=1; $j<=$ile_wylosowano; $j++)
            {
            if ($r == $lotto[$j]) $nastepna = false;
            }
            if ($nastepna == true)
            {
            $ile_wylosowano++;
            $lotto[$ile_wylosowano] = $r;
            }
        }
        while($nastepna!=true);
        }
        print('<h5> Wylosowane liczby to: </h5><br>');
        for ($i=1; $i<=6; $i++) echo $lotto[$i].", ";

        print("<hr>");

        sort($lotto);
        sort($liczby_wytypowane);

        print('<h5> Twoje liczby to: </h5><br>');
        print($liczba1.", ".$liczba2.", ".$liczba3.", ".$liczba4.", ".$liczba5.", ".$liczba6."<br><br>");

        print("<hr>");
        
        print("<b>Rezultat:</b><br><br>");
        if($lotto==$liczby_wytypowane){
            print("Wygrałeś!. Jesteś milionerem");
        }
        else {
            print("Przegrałeś");
        }
        ?>
        <?php
        if(isset($_GET["nie"])){
            echo "</br><b>Nie możesz wziąć udziału! </b><br> Musisz osiągnąć <b>18 lat</b>! <br> 
            Ewentualnie możesz też przyjść z mamą lub babcią :)";
        }
    }
        ?>
        </form>
    </div>
    <footer>
        <b>Stronę wykonał: Jakub Wierciński</b>
    </footer>
</body>
</html>