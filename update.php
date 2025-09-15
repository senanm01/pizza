<?php
// CONFIG
$password = "masteryoda"; // change this!
$file = "data.json";

// Validate password
if (!isset($_POST["password"]) || $_POST["password"] !== $password) {
    http_response_code(403);
    echo "Invalid password";
    exit;
}

if (!isset($_POST["name"])) {
    http_response_code(400);
    echo "No name given";
    exit;
}

// Load current data
$data = json_decode(file_get_contents($file), true);

// Deduct slice if available
if ($data["pizzaSlices"] > 0) {
    $data["pizzaSlices"] -= 1;
    $name = $_POST["name"];
    if (isset($data["missedWork"][$name])) {
        $data["missedWork"][$name] += 1;
    }
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    echo "Updated successfully";
} else {
    echo "No slices left!";
}
?>
