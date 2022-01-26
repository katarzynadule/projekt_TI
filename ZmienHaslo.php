<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylePsy.css">
    <title>Zmień hasło</title>
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
		
		if (isset($_POST['saveNewPassword']))
		{
		
		//Pobieranie danych zalogowanego użytkownika
		$haslo_sql = "SELECT haslo FROM uzytkownicy WHERE nazwa_uzyt='$_SESSION[nazwa_uzytkownika]' LIMIT 1";
		$wynik = $polaczenie -> query($haslo_sql);
			if($wynik==false)
			{
				echo 'bledne polecenie sql: ' . $haslo_sql;
				$polaczenie->close();
				exit;
			}
		$uzyt = $wynik->fetch_assoc();
		
		//Przypisanie danych z bazy danych do zmiennej i input
		$haslo_zmienna = $uzyt['haslo'];
		
			if($haslo_zmienna==$_POST['stare_haslo'])
			{
				if($_POST['nowe_haslo']==$_POST['nowe_haslo_ponownie'] && $_POST['nowe_haslo']!="")
				{
					$ustaw_nowe_haslo_sql = "UPDATE uzytkownicy SET haslo ='" .$_POST['nowe_haslo'] ."' WHERE nazwa_uzyt='" . $_SESSION['nazwa_uzytkownika']."'";
					$wynik = $polaczenie -> query($ustaw_nowe_haslo_sql);
					if($wynik==false)
					{
						echo 'bledne polecenie sql: ' . $ustaw_nowe_haslo_sql;
						$polaczenie->close();
						exit;
					}	
					echo "Zmieniono hasło.";
				}
				else
				{
					echo "Pola z nowym hasłem różnią się od siebie lub są puste.";
				}
			
			}
			else
			{
				echo "Wprowadzone obecne hasło jest nieprawidłowe.";
			}
		}
		
		echo"<form method='post' action='ZmienHaslo.php'>
			<legend>Zmień hasło: </legend>
			<fieldset>
				Wprowadź obecne hasło:
				<br>
				<input type='password' name='stare_haslo'>
				<br>
				Wprowadź nowe hasło:
				<br>
				<input type='password' name='nowe_haslo'>
				<br>
				Powtórz nowe hasło:
				<br>
				<input type='password' name='nowe_haslo_ponownie'>
				<br>

				<input type='submit' name='saveNewPassword' value='Zapisz zmiany'>
			</fieldset>
		</form>";
		echo"<form method='post' action='edytujprofil.php'>
			<input type='submit' value='Wróć'>
			</form>";
		
	}
	else
	{
		echo "Użytkownik niezalogowany.";
	}
		
	?>
	
</body>

</html>