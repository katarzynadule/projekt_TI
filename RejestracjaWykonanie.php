<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylePsy.css">
    <title>Rejestracja</title>
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

	$nazwaserwera = "localhost";
	$uzytkownik = "root";
	$haslo = "";
	$nazwabd = "uzytkownicy";

	$polaczenie = new mysqli($nazwaserwera, $uzytkownik, $haslo, $nazwabd);

	$adres_strony = "Rejestracja.php";
	$tekst_przycisku ="Wróć";

	if(mysqli_connect_errno()!=0)
	{
		echo 'Blad polaczenia: ' . mysqli_connect_error();
		exit;
	}

	if(isset($_POST['reg']))
	{
		if($_POST['username'] != "" && $_POST['password'] != "" && $_POST['email'] != "")
		{
			
			  // Sprawdzanie czy w bazie danych znajduje się już użytkownik o podanym loginie i/lub mailu
			  $czy_uzytkownik_w_bazie_sql = "SELECT * FROM uzytkownicy WHERE nazwa_uzyt='$_POST[username]' OR email='$_POST[email]' LIMIT 1";
			  $wynik = $polaczenie -> query($czy_uzytkownik_w_bazie_sql);
			  if($wynik==false)
				{
					echo 'bledne polecenie sql: ' . $sql;
					$polaczenie->close();
					exit;
				}
			$uzyt = $wynik->fetch_assoc();
			  
			//Jeżeli uzytkownik nie istnieje
			if(!$uzyt)
			{		
				//Dodanie użytkownika do bazy danych
				$sql_insert = "INSERT INTO uzytkownicy (nazwa_uzyt, haslo, imie, nazwisko, email, miasto, telefon)
				VALUES ('" . $_POST['username'] . "', '" . $_POST['password'] . "', '" . $_POST['name'] . "', '" . $_POST['surname'] . "', '" . $_POST['email'] . "', '" . $_POST['city'] . "', '" . $_POST['telephone'] . "')";
				
				
				if ($polaczenie->query($sql_insert) === TRUE) 
				{
				  echo "Pomyślnie zarejestrowano!";
				  echo '</br>';
				  $adres_strony = "logowanie.php";
				  $tekst_przycisku = "OK";
				} 
				else 
				{
				  echo "Wystąpił  błąd: " . $sql_insert . "<br>" . $polaczenie->error;
				}
			}
			else
			{
				echo "Użytkownik o podanej nazwie użytkownika i/lub adresie email już istnieje!";
			}
		}
		else
		{
			echo "Nazwa użytkownika, hasło i adres email nie mogą być puste!";
		}

	}

	?>

	<form action="<?php echo $adres_strony; ?>">
		<input type="submit" value= "<?php echo $tekst_przycisku; ?>"/>
	</form>

</body>

</html>