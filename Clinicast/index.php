<?php
$conn = new mysqli("localhost", "root", "","clinicast_records");

if($conn->connect_error){
    die("Database connection failed: " . $conn->connect_error);
}

$message = "";

if($_SERVER["REQUEST_METHOD"] =="POST"){
    $name = trim($_POST["patient_name"]?? "");
    $student_id = $_POST["student_id"] ?? "";

if($name === "" || $student_id === ""){
    $message ="Please complete all fields.";

}else {$stmt = $conn-> prepare(
    "INSERT INTO patient_record (patient_name, student_id)
    VALUES (?,?)"
);
$stmt -> bind_param("ss", $name, $student_id);
if($stmt->execute()){
    $message = "Patient record saved successfully!";
}else{$message="Error saving student record.";
}
$stmt->close();
}
}
?>

<html lang="en">
<head>
    <title>Clinicast</title>
</head>
<body>
<form action="index.php" method="POST">
    <div>
    <label for="patient_name">Patient Name:</label>
    <input type="text" id="patient_name" name="patient_name" required>    
    </div>
    <br>
    <div>
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required>
    </div>
    <br>
    <button type="submit">Submit</button>
</form>
</body>
</html>