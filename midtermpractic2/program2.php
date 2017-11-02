<?php
$host = "localhost";
$dbname = "midterm";
$username = "kylekern";
$password = "";

// Establishing a connection
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Setting Errorhandling to Exception
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


//Name and country of birth of female actresses who were NOT born in the USA, ordered by last name
$sql1 = 'SELECT firstName,lastName FROM celebrity WHERE country_of_birth NOT LIKE "%USA%" and gender = "F" group by lastName;';

$stmt = $dbConn->query($sql1);	
$results = $stmt->fetchAll();
foreach ($results as $record) {
echo $record['firstName']  . " ". ['lastName'] ."<br />";
}
//Number of movies per category and their average duration (15 points)
$sql2 = 'SELECT movie_category, count(*), avg(duration) from movie group by movie_category;';

$stmt = $dbConn->query($sql2);	
$results = $stmt->fetchAll();
foreach ($results as $record) {
	echo $record['movie_category']  ." ". ['count(*)'] ." ". ['avg(duration'] ."<br />";
}	
//Top three longest movies released after 2000
$sql3 = 'SELECT movie_title from movie where release_year > 2000 order by duration desc limit 3;';

$stmt = $dbConn->query($sql3);	
$results = $stmt->fetchAll();
foreach ($results as $record) {
	echo $record['movie_title']  . "<br />";
}	
//List of actors and actresses who have not won an academy award, ordered by last name (15 points)
$sql4 = 'SELECT firstName, lastName FROM celebrity LEFT JOIN oscar ON celebrity.celebrityId = oscar.celebrity_id WHERE oscar.celebrity_id IS NULL; ';

$stmt = $dbConn->query($sql4);	
$results = $stmt->fetchAll();
foreach ($results as $record) {
	echo $record['firstName']  . " " . ['lastName'] . "<br />";
}
//List of celebrities who have won an oscar, ordered by "award_year". Include full name, movie title, oscar year, and award category.
$sql5 = 'SELECT firstName,lastName, movie_title,award_category,award_year from celebrity, movie, oscar, award_category where oscar.celebrity_id = celebrity.celebrityId and movie.movieId = oscar.movieId and oscar.award_cat_id = award_category.award_cat_id order by oscar.award_year asc;';

$stmt = $dbConn->query($sql5);	
$results = $stmt->fetchAll();
foreach ($results as $record) {
	echo $record['firstName']  . " " . ['lastName'] . " " . ['movie_title'] . " " . ['award_category'] . " " . ['award_year'] . "<br />";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

    </body>
</html>
