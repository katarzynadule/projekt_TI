<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylePsy.css">
    <title>Usuń konto</title>
</head>
<body>

   <nav class="navbar navbar-expand-sm bg-light justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
                <form action="stronaGlowna.php" method="post">
                    <input type="submit" value="Strona Główna">
                </form>
          </li>
            <li class="nav-item">
                <form action="psy.html" method="post">
                    <input type="submit" value="Szczeniaki">
                </form>
          </li>
          <li class="nav-item">
                <form action="psy.html" method="post">
                    <input type="submit" value="Psy">
                </form>
          </li>
          <li class="nav-item">
                <form action="Kontakt.php" method="post">
                    <input type="submit" value="Kontakt">
                </form>
          </li>
		  <li class="nav-item">
                <form action="Edytujprofil.php" method="post">
                    <input type="submit" value="Konto">
                </form>
          </li>
        </ul>
      </nav>


	<?php

	session_start();
	//Jeżeli użytkownik zalogownay
	if (isset ($_SESSION['nazwa_uzytkownika']))
	{
		
		$nazwaserwera = "localhost";
		$uzytkownik = "root";
		$haslo = "";
		$nazwabd = "uzytkownicy";

		$polaczenie = new mysqli($nazwaserwera, $uzytkownik, $haslo, $nazwabd);

		$usun_sql = "DELETE FROM uzytkownicy WHERE nazwa_uzyt='$_SESSION[nazwa_uzytkownika]' LIMIT 1";
		$wynik = $polaczenie -> query($usun_sql);
		if($wynik==false)
		{
			echo 'bledne polecenie sql: ' . $usun_sql;
			$polaczenie->close();
			exit;
		}
		session_destroy();
		echo "Konto zostało usunięte.";
		echo "<br>";
		echo "<form action='stronaglowna.php'>
				<input type='submit' value='Wróć do strony głównej'/>
		</form>";


	}
	else
	{
		echo "Użytkownik niezalogowany.";
	}
	?>
	
</body>

</html>