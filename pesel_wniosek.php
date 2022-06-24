<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PESEL</title>
    <link rel="stylesheet" href="pesel_wniosek.css" type="text/css" />
</head>
<body>
    <header>
    <a href="pesel.php">Strona głowna</a>
    <h2>Wniosek o wydanie dowodu osobistego</h2>
    <hr>
    </header>  
    <div id="lewy">
        <form action="" method="post" enctype="multipart/form-data">
        <h4>1. Dane osoby, która ma otrzymać dowód</h4>
        Wprowadź PESEL* : <input name="pesel" type="text" required> <br>
        Wprowadź Imię* : <input name="imie" type="text" required> <br>
        Wprowadź Nazwisko* : <input name="nazwisko" type="text" required> <br>
        Wprowadź miejsce urodzenia* : <input name="miejsce_urodzenia" type="text" required> <br>
        Obywatelstwo Polskie* <input type="checkbox" name="obywatelstwo" required/> <br>
        (<b><i>Uwaga! Płeć i data urodzenia wypełniana jest automatycznie!</i></b>)
        <hr>

        <h4>2. Dane kontaktowe wnioskodawcy</h4>
        Ulica* : <input name="ulica" type="text" required> <br>
        Numer domu* : <input name="nr_dom" type="text" required> <br>
        Kod pocztowy* : <input name="kod_pocztowy" type="text" required> <br>
        Poczta* : <input name="poczta" type="text" required> <br>
        Numer telefonu* : <input name="telefon" type="text" required> <br>
        <hr>

        <h4>3. Powód ubiegania się o wydanie dowodu* </h4>
        <select name="powod" required>
        <option></option>  
        <option>pierwszy dowód</option>
        <option>zmiana danych zawartych w dowodzie</option>
        <option>upływ terminu ważności dowodu</option>
        <option>upływ terminu zawieszenia dowodu</option>
        <option>utrata dowodu</option>
        <option>zmiana wizerunku twarzy</option>
        <option>uszkodzenie dowodu</option>
        <option>wymiana dowodu bez warstwy elektronicznej</option>
        <option>brak możliwości identyfikacji i uwierzytelnienia lub złożenia podpisu osobistego</option>
        <option>brak certyfikatu identyfikacji i uwierzytelnienia lub certyfikatu podpisu osobistego</option>
        <option>kradzież tożsamości</option>
        <option>wymiana dowodu bez odcisków palców</option>
        <option>reklamacja</option>
        <option>inny</option>
        </select> <br>
        <hr>

        <h4>4. Fotografia osoby, która ma otrzymać dowód* </h4>
        <input type="file" name="zdjecie" required> <br>
        <hr>

        <h4>5. Certyfikat podpisu osobistego</h4>
        <input type="checkbox" name="podpis"> Zaznacz, jeśli chcesz mieć certyfikat podpisu osobistego. <br>
        <hr>
        <h4> 6. Oświadczenie, podpis </h4>
        <b> <i>Jestem świadomy/świadoma odpowiedzialności karnej za złożenie fałszywego
            oświadczenia. <br>Potwierdzam, że dane wymienione w pkt 1 i 3 są prawdziwe. </i> </b>
        <br> Potwierdzam* <input type="checkbox" name="zgoda" required> <br>
        <input value="Wyślij" type="submit" name="submit">
        <input type="reset" value="Reset"> <br>
        <br> * Pole wymagane
        </form>
        </div>
        <div id="prawy">
 
        <hr>

        <?php
        if(isset($_POST["submit"])){
        print ("<h4>Podsumowanie wprowadzonych danych: </h4>");
        
        $pesel="$_POST[pesel]";
        $plec= $pesel[9]; #wyszukuje numer płci
        $dzien = $pesel[4].$pesel[5]; #wypisuje dzień
        $miesiac=0; #oblicza miesiąc
        $pesel_stulecie=$pesel[2]; #wyszukuje numer stulecia
        $rok_ost=$pesel[0].$pesel[1]; #pokazuje dwie ostatnie cyfry roku urodzenia
        $zakodowane_stulecie=$pesel[2].$pesel[3]; #pokazuje zakodowane stulecie
        $imie="$_POST[imie]";
        $nazwisko="$_POST[nazwisko]";
        $miejsce_urodzenia="$_POST[miejsce_urodzenia]";
        $powod="$_POST[powod]";
        $ulica="$_POST[ulica]";
        $nr_dom="$_POST[nr_dom]";
        $kod_pocztowy="$_POST[kod_pocztowy]"." "."$_POST[poczta]";
        $telefon="$_POST[telefon]";
        $podpis="$_POST[podpis]";
        move_uploaded_file($_FILES['zdjecie']['tmp_name'], $_FILES['zdjecie']['name']);
        
        if ($podpis="on"){
            $podpis="tak";
        }
        else{
            $podpis="nie";
        }

  
        print("<b>Imie: </b>".$imie."<br>");
        print("<b>Nazwisko: </b>".$nazwisko."<br>");
        print("<b>Urodzony: </b>".$miejsce_urodzenia."<br>");
        print("<b>Adres zamieszkania: </b>".$ulica." ".$nr_dom.", ".$kod_pocztowy."<br>");    
        print("<b>Powód wydania dowodu: </b>".$powod."<br>"); 
        print("<b>Telefon: </b>".$telefon."<br>");      
        print("<b>Podpis cyfrowy: </b>".$podpis."<br>");       
        print("<hr>");  
        print("<br> <b>Twój PESEL: </b>".$pesel."<br>");  
        


        #sprawdza płeć
        echo "<b>Płeć: </b>";
        if ($plec%2==0){

        echo "Kobieta <br>";
        }
        else{
            echo "Mężczyzna <br>";  
        };


        #sprawdza stulecie z listy

        $kody=["01"=> "Styczeń","21"=> "Styczeń","02"=>"Luty","22"=>"Luty", "03"=>"Marzec", "23"=>"Marzec", 
            "04"=>"Kwiecień", "24"=>"Kwiecień", "05"=>"Maj", "05"=>"Maj", "06"=>"Czerwiec", "26"=>"Czerwiec",
            "07"=>"Lipiec", "27"=>"Lipiec", "08"=>"Sierpień", "28"=>"Sierpień", "09"=>"Wrzesień", "29"=>"Wrzesień",
            "10"=>"Pażdziernik", "30"=>"Pażdziernik", "11"=>"Listopad", "31"=>"Listopad", "12"=>"Grudzień", "32"=>"Grudzień"];

        print_r("<b> Dzień i miesiąc urodzenia: </b>".$dzien." ".$kody["$zakodowane_stulecie"]);

        #oblicza stulecie

        if ($pesel_stulecie==0){
            echo "<br> <b>Rok urodzenia: </b>"."19".$rok_ost;
        }
        elseif ($pesel_stulecie==1){
            echo "<br> <b>Rok urodzenia: </b>"."19".$rok_ost;
        }
        elseif ($pesel_stulecie==2){
            echo "<br> <b>Rok urodzenia: </b>"."20".$rok_ost;
        }
        elseif ($pesel_stulecie==3){
            echo "<br> <b>Rok urodzenia: </b>"."20 <br>".$rok_ost;
        }
        else{
            echo "";
        }
        print ("<br>"."<hr>"."<b>Twoje zdjęcie:</b><br>".'<img src="'.$_FILES['zdjecie']['name'].'" width="230" height="230" alt="Tu będzie twoje zdjęcie"/>');
        }
        
        
        ?>

    </div>
    <footer>

    </footer>
</body>
</html>