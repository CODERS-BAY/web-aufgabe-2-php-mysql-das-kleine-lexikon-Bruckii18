<?php
$title = $_POST['title'];
$teaser = $_POST['teaser'];
$description = $_POST['description'];

if($_FILES) {
    $file = $_FILES['fileUpload']['name'];
} else {
    $file = NULL;
}

$target_dir = "../upload-img/";
$uploadOK = 1;
$target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//check if image file is an actual image or fake
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileUpload"]["temp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOK = 1;
    } else {
        echo "File in not an image.";
        $uploadOK = 0;
    }
}

//Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOK = 0;
}
//Check if $uploadOK is set to 0 by an error
if ($uploadOK == 0) {
    echo "Sorry, your file was not uploaded.";
//if everything is ok, try to upload the file
} else {
    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename($_FILES["fileUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
// echo $target_file, $imageFileType;
include('login.inc.php');

$stmt = $con->prepare("INSERT INTO content(title, teaser, description, imgpath) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $title, $teaser, $description, $file);
// $title = $title;
// $teaser = $teaser;
// $description = $description;
// $imgpath = $imgpath;
// var_dump($stmt);

$stmt->execute();
$stmt->close();
$con->close();

//redirect
if(isset($_SERVER["HTTP_REFERER"])) {
    header("Location: {$_SERVER["HTTP_REFERER"]}");
}