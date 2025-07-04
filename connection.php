
<?php
// $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $dbname = "heather";
//     $conn = new mysqli($servername, $username, $password, $dbname, 3306);

//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }


// $servername = "DESKTOP-SN5HLET"; 
// $database = "HeatherDB";
// $username = "admin_user"; // Use SQL Server login credentials
// $password = 'Pa$$w0rd';

// try {
//     // Create the PDO object
//     $conn = new PDO("sqlsrv:Server=$servername;Database=$database", $username, $password);

//     // Set the error mode to exception
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // Now it's safe to use $conn
//     $stmt = $conn->query("SELECT 1");
//     if ($stmt) {
//         echo "Test query succeeded.";
//     }

// } catch (PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// }

$serverName = "DESKTOP-SN5HLET";
$database = "HeatherDB";

try {
    $dsn = "sqlsrv:Server=localhost;Database=heather";
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database;");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully with Windows Authentication.";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}






// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }
// // Check if the user is logged in and set the user type accordingly
// $user_type = $_SESSION['user_type'] ?? 'guest';  // fallback for non-logged-in users

// switch ($user_type) {
//     case 'Admin':
//         $username = "admin_login";
//         $password = (string) "Pa$$w0rd";
//         break;
//     case 'Tenant':
//         $username = "tenant_login";
//         $password = (string) "Pa$$w0rd";
//         break;
//     case 'Advertiser':
//         $username = "advertiser_login";
//         $password = (string) "Pa$$w0rd";
//         break;
//     default:
//         die("Unauthorized access.");
// }

// $servername = "localhost";
// $dbname = "HeatherDB";  // Your SQL Server DB
// $conn = new PDO("sqlsrv:Server=$servername;Database=$dbname", $username, $password);
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    ?>