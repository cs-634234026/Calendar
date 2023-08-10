<?php
// Include database configuration file  
require_once 'dbConfig.php';

// Filter events by calendar date 
$where_sql = '';
if (!empty($_GET['start']) && !empty($_GET['end'])) {
    $where_sql .= " WHERE start BETWEEN '" . $_GET['start'] . "' AND '" . $_GET['end'] . "' ";
}

// Fetch events from database 
$sql = "SELECT * FROM events $where_sql";
$result = $db->query($sql);

$eventsArr = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($eventsArr, $row);
    }
}

// Render event data in JSON format 
echo json_encode($eventsArr);

--------------------------------------------------------------
// ดึงข้อมูลงานจากฐานข้อมูล
$sql = "SELECT id, name, deposit , start , end , note , color FROM events";
$result = $conn->query($sql);

$events = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $event = array(
            "id" => $row["id"],
            "name" => $row["name"],
            "deposit" => $row["deposit"],
            "start" => $row["start"]
            "end" => $row["end"]
            "note" => $row["note"]
            "color" => $row["color"]
        );
        array_push($events, $event);
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();

// ตั้งค่า header และคืนข้อมูลเป็น JSON
header('Content-Type: application/json');
echo json_encode($events);
?>





