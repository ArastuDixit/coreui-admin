<?php
include('config.php');
?>

<link rel="stylesheet" href="style.css">

<?php
// Check if the form is submitted
if (isset($_POST['update'])) {
    // Get the updated values from the form
    $id = $_POST['id'];
    $user = $_POST['user'];
    $country = $_POST['country'];
    $usage = $_POST['usage'];
    $payment = $_POST['payment'];
    $activity = $_POST['activity'];

    // Update the record in the database
    $sql = "UPDATE coreui_users SET `user` = '$user', country = '$country', `usage` = '$usage', payment = '$payment', activity = '$activity' WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo '<div class="content-wrapper"><div class="success">Record updated successfully!</div></div>';
    } else {
        echo '<div class="content-wrapper"><div class="error">Error updating record. Please try again.</div></div>';
    }
}

// Get the record to edit
if (isset($_GET['id'])) {
    // Get the ID of the record to edit
    $edit_id = $_GET['id'];

    // Fetch the record from the database
    $sql = "SELECT * FROM coreui_users WHERE id = '$edit_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $user = $row['user'];
        $country = $row['country'];
        $usage = $row['usage'];
        $payment = $row['payment'];
        $activity = $row['activity'];
    } else {
        echo '<div class="content-wrapper"><div class="error">Record not found.</div></div>';
    }
}

// Close the database connection
mysqli_close($conn);
?>
<div class="">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Career</h4>
                        <p class="card-description">
                            Update Career
                        </p>
                        <form action="" method="post" style="width:80vw; min-width:400px;">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="form-group">
                                <div class="row mb-4">
                                    <label for="user">User</label>
                                    <input type="text" name="user" id="user" class="form-control" value="<?php echo $user; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mb-4">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" id="country" class="form-control" value="<?php echo $country; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mb-4">
                                    <label for="usage">Usage</label>
                                    <input type="text" name="usage" id="usage" class="form-control" value="<?php echo $usage; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mb-4">
                                    <label for="payment">Payment</label>
                                    <input type="text" name="payment" id="payment" class="form-control" value="<?php echo $payment; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row mb-4">
                                    <label for="activity">Activity</label>
                                    <input type="text" name="activity" id="activity" class="form-control" value="<?php echo $activity; ?>">
                                </div>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                            <a href="user.php" class="btn btn-danger">Cancel</a>
                        </form>
                        </div>
                </div>
            </div>

        </div>
    </div>
    <!-- content-wrapper ends -->

    <!-- partial -->
</div>