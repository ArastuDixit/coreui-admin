<?php
include('config.php');
?>


<?php
if (isset($_POST['insert'])) {

    // Get the data from form input
    $user = $_POST['user'];
    $country = $_POST['country'];
    $usage = $_POST['usage'];
    $payment = $_POST['payment'];
    $activity = $_POST['activity'];

    $sql = "INSERT INTO coreui_users (`user`, `country`, `usage`, `payment`, `activity`) VALUES ('" . $user . "', '" . $country . "', '" . $usage . "', '" . $payment . "', '" . $activity . "')";
    // Check if the insert was successful
    if (mysqli_query($conn, $sql)) {
        echo '<div class="content-wrapper"><div class="success">Data inserted successfully!</div></div>';
    } else {
        echo '<div class="content-wrapper"><div class="error">Error inserting Data. Please try again.</div></div>';
    }
    // Close the database connection
    mysqli_close($conn);
}
?>

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
        .form-control {
            width: 100%;
            /* Change the width value as needed */
        }
    </style>


    <title>Add Career Detail</title>

</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #ff4d4d;">
        Career Add
    </nav>

    <div class="container">
        <div class="text-center mb-4">

            <h3>Add New Career</h3>
            <p class="text-muted">Complete the form below to add a new career</p>
        </div>
        <div class="container d-flex justify-content-center">
            <form action="api.php" method="post" style="width:80vw; min-width:400px;">
                <div class="form-group">
                    <div class="row mb-4">
                        <label for="user">User</label>
                        <input type="text" name="user" id="user" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row mb-4">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row mb-4">
                        <label for="usage">Usage</label>
                        <input type="text" name="usage" id="usage" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row mb-4">
                        <label for="payment">Payment</label>
                        <input type="text" name="payment" id="payment" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row mb-4">
                        <label for="activity">Activity</label>
                        <input type="text" name="activity" id="activity" class="form-control">
                    </div>
                </div>
                <button type="submit" name="insert" class="btn btn-primary">Save Data</button>
                <a href="user.php" class="btn btn-danger">BACK</a>
            </form>
        </div>
    </div>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>