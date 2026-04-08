<?php
// insert.php - MySQL RDS Version

$host     = getenv('DB_HOST')     ?: 'YOUR_RDS_ENDPOINT_HERE';
$dbname   = getenv('DB_NAME')     ?: 'sprevonix';
$username = getenv('DB_USER')     ?: 'admin';
$password = getenv('DB_PASS')     ?: 'YourStrongPassword123!';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS submissions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fullName VARCHAR(255),
        organization VARCHAR(255),
        email VARCHAR(255),
        phone VARCHAR(50),
        service VARCHAR(100),
        requestType VARCHAR(100),
        preferredDate VARCHAR(50),
        preferredTime VARCHAR(50),
        message TEXT,
        submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $stmt = $pdo->prepare("INSERT INTO submissions 
        (fullName, organization, email, phone, service, requestType, preferredDate, preferredTime, message)
        VALUES (:fullName, :organization, :email, :phone, :service, :requestType, :preferredDate, :preferredTime, :message)");

    $stmt->execute([
        ':fullName'      => $_POST['fullName'] ?? '',
        ':organization'  => $_POST['organization'] ?? '',
        ':email'         => $_POST['email'] ?? '',
        ':phone'         => $_POST['phone'] ?? '',
        ':service'       => $_POST['service'] ?? '',
        ':requestType'   => $_POST['requestType'] ?? '',
        ':preferredDate' => $_POST['preferredDate'] ?? '',
        ':preferredTime' => $_POST['preferredTime'] ?? '',
        ':message'       => $_POST['message'] ?? ''
    ]);

    header("Location: contact.php?success=1");
    exit;

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
}
?>
