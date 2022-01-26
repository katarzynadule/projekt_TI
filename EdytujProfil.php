<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylePsy.css">
    <title>Konto</title>
</head>

<body>

<nav class="navbar navbar-expand-sm bg-light justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="stronaGlowna.php">Strona Główna</a>
          </li>
            <li class="nav-item">
            <a class="nav-link" href="szczeniaki.php">Szczeniaki</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="psy.php">Psy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Kontakt.php">Kontakt</a>
            <li class="nav-item">
            <a class="nav-link" href="Logowanie.php">Konto</a>
          </li>
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
		
		if (isset($_POST['save']))
		{
		
		$sql_update = "UPDATE uzytkownicy SET imie ='" .$_POST['imie_form']. "', nazwisko='". $_POST['nazwisko_form']. "', email='". $_POST['email_form']. "', miasto='". $_POST['miasto_form']. "', telefon='". $_POST['telefon_form']
		."' WHERE nazwa_uzyt='" . $_SESSION['nazwa_uzytkownika']."'";
		
			if ($polaczenie->query($sql_update) === TRUE) 
			{
			  echo "Zedytywano dane";
			  echo '</br>';
			  echo '</br>';
			} 
			else 
			{
			  echo "Error: " . $sql_update . "<br>" . $polaczenie->error;
			}
		}

		//Pobieranie danych zalogowanego użytkownika
		$uzytkownik_sql = "SELECT * FROM uzytkownicy WHERE nazwa_uzyt='$_SESSION[nazwa_uzytkownika]' LIMIT 1";
		$wynik = $polaczenie -> query($uzytkownik_sql);
		if($wynik==false)
		{
			echo 'bledne polecenie sql: ' . $uzytkownik_sql;
			$polaczenie->close();
			exit;
		}
		$uzyt = $wynik->fetch_assoc();
		
		//Przypisanie danych z bazy danych do fieldset
		$imie_zmienna = $uzyt['imie'];
		$nazwisko_zmienna = $uzyt['nazwisko'];
		$email_zmienna = $uzyt['email'];
		$miasto_zmienna = $uzyt['miasto'];
		$telefon_zmienna = $uzyt['telefon'];
		
		echo"<form method='post' action='EdytujProfil.php'>
				<legend>Edytuj dane: </legend>
				<fieldset>
					Twoje imię:
					<br>
					<input type='text' name='imie_form' value= '$imie_zmienna'>
					<br>
					Twoje nazwisko:
					<br>
					<input type='text' name='nazwisko_form' value= '$nazwisko_zmienna'>
					<br>
					Twój adres email:
					<br>
					<input type='text' name='email_form' value= '$email_zmienna'>
					<br>
					Twoje miasto:
					<br>
					<input type='text' name='miasto_form' value= '$miasto_zmienna'>
					<br>
					Twój numer telefonu:
					<br>
					<input type='text' name='telefon_form' value= '$telefon_zmienna'>
					<br>

					<input type='submit' name='save' value='Zapisz zmiany'>
				</fieldset>
		</form>";
		echo "<br>";
		echo "<br>";
		echo"<form method='post' action='ZmienHaslo.php'>
				<fieldset>
					<input type='submit' name='editPassword' value='Zmień hasło'>
				</fieldset>
		</form>";
		echo "<br>";
		echo "<br>";
		echo"<form method='post' action='Wylogowanie.php'>
				<fieldset>
					<input type='submit' name='logout' value='Wyloguj się'>
				</fieldset>
		</form>";
		echo "<br>";
		echo "<br>";
		echo"<form method='post' action='UsunKonto.php'>
				<fieldset>
					<input type='submit' name='deleteAcc' value='Usuń konto'>
				</fieldset>
		</form>";
		
	}
	else
	{
		echo "Użytkownik niezalogowany.";
		echo"<form method='post' action='Logowanie.php'>
				<input type='submit' value='Zaloguj się'>
			</form>";
	}

	?>
	
</body>

</html>