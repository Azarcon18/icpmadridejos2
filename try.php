<?php
// Database configuration
$dev_data = array(
    'id' => '-1',
    'firstname' => 'Developer',
    'lastname' => '',
    'username' => 'dev_oretnom',
    'password' => '5da283a2d990e8d8512cf967df5bc0d0',
    'last_login' => '',
    'date_updated' => '',
    'date_added' => ''
);

if (!defined('base_url')) define('base_url', 'https://icpmadridejos.com/');
if (!defined('base_app')) define('base_app', str_replace('\\', '/', __DIR__) . '/');
if (!defined('dev_data')) define('dev_data', $dev_data);
if (!defined('DB_SERVER')) define('DB_SERVER', "localhost");
if (!defined('DB_USERNAME')) define('DB_USERNAME', "u510162695_church_db");
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', "1Church_db");
if (!defined('DB_NAME')) define('DB_NAME', "u510162695_church_db");

// Establish secure database connection using PDO
try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

// Function to display all rows from a specified table
function viewAllTableData($pdo, $tableName) {
    try {
        // Prepare SQL query to fetch all rows from the specified table
        $sql = "SELECT * FROM " . $tableName;
        $stmt = $pdo->prepare($sql);
        
        // Execute the query
        $stmt->execute();
        
        // Fetch all results
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if any rows were returned
        if (count($rows) > 0) {
            // Display results as an HTML table
            echo "<table border='1'>";
            echo "<tr>";
            // Display table headers
            foreach ($rows[0] as $key => $value) {
                echo "<th>" . htmlspecialchars($key) . "</th>";
            }
            echo "</tr>";

            // Display table data
            foreach ($rows as $row) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No data found in the table.";
        }
    } catch (PDOException $e) {
        die("ERROR: Could not execute $sql. " . $e->getMessage());
    }
}

// Call the function to view all table data, e.g., 'users' table
viewAllTableData($pdo, 'users');
?>
