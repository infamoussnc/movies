<?php

$server = "localhost";
$user = "root";
$password = null;
$database = "Filme";
$company = $_POST['film'];


/*$db_link = mysqli_connect ($server, $user, $password, $database);
$result = mysqli_query( $db_link, $sql );

if ( ! $result )
{
  die('Ungültige Abfrage: ' . mysqli_error());
}
*/


// Create connection
$conn = new mysqli($server, $user, $password, $database);

// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Film AS f JOIN Produktionsfirma AS pf ON f.firma_id = pf.firma_id WHERE pf.name LIKE '%$company%';";
$query_sum = "SELECT SUM(film_id) FROM Film AS f JOIN Produktionsfirma AS pf ON f.firma_id = pf.firma_id WHERE pf.name LIKE '%$company%';";

//$sql = "SELECT * FROM Film;";
$result = $conn->query($sql);

echo nl2br("Filmstudio: $company \n\n");

if ($result->num_rows > 0) 
{
  // output data of each row
  while($row = $result->fetch_assoc()) 
  {
    echo "FilmID: " . $row["film_id"]. " - Titel: " . $row["titel"]. " - Erscheinungsdatum: " . $row["erscheinungsdatum"]. "<br>";
    //echo "FilmID: " . $row["film_id"]. " - Titel: " . $row["titel"]. "<br>";
  }
} 
else 
{
  echo "Die Suche lieferte leider keine Ergebnisse :( ";
}
$conn->close();
?>

