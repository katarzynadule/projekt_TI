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

	<h1>Rejestracja</h1>
	<br>
	<form method="post" action="RejestracjaWykonanie.php">
		Podaj nazwę użytkownika:
		<br>
		<input type="text" name="username" max="30" value="">
		<br>
		Podaj hasło:
		<br>
		<input type="password" name="password" max="30" value="">
		<br>
		Podaj imię:
		<br>
		<input type="text" name="name" max="30" value="">
		<br>
		Podaj nazwisko:
		<br>
		<input type="text" name="surname" max="30" value="">
		<br>
		Podaj email:
		<br>
		<input type="text" name="email" max="60" value="">
		<br>
		Podaj miasto:
		<br>
		<input type="text" name="city" max="30" value="">
		<br>
		Podaj telefon:
		<br>
		<input type="text" name="telephone" max="9" value="">

		<br>
		<input type="submit" name="reg" value="Zarejestruj się">
		<br>
		Masz już konto?
		<a href="logowanie.php">Zaloguj się!</a>
	</form>

</body>

</html>