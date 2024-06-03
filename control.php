<?php

//Form Operations
//var_dump($_POST);

//strip_tags, script, 
function cleanData($data = '') {
    $content = strip_tags($data);
    $content = htmlspecialchars($content);
    $content = addcslashes($content);
    $content = addcslashes(htmlspecialchars(strip_tags($data)));
    
    return $content;
}


$name = cleanData($_POST['name']);
$surname = cleanData($_POST['surname']);
$gender = cleanData($_POST['gender']);
$city = cleanData($_POST['city']);
$hobby = cleanData($_POST['hobby']);
$message = cleanData($_POST['message']);


$nameSurname = $name + $surname;
$hobbies = implode('-', $hobby);

if (empty($nameSurname)) {
    echo "<script>alert('Enter your name and surname';window.location.href='index.html';</script>";
    header("Location:index.html");
    //header(Refresh:5; Url=index.html) or die ("Enter Name Surname !);
}

echo "
Name Surname : $nameSurname <br>
Gender : $gender <br>
City : $city <br>
Hobies : $hobbies <br>
Message : $message <br>
";

//Error Control 
if ($file["error"<>0]) {
    echo "<script>alert('File Upload Error!'; window.location.href='index.html'; </script>";
    exit();
}

//Form Upload Operations
//var_dum($_FILES["file]);
//name, type, tmp_name, error, size

$file = $_FILES ["file"];
$permissions = ["application/pdf", "image/png", "image/jpeg"];

if (!in_array($file["type"], $permissions)) {
    echo "<script>alert('Wrong File Format!'; window.location.href='index.html'; </script>";
}
else {
    echo "Saved!!";
}

//Size control
$fileSize = 2*1024*1024;
if ($file["size"] > $fileSize) {
    $sizeOfFile = $file["size"]/(1024/1024);
    echo "<script>alert('Too High File Size! : $sizeOfFile'; window.location.href='index.html'; </script>";
}
else {
    echo "Saved!!";
}


//Cleaning the Turkish Letters
function renameFile($name = '') {
    $findLetters = ["ü", "Ü", "ğ", "Ğ", "ı", "İ", "ö", "Ö", "ş", "Ş", "ç", "Ç", " "];
    $changeLetters = ["o", "O", "g", "G", "i", "I", "o", "O", "s", "S", "c", "C","-"];
    $naming = str_replace($findLetters, $changeLetters, mb_strtolower($naming));
}


$temporaryName = $file["tmp_name"]; //Çarşamba Günü.pdf
$uploadedName = renameFile($file["name"]); //CarsambaninSifasi.pdf
$explodingFile = explode('.',$uploadedName);
$naming = $explodingFile[]
$extension 0 $explodingFile[1];

if (move_uploaded_file($temporaryName, $uploadedName)) {
    echo "File Uploaded!";
} else {
    echo "File Couldn't Upload!";
}




?>