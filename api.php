<?php

// Include your database connection or any necessary configurations here

// Set the response header as JSON
header('Content-Type: application/json');

// Check the request method
$method = $_SERVER['REQUEST_METHOD'];

// Handle different request methods
switch ($method) {
    case 'POST':
        // Create a new record
        createRecord();
        break;
    case 'PUT':
        // Update an existing record
        updateRecord();
        break;
    case 'GET':
        // Fetch records
        fetchRecords();
        break;
    case 'DELETE':
        // Delete a record
        deleteRecord();
        break;
    default:
        // Invalid request method
        $response = [
            'status' => 'error',
            'message' => 'Invalid request method'
        ];
        echo json_encode($response);
}

// Function to create a new record
function createRecord()
{
    include('config.php');
    // Get the POST data
    $user = $_POST['user'];
    $country = $_POST['country'];
    $usage = $_POST['usage'];
    $payment = $_POST['payment'];
    $activity = $_POST['activity'];

    // Perform validation and other necessary checks
    
    // Insert the data into the database
    // Replace this with your actual code to insert the data into your database
    $sql = "INSERT INTO coreui_users (`user`, `country`, `usage`, `payment`, `activity`) VALUES ('" . $user . "', '" . $country . "', '" . $usage . "', '" . $payment . "', '" . $activity . "')";
    // Example: $result = insertUser($user, $country, $usage, $payment, $activity);
    $result = mysqli_query($conn, $sql);
    // Assuming the user was successfully inserted
    // $result = true;

    if ($result) {
        // User was created successfully
        $response = [
            'status' => 'success',
            'message' => 'User created successfully'
        ];
    } else {
        // Failed to create user
        $response = [
            'status' => 'error',
            'message' => 'Failed to create user'
        ];
    }

    echo json_encode($response);
}

// Function to update an existing record
function updateRecord()
{
    // Get the PUT data
    parse_str(file_get_contents("php://input"), $_PUT);

    // Get the record ID from the URL or the PUT data
    $id = $_GET['id'] ?? $_PUT['id'];

    // Get the updated values from the PUT data
    $user = $_PUT['user'];
    $country = $_PUT['country'];
    $usage = $_PUT['usage'];
    $payment = $_PUT['payment'];
    $activity = $_PUT['activity'];

    // Perform validation and other necessary checks

    // Update the record in the database
    // Replace this with your actual code to update the record in your database
    $result = "UPDATE coreui_users SET `user` = '$user', country = '$country', `usage` = '$usage', payment = '$payment', activity = '$activity' WHERE id = '$id'";
    // Example: $result = updateUser($id, $user, $country, $usage, $payment, $activity);

    // Assuming the user was successfully updated
    // $result = true;

    if ($result) {
        // User was updated successfully
        $response = [
            'status' => 'success',
            'message' => 'User updated successfully'
        ];
    } else {
        // Failed to update user
        $response = [
            'status' => 'error',
            'message' => 'Failed to update user'
        ];
    }

    echo json_encode($response);
}

// Function to fetch records
function fetchRecords()
{
    // Fetch records from the database
    // Replace this with your actual code to fetch records from your database
    // Example: $records = fetchUsers();

    // Assuming you have an array of records fetched from the database
    $records = [
        ['id' => 1, 'user' => 'John Doe', 'country' => 'USA', 'usage' => 'Some usage', 'payment' => 'Some payment', 'activity' => 'Some activity'],
        ['id' => 2, 'user' => 'Jane Smith', 'country' => 'Canada', 'usage' => 'Some usage', 'payment' => 'Some payment', 'activity' => 'Some activity']
    ];

    if (!empty($records)) {
        // Records found
        $response = [
            'status' => 'success',
            'data' => $records
        ];
    } else {
        // No records found
        $response = [
            'status' => 'error',
            'message' => 'No records found'
        ];
    }

    echo json_encode($response);
}

// Function to delete a record
function deleteRecord()
{
    // Get the record ID from the URL or the DELETE data
    $id = $_GET['id'] ?? $_DELETE['id'];

    // Perform validation and other necessary checks

    // Delete the record from the database
    // Replace this with your actual code to delete the record from your database
    // Example: $result = deleteUser($id);

    // Assuming the user was successfully deleted
    $result = true;

    if ($result) {
        // User was deleted successfully
        $response = [
            'status' => 'success',
            'message' => 'User deleted successfully'
        ];
    } else {
        // Failed to delete user
        $response = [
            'status' => 'error',
            'message' => 'Failed to delete user'
        ];
    }

    echo json_encode($response);
}

?>
