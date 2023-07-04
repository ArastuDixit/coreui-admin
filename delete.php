<?php
include('config.php');
?>

<?php
// Check if the delete button is clicked
if (isset($_GET['id'])) {
    // Get the ID of the record to delete
    $delete_id = $_GET['id'];

    // Delete the record from the database
    $sql = "DELETE FROM coreui_users WHERE id = '$delete_id'";

    if (mysqli_query($conn, $sql)) {
        echo '<div class="content-wrapper"><div class="success">Record deleted successfully!</div></div>';
        // Redirect to user.php after successful deletion
        header("Location: user.php");
        exit();
    } else {
        echo '<div class="content-wrapper"><div class="error">Error deleting record. Please try again.</div></div>';
    }
}

// Close the database connection
mysqli_close($conn);
?>