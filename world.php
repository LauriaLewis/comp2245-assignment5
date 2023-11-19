<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->query("SELECT * FROM countries");
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$country = filter_input(INPUT_GET, "country", FILTER_SANITIZE_STRING);
$countryquery = $conn->prepare("SELECT * FROM countries WHERE name LIKE ?");
$countryquery->execute(["%$country%"]);
$results = $countryquery->fetchAll(PDO::FETCH_ASSOC);

$context = filter_input(INPUT_GET, "context", FILTER_SANITIZE_STRING);
$cityquery = $conn->prepare("SELECT cities.name, cities.district, cities.population FROM cities JOIN countries ON cities.country_code=countries.code WHERE countries.name LIKE ?");
$cityquery->execute(["%$context%"]);
$city = $cityquery->fetchAll(PDO::FETCH_ASSOC);

header('Access-Control-Allow-Origin: *');
?>

<?php if(isset($country)&&(!isset($context))) :?>
<table>
          <thead>
            <tr>
              <th>Country Name</th>
              <th>Continent</th>
              <th>Independence Year</th>
              <th>Head of State</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($results as $row): ?>
              <tr>
                <td><?= $row['name']?></td>
                <td><?= $row['continent']?></td>
                <td><?= $row['independence_year']?></td>
                <td><?= $row['head_of_state']?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>

</table>

<?php elseif (isset($context)): ?>
<table>
  <tr>
    <th>Name</th>
    <th>District</th> 
    <th>Population</th>
  </tr>
  <?php foreach ($city as $row): ?>
    <tr>
      <td><?= $row['name'] ?></td>
      <td><?= $row['district'] ?></td>
      <td><?= $row['population'] ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php endif ?>