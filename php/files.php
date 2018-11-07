<?php 

 //echo "<pre>";
 //print_r($_FILES);
 //echo "</pre>";

$extensions = array("jpeg","jpg","png","pdf","doc","docx","mp3");
$maxFileSize = 10485760;
$filesToAttach = array();
$errors = array();

if (empty($_FILES)) {
  foreach ($_FILES as $key => $value) {
    
    
    $fileExt = explode('.',$_FILES[$key]['name']);
    $fileExt = end($fileExt);
    $fileExt = strtolower($fileExt);
    $fileName = basename($_FILES[$key]['name']);
    $fileName = preg_replace("/\.[^.]+$/","",$fileName);
    $randomNumber = uniqid();

    if ($_FILES[$key]['size'] > 0) {
      if (!in_array($fileExt , $extensions )) {
        $errors[] = "Нерерный формат файла!";
      }
  
      if ($_FILES[$key]['size'] > $maxFileSize) {
        $errors[] = "Допустимый размер файла 10Мб!";
      }
  
      if (!empty($errors)) {
        print_r($errors);
        exit();
      }
    }
    

    $filePath = '../images/' . $randomNumber . "." . $fileExt;
    move_uploaded_file($_FILES[$key]['tmp_name'],$filePath);

    $filesToAttach[$_FILES[$key]['name']] = $filePath;

  }
}

?>