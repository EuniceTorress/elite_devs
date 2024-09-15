<?php
header('Content-Type: application/json');  

include '../connection.php';  

$role = $_POST['role'] ?? '';
$firstName = ucwords(strtolower($_POST['firstName'] ?? ''));
$middleName = ucwords(strtolower($_POST['middleName'] ?? ''));
$lastName = ucwords(strtolower($_POST['lastName'] ?? ''));
$suffix = ucwords(strtolower($_POST['suffix'] ?? ''));
$gender = $_POST['gender'] ?? '';
$contactNumber = $_POST['contactNumber'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$purpose = $_POST['purpose'] ?? '';
$purposeOther = $_POST['purposeOtherInput'] ?? '';
$department = $_POST['department'] ?? '';
$srCode = $_POST['srCode'] ?? '';
$program = $_POST['program'] ?? '';
$course = $_POST['course'] ?? '';
$position = $_POST['position'] ?? '';
$positionOther = $_POST['positionOtherInput'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$email = $_SESSION['user_email'] ?? '';

$errors = [];

if (empty($username)) {
    $errors[] = 'Username is required.';
}
if (empty($password)) {
    $errors[] = 'Password is required.';
} elseif (strlen($password) < 8) {
    $errors[] = 'Password must be at least 8 characters long.';
} elseif (!preg_match('/\d/', $password)) {
    $errors[] = 'Password must contain at least one number.';
}

if (count($errors) > 0) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit();
}

switch($role) {
    case 'rgoStaff':
        $role = 1;
        break;
    case 'facilitator':
        $role = 2;
        break;
    case 'student':
        $role = 3;
        break;
    default:
        $role = 4;
        break;
}

$stmt = $conn->prepare("SELECT id FROM user_info WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'errors' => ['Username is already taken.']]);
    $stmt->close();
    $conn->close();
    exit();
}
$stmt->close();

$name = trim($firstName . ' ' . ($middleName ? $middleName . ' ' : '') . $lastName . ($suffix ? ', ' . $suffix : ''));

if ($purpose) {
    $details = $purpose;
} elseif ($purposeOther) {
    $details = $purposeOther;
} elseif ($srCode) {
    $details = $srCode . ', ' . $program . ', ' . $course;
} elseif ($department) {
    $details = $department;
} elseif ($position) {
    $details = $position;
} elseif ($positionOther) {
    $details = $positionOther;
} else {
    $errors[] = 'Double check the details you provide.';
}

if (count($errors) > 0) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit();
}

$stmt = $conn->prepare("INSERT INTO user_info (name, contact_number, details, email, birthdate, username, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$passwordHash = password_hash($password, PASSWORD_DEFAULT);  
$stmt->bind_param("sssssssi", $name, $contactNumber, $details, $email, $birthdate, $username, $passwordHash, $role);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'errors' => ['Error: ' . $stmt->error]]);
}

$stmt->close();
$conn->close();
?>
