<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylePsy.css">
    <title>Formularz kontaktowy</title>
</head>
<body>

	<?php
	$imie_zmienna = "";
	$nazwisko_zmienna = "";
	$email_zmienna = "";
	$miasto_zmienna = "";
	$telefon_zmienna = "";

	session_start();
	//Jeżeli użytkownik zalogownay
	if (isset ($_SESSION['nazwa_uzytkownika']))
	{
		$nazwaserwera = "localhost";
		$uzytkownik = "root";
		$haslo = "";
		$nazwabd = "uzytkownicy";

		$polaczenie = new mysqli($nazwaserwera, $uzytkownik, $haslo, $nazwabd);
		
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
		
		//Przypisanie danych z bazy danych do formularzu kontaktowego
		$imie_zmienna = $uzyt['imie'];
		$nazwisko_zmienna = $uzyt['nazwisko'];
		$email_zmienna = $uzyt['email'];
		$miasto_zmienna = $uzyt['miasto'];
		$telefon_zmienna = $uzyt['telefon'];
		
	}

	?>
	
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
	<h1>Formularz kontaktowy</h1>
	<br>
	<div>
		<form method="post" action="mailto:e-mail">
		<legend>Proszę wypełnić formularz: </legend>
		<fieldset>
			Twoje imię:
			<br>
			<input type="text" name="imie_kontakt" value= "<?php echo $imie_zmienna; ?>">
			<br>
			Twoje nazwisko:
			<br>
			<input type="text" name="nazwisko_kontakt" value= "<?php echo $nazwisko_zmienna; ?>">
			<br>
			Twój adres email:
			<br>
			<input type="text" name="email_kontakt" value= "<?php echo $email_zmienna; ?>">
			<br>
			Twoje miasto:
			<br>
			<input type="text" name="miasto_kontakt" value= "<?php echo $miasto_zmienna; ?>">
			<br>
			Twój numer telefonu:
			<br>
			<input type="text" name="telefon_kontakt" value= "<?php echo $telefon_zmienna; ?>">
			<br>

			Wpisz treść formularza kontaktowego:
			<br>
			<textarea name="tresc_kontakt"></textarea>
			<br><br>
			<input type="submit" value="Wyślij">
			<button type="reset">Wyczyść formularz</button> 
		</fieldset>
		</form>
	</div>
</body>

</html>