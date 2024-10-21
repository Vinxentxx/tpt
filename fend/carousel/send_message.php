<?php
$host = 'localhost';
$dbname = 'messaging_system';
$username = 'root'; // หรือชื่อผู้ใช้ใหม่ของคุณ
$password = 'vinx220203'; // รหัสผ่าน (ถ้าว่างให้ใช้ '') 

// สร้างการเชื่อมต่อ
$conn = new mysqli($host, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function saveMessage($name, $email, $message) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    return $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    
    if (!empty($name) && !empty($email) && !empty($message)) {
        if (saveMessage($name, $email, $message)) {
            echo "ส่งข้อความเรียบร้อยแล้ว!";
        } else {
            echo "ไม่สามารถส่งข้อความได้ กรุณาลองใหม่อีกครั้ง.";
        }
    } else {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน.";
    }
}

$conn->close();
?>
