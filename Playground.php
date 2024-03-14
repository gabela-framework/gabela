<?php
function bubbleSort($arr) {
    $n = count($arr);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $temp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $temp;
            }
        }
    }
    return $arr;
}

echo "============= bubble Sort\n";
$array = [64, 34, 25, 12, 22, 11, 90];
$sortedArray = bubbleSort($array);
print_r($sortedArray);

// =======================

function factorial($n) {
    if ($n == 0 || $n == 1) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}

echo "=========== factorial";
$number = 3;
echo "\n\nFactorial of $number is " . factorial($number) . "\n\n";



// ==================


function binarySearch($arr, $target) {
    $low = 0;
    $high = count($arr) - 1;

    while ($low <= $high) {
        $mid = floor(($low + $high) / 2);

        if ($arr[$mid] == $target) {
            return $mid;
        }

        if ($arr[$mid] < $target) {
            $low = $mid + 1;
        } else {
            $high = $mid - 1;
        }
    }

    return -1;
}

echo "=========== binary Search";

$array = [1, 2, 3, 4, 5, 6, 7, 8, 9];
$target = 1;
$result = binarySearch($array, $target);
echo "\n\nElement found at index $result\n\n";


// Simulating a database with an array
$users = [
    1 => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
    2 => ['id' => 2, 'name' => 'Jane Doe', 'email' => 'jane@example.com'],
];

// Get all users
if (isset($_SERVER['REQUEST_METHOD']) === 'GET') {
    header('Content-Type: application/json');
    echo json_encode($users);
}

// Get a specific user by ID
if (isset($_SERVER['REQUEST_METHOD']) === 'GET' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    if (isset($users[$userId])) {
        header('Content-Type: application/json');
        echo json_encode($users[$userId]);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'User not found']);
    }
}

// Create a new user
if (isset($_SERVER['REQUEST_METHOD']) === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $newUserId = max(array_keys($users)) + 1;
    $data['id'] = $newUserId;
    $users[$newUserId] = $data;
    header('Content-Type: application/json');
    echo json_encode(['message' => 'User created successfully', 'user' => $data]);
}

// Update a user by ID
if (isset($_SERVER['REQUEST_METHOD']) === 'PUT' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    if (isset($users[$userId])) {
        $data = json_decode(file_get_contents('php://input'), true);
        $users[$userId] = array_merge($users[$userId], $data);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'User updated successfully', 'user' => $users[$userId]]);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'User not found']);
    }
}

// Delete a user by ID
if (isset($_SERVER['REQUEST_METHOD']) === 'DELETE' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    if (isset($users[$userId])) {
        //unset($users[$userId]);
        header('Content-Type: application/json');
        echo json_encode(['message' => 'User deleted successfully']);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['error' => 'User not found']);
    }
}
