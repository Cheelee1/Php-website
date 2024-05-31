<?php
function uploadFile($fileName, $file_ext){
    $target_path = "images";
    $thumb_path = "images/thumbs";

    //Set thumbnail size
    $thumb_width = 200;
    $thumb_height = 160;
    if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $target_path."/". $_FILES['uploadFile']['name']) === FALSE)
        echo "Could not move uploaded file to ".$target_path." ".htmlentities($_FILES['uploadFile']['name'])."<br/>\n";
    else{
        //thumbnail creation
        
        $upload_image = $target_path."/". basename($fileName);  
        $thumbnail = $thumb_path."/".$fileName;
        list($width,$height) = getimagesize($upload_image);
        $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
        switch($file_ext){
            case 'jpg':
            case 'jpeg':
                $source = imagecreatefromjpeg($upload_image);
                break;
            case 'png':
                $source = imagecreatefrompng($upload_image);
                break;
            case 'gif':
                $source = imagecreatefromgif($upload_image);
                break;
            default:
                $source = imagecreatefromjpeg($upload_image);
                break;
        }
        imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
        switch($file_ext){
            case 'jpg' || 'jpeg':
                imagejpeg($thumb_create,$thumbnail,100);
                break;
            case 'png':
                imagepng($thumb_create,$thumbnail,100);
                break;
            case 'gif':
                imagegif($thumb_create,$thumbnail,100);
                break;
            default:
                imagejpeg($thumb_create,$thumbnail,100);
        }
        echo "Successfully uploaded ".$target_path." ".htmlentities($_FILES['uploadFile']['name'])."<br/>\n";
    }
}
