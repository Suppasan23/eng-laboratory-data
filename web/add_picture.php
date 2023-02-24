<?php

if(isset($_POST['submit'])) {
    $file = $_FILES['file'];

    // file properties
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_error = $file['error'];

    // get file extension
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // allowed extensions
    $allowed = array('jpg', 'jpeg', 'png', 'gif', 'webp');

    if(in_array($file_ext, $allowed)) {
        if($file_error === 0) {
            if($file_size <= 1000000) {
                // create new unique file name to avoid overwrite
                $new_file_name = uniqid('', true) . '.' . $file_ext;

                // file directory
                $file_destination = '../picture/' . $new_file_name;

                // move file to directory
                move_uploaded_file($file_tmp, $file_destination);

                $conn = new mysqli("db","root","root","laboratory_system");// Create connection
                if ($conn->connect_error){die("Connection failed: " . $conn->connect_error);}// Check connection

                // SQL insert statement
                $sql = "INSERT INTO engineering_lab (image) VALUES ('$new_file_name')";

                if ($conn->query($sql) === TRUE) {
                    echo "File uploaded and saved to database successfully.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            } else {
                echo "File size is too large.";
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "อนุญาติเฉพาะไฟล์ 'jpg', 'jpeg', 'png', 'gif', 'webp' เท่านั้น";
    }
}

?>

<!-- HTML form -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>