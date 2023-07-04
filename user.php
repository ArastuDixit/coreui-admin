<?php
session_start(); // Start the session

// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    header("Location: login.php");
    exit;
}

// Check if the user clicked the logout link
if (isset($_GET['logout'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: login.php");
    exit;
}
?>

<?php
include('header.php');
?>

<?php
include('sidebar.php');
?>
<?php
include('navbar.php');
?>

<?php
include('config.php');
?>

<?php
// Perform the query to fetch data from the database
$query = "SELECT * FROM coreui_users";
$results = mysqli_query($conn, $query);
?>

<!-- <link rel="stylesheet" href="bootstrap.min.css"> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ccc;
        }

        .table th {
            background-color: #343a40;
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:hover {
            background-color: #e0e0e0;
        }

        .link-dark {
            color: #343a40;
        }

        .link-dark:hover {
            color: #007bff;
        }

        .fa-solid {
            width: 1em;
            height: 1em;
        }

        .fs-5 {
            font-size: 1.2rem;
        }

        /* Increase width of "Action" column */
        .table td:last-child {
            width: 150px;
            /* Set your desired width here */
        }

        .form-control {
            width: 100%;
            /* Change the width value as needed */
        }
    </style>

    <title>Open Positions</title>

</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #ff4d4d;">
        Career Technorizen
    </nav>

    <div class="container">

        <a href="add.php" class="btn btn-dark mb-3">Add New</a>

        <table class="table table-hover text-center">

            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User</th>
                    <th scope="col">Country</th>
                    <th scope="col">Usage</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Activity</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Define the number of records per page
            $recordsPerPage = 5;

            // Get the current page from the URL parameter
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            // Calculate the offset for the database query
            $offset = ($currentPage - 1) * $recordsPerPage;

            // Perform the query to fetch data from the database
            $query = "SELECT * FROM coreui_users LIMIT $offset, $recordsPerPage";
            $result = mysqli_query($conn, $query);

            // Check if the query was successful
            if ($result) {
                // Iterate over the fetched rows
                while ($row = mysqli_fetch_assoc($result)) {
                    // Display the row data
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['user']; ?></td>
                        <td><?php echo $row['country']; ?></td>
                        <td><?php echo $row['usage']; ?></td>
                        <td><?php echo $row['payment']; ?></td>
                        <td><?php echo $row['activity']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this entry?')" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                        </td>
                    </tr>
                <?php
                }
                if (mysqli_num_rows($result) === 0) {
                    echo '<tr><td colspan="7">Record Not Found</td></tr>';
                }

                // Calculate the total number of pages
                $query = "SELECT COUNT(*) AS total FROM coreui_users";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $totalPages = ceil($row['total'] / $recordsPerPage);

                // Display pagination links
                echo '<tr><td colspan="7"><div class="pagination">';
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo '<a href="user.php?page=' . $i . '">' . $i . '</a>';
                }
                echo '</div></td></tr>';
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </tbody>

        </table>

    </div>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>




<!-- Popup form code -->
<div id="popupForm" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="mb-3">
                        <label for="user" class="form-label">User</label>
                        <input type="text" class="form-control" id="user" required>
                    </div>

                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <select class="form-select" id="country" required>
                            <option value="">Select a country</option>
                            <option value="us">United States</option>
                            <option value="ca">Canada</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="usage" class="form-label">Usage</label>
                        <input type="text" class="form-control" id="usage" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment" class="form-label">Payment Method</label>
                        <input type="text" class="form-control" id="payment" required>
                    </div>
                    <div class="mb-3">
                        <label for="activity" class="form-label">Activity</label>
                        <input type="text" class="form-control" id="activity" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveButton">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    const addButton = document.getElementById('addButton');
    const editButton = document.getElementById('editButton');
    const popupForm = document.getElementById('popupForm');
    const saveButton = document.getElementById('saveButton');
    const closeButton = document.querySelector('#popupForm .btn-close');

    addButton.addEventListener('click', function(event) {
        event.preventDefault();
        clearForm();
        popupForm.classList.add('show');
        popupForm.style.display = 'block';
    });

    editButton.addEventListener('click', function(event) {
        event.preventDefault();
        populateForm(); // Populate the form with edit details
        popupForm.classList.add('show');
        popupForm.style.display = 'block';
    });

    closeButton.addEventListener('click', function() {
        popupForm.classList.remove('show');
        popupForm.style.display = 'none';
    });

    saveButton.addEventListener('click', function() {
        const user = document.getElementById('user').value;
        const country = document.getElementById('country').value;
        const usage = document.getElementById('usage').value;
        const payment = document.getElementById('payment').value;
        const activity = document.getElementById('activity').value;

        // Create an XMLHttpRequest object
        const xhr = new XMLHttpRequest();

        // Configure the request
        xhr.open('POST', 'user.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        // Define the data to be sent in the request body
        const data = 'user=' + encodeURIComponent(user) +
            '&country=' + encodeURIComponent(country) +
            '&usage=' + encodeURIComponent(usage) +
            '&payment=' + encodeURIComponent(payment) +
            '&activity=' + encodeURIComponent(activity);

        // Send the request
        xhr.send(data);

        // Handle the response
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Request successful
                    console.log(xhr.responseText);
                    location.reload(); // Refresh the page after successful save/update
                } else {
                    // Error in the request
                    console.log('Error:', xhr.status);
                }
            }
        };

        popupForm.classList.remove('show');
        popupForm.style.display = 'none';
    });

    function clearForm() {
        document.getElementById('user').value = '';
        document.getElementById('country').value = '';
        document.getElementById('usage').value = '';
        document.getElementById('payment').value = '';
        document.getElementById('activity').value = '';
    }

    function populateForm() {
        // Fetch the details for edit and populate the form
        const user = '$user'; // Replace with your logic to fetch the user details
        const country = 'us'; // Replace with your logic to fetch the user details
        const usage = 'Sample usage'; // Replace with your logic to fetch the user details
        const payment = 'Sample payment method'; // Replace with your logic to fetch the user details
        const activity = 'Sample activity'; // Replace with your logic to fetch the user details

        document.getElementById('user').value = user;
        document.getElementById('country').value = country;
        document.getElementById('usage').value = usage;
        document.getElementById('payment').value = payment;
        document.getElementById('activity').value = activity;
    }
</script>


<!-- PHP code for handling add user -->

<?php
include('config.php');
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $user = $_POST['user'];
    $country = $_POST['country'];
    $usage = $_POST['usage'];
    $payment = $_POST['payment'];
    $activity = $_POST['activity'];

    // Perform the database insert operation
    $sql = "INSERT INTO `coreui_users` (`user`, `country`, `usage`, `payment`, `activity`) VALUES ('$user', '$country', '$usage', '$payment', '$activity')";

    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully.";
        header("Location: index.php");
        exit(); // Make sure to exit after the redirect
    } else {
        // Error in insertion
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!-- PHP code for handling form update -->

<?php
include('config.php');

// Check if the form is submitted for editing
if (isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];

    // Retrieve the existing data for the selected entry from the database
    $sql = "SELECT * FROM `coreui_users` WHERE `id` = $edit_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $edit_user = $row['user'];
        $edit_country = $row['country'];
        $edit_usage = $row['usage'];
        $edit_payment = $row['payment'];
        $edit_activity = $row['activity'];
    } else {
        echo "Error: No data found.";
    }
}

// Check if the form is submitted for saving the edited entry
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_edit'])) {
    $edit_id = $_POST['edit_id'];
    $edit_user = $_POST['edit_user'];
    $edit_country = $_POST['edit_country'];
    $edit_usage = $_POST['edit_usage'];
    $edit_payment = $_POST['edit_payment'];
    $edit_activity = $_POST['edit_activity'];

    // Perform the database update operation
    $sql = "UPDATE `coreui_users` SET `user`='$edit_user', `country`='$edit_country', `usage`='$edit_usage', `payment`='$edit_payment', `activity`='$edit_activity' WHERE `id`='$edit_id'";

    if (mysqli_query($conn, $sql)) {
        echo "Data updated successfully.";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<?php
include('footer.php');
?>