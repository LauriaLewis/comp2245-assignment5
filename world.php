<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$countryParam = isset($_GET["country"]) ? trim($_GET["country"]) : null;
$filteredCountry = filter_var($countryParam, FILTER_SANITIZE_STRING);

$query = "SELECT * FROM countries";

if ($filteredCountry) {
    $query .= " WHERE name LIKE '%$filteredCountry%'";
}

$stmt = $conn->query($query);

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<ul>
<?php foreach ($results as $row): ?>
    <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
