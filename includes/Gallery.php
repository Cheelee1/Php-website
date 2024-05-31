
<html>
<head>
    <title> Photo Gallery</title>
</head>
<body>
<form method = "post" enctype = "multipart/form-data" action="">
    <input type = "file" name = "uploadFile"/>
    <input type = "submit" name = "submit" value = "Upload">    
    <input type = "submit" name = "show" value = "Show Thumbnails">
    <input type = "submit" name = "delete" value = "Delete!">
</form>
<?php
require_once('ThumbnailCreator.php');
    $dir = "images";
    $dir2 = "images/thumbs";
    if(isset($_POST['submit'])){
        $errors = array();
        if(Empty($_FILES['uploadFile'])){
            $errors[] = "No file selected!";
        } 
        // if file is selected, loop through the file name and finds the "."
        // once it finds it, it substrings anything after it ($type="") 
        if(isset($_FILES['uploadFile'])){
            $file = $_FILES['uploadFile']['name'];
            $type = "";
            $temp = "";
            for ($i = 0; $i < strlen($file);$i++){
                if ($file[$i] == "."){
                    $temp = $i;
                    $type = substr($_FILES['uploadFile']['name'],$temp+1);
                }
            }
            switch($type){
                case 'jpg':
                case 'jpeg':
                case 'png':
                case 'gif':
                    uploadFile($file,$type);
                    break;
                default:
                    $errors[] = "Cannot upload file type!";
                    break;
            }
        }
        if(count($errors) > 0){
            foreach($errors as $error) 
                echo "</br>$error</br>";
        }        
    }
    //opens dir and reads each file.
    //displays each thumbnail as hrefs
    if(isset($_POST['show'])){
        $DirOpen = opendir($dir2);
        while($CurFile = readdir($DirOpen)){
            
            if((strcmp($CurFile,'.') != 0) && (strcmp($CurFile,'..') != 0))
            echo "<a href='images/$CurFile'><img src='images/thumbs/$CurFile'></a>";
                
        }
        closedir($DirOpen);  
    }
    // deletes the file in both directories
    if(isset($_POST['delete'])){
        $DirOpen = opendir($dir2);
        while($CurFile = readdir($DirOpen)){
            if((strcmp($CurFile,'.') != 0) && (strcmp($CurFile,'..') != 0)){
                if((strcmp($CurFile,$_FILES['uploadFile']['name']) != 0)){
                    unlink($dir2."/".$CurFile);
                    unlink($dir."/".$CurFile);
                   
                }                   
            }

        }
        echo "Uploads deleted.";
        closedir($DirOpen); 
    }

         
?>


</body>


</html>