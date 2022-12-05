<?php
session_start();
// informatii conectare.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'magazin';
// Încercați să vă conectați folosind informațiile de mai sus.
$con = mysqli_connect(
    $DATABASE_HOST,
    $DATABASE_USER,
    $DATABASE_PASS,
    $DATABASE_NAME
);
if (mysqli_connect_errno()) {
    // Dacă există o eroare la conexiune, opriți scriptul și afișați eroarea
    exit('Esec conectare MySQL: ' . mysqli_connect_error());
} else {
    //echo 'Conectat la DB!!!!!!!!!!!!!';
}

$comanda_info = "INSERT INTO clienti (nume, prenume, email, telefon, adresa, comentarii)
 VALUES ('$_POST[nume]', '$_POST[prenume]', '$_POST[email]', '$_POST[telefon]', '$_POST[adresa]', '$_POST[comentarii]')";

if ($con->query($comanda_info) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $comanda_info . "<br>" . $con->error;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finish</title>
</head>

<body>
    <h1>Felicitari, comanda ta este in curs de livrare</h1>

    <a href="magazin.php">inapoi la magazin</a>

</body>

</html>