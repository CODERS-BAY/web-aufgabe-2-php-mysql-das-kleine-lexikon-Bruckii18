<?php
define('SECURE', true);
include('../inc/login.inc.php');

if (!empty($_POST)) {
    $output = '';
    $message = '';
    $id = $_POST['entry_id'];
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $teaser = mysqli_real_escape_string($con, $_POST["teaser"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);

    if ($_POST["entry_id"] != '') {

        if ($_FILES["fileUpdate"]['size'] != 0) {
            $file = $_FILES['fileUpdate']['name'];
            $checkFile = $con->prepare("SELECT imgpath FROM content WHERE id = ?");
            $checkFile->bind_param('s', $id);
            $checkFile->execute();
            $checkFile->bind_result($imgpath);
            $checkFile->fetch();
            $checkFile->free_result();
            $target_dir = "../upload-img/";
            if (file_exists($target_dir . $imgpath)) {
                unlink($target_dir . $imgpath);
            }
            $uploadOK = 1;
            $target_file = $target_dir . basename($_FILES["fileUpdate"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is an actual image file or fake
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileUpdate"]["temp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOK = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOK = 0;
                }
            }

            //Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF are allowed.";
                $uploadOK = 0;
            }
            // Check if $uploadOK is set to 0 by an error
            if ($uploadOK == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload the file 
            } else {
                if (move_uploaded_file($_FILES["fileUpdate"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["fileUpdate"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file";
                }
            }
        } else {
            $file = NULL;
        }

        $stmt = $con->prepare("UPDATE content SET title=?, teaser=?, imgpath=?, description=? WHERE id=?");

        if (false === $stmt) {
            // and since all the following operations need a valid/ready statement object
            // it doesn't make sense to go on
            // you might want to use a more sophisticated mechanism than die()
            // but it's only an example
            die('prepare() failed: ' . htmlspecialchars($con->error));
        }

        $rc = $stmt->bind_param('sssss', $title, $teaser, $imgpathnew, $description, $id);
        $id = $id;
        $title = $title;
        $teaser = $teaser;
        $description = $description;
        $imgpathnew = $file;
        // bind_param() can fail because the number of parameter doesn't match the placeholders in the statement
        // or there's a type conflict (?), or ....
        if (false === $rc) {
            //again execute() is useless if u can't bind the parameters. Bail out somehow
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
        }
        // EXecute the prepared Statement
        $result = $stmt->execute();
    }
    if ($result) {
        $output .= include('dataTable.inc.php');
    }
    echo $output;
}

?>