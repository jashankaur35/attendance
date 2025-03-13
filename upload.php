<?php
if (isset($_FILES['file'])) {
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];

    // Define the upload directory
    $upload_dir = "uploadFiles/"; // Ensure this folder exists

    // Move the uploaded file to the server directory
    if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
        include('config.php');

        // Correct SQL query syntax
        $sql = "INSERT INTO uploadedfiles(fileName) VALUES('$file_name')";

        if (mysqli_query($con, $sql)) {
            echo "<script>alert('File uploaded successfully!');</script>";
        } else {
            echo "<script>alert('Database error: " . mysqli_error($con) . "');</script>";
        }
    } else {
        echo "<script>alert('File upload failed!');</script>";
    }
}

// Fetch uploaded files from database
include('config.php');
$sql = "SELECT fileName FROM uploadedfiles";
$result = mysqli_query($con, $sql);
?>


<section class="main-div">
    <!-- Upload Form -->
    <div class="upload-container">
        <!--h2>Upload a File</h2-->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <label class="upload-btn">
                <i class="fas fa-upload"></i> Choose File
                <input type="file" id="fileInput" name="file">
            </label>
            <br>
            <button type="submit" class="upload-btn submit-btn"><i class="fas fa-paper-plane"></i> Submit</button>
        </form>
    </div>

    <!-- Display Uploaded Files -->
    <h2>Uploaded Files</h2>
    <div class="file-container">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $file_name = $row['fileName'];
            echo "<div class='file-card'>
                    <i class='fas fa-file-alt file-icon'></i>
                    <a href='uploadFiles/$file_name' target='_blank' class='file-name'>$file_name</a>

                    <!-- Delete Button -->
                    <form action='deleteFile.php' method='post' class='delete-form'>
                        <input type='hidden' name='file_name' value='$file_name'>
                        <button type='submit' class='delete-btn'><i class='fas fa-trash'></i></button>
                    </form>
                  </div>";
        }
    } else {
        echo "<p>No files uploaded yet.</p>";
    }
    ?>
</div>

</section>