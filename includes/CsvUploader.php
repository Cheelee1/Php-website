<html>
    <head>
        <title>CsvViewer</title>
    </head>
<body>
    <form method = "post" enctype = "multipart/form-data" action="">
    <input type = "file" name = "uploadCsv" value="Select File"/>
    <input type = "submit" name = "submit" value = "Upload"/></br>
    <input type="checkbox" id="check" name="check" value="">
    <label for="check">Need Header? Check the box.</label><br>
    </form>
<?php
    if(isset($_POST['submit'])){
        $errors = array();
        if(isset($_FILES['uploadCsv'])){
            $dir = "CsvFolder";
            $file = $_FILES['uploadCsv']['name'];
            $type = "";
            $temp = "";
            // gets file ext by str slicing
            for ($i = 0; $i < strlen($file);$i++){
                if ($file[$i] == "."){
                    $temp = $i;
                    $type = substr($_FILES['uploadCsv']['name'],$temp+1);
                }
            }
            switch($type){
                case 'csv':
                    // uploads csvfile to a directory
                    if(move_uploaded_file($_FILES['uploadCsv']['tmp_name'], $dir."/". $file)){
                        // open up our file so we can extract data
                        $myfile = fopen($dir."/".$file, "r") or die("Unable to open file!");
                        // reads all the data
                        $myfile = fread($myfile,filesize($dir."/".$file));
                        // gets the rows
                        $myfile = explode("\n", $myfile);
                        // checkbox for header or not
                        if(isset($_POST['check'])){
                            // if yes, check box is insert into the table
                            $header = "ID#,First Name,Last Name,Phone,SSN,Address,Rank,Salary";
                            $header = explode(",", $header);
                            echo "<table border=1px>";
                            foreach($header as $element){
                                echo "<td>$element</td>";
                            }                         
                            foreach($myfile as $element){
                                $element = explode(",", $element);
                                echo "<tr>";
                                foreach($element as $attribute){
                                    echo "<td>$attribute</td>";

                                }
                                echo "</tr>"; 
                            }
                            echo"</table>";
                            break;
                        }
                        else{
                            // if no, the table will be displayed
                            echo "<table border=1px>";             
                            foreach($myfile as $element){
                                $element = explode(",", $element);
                                echo "<tr>";
                                foreach($element as $attribute){
                                    echo "<td>$attribute</td>";
                                }
                                echo "</tr>";
                            }
                            echo"</table>";
                            break;
                        }
                    }     
                case 'log':
                    // uploads csvfile to a directory
                    if(move_uploaded_file($_FILES['uploadCsv']['tmp_name'], $dir."/". $file)){
                        // open up our file so we can extract data
                        $myfile = fopen($dir."/".$file, "r") or die("Unable to open file!");
                        // reads all the data
                        $myfile = fread($myfile,filesize($dir."/".$file));
                        // gets the rows
                        $myfile = explode("\n", $myfile);
                        // checkbox for header or not
                        if(isset($_POST['check'])){
                            // if yes, check box is insert into the table
                            $header = "Username,Password(hash),Date and Time";
                            $header = explode(",", $header);
                            echo "<table border=1px>";
                            foreach($header as $element){
                                echo "<td>$element</td>";
                            }                         
                            foreach($myfile as $element){
                                $element = explode(",", $element);
                                echo "<tr>";
                                foreach($element as $attribute){
                                    echo "<td>$attribute</td>";

                                }
                                echo "</tr>"; 
                            }
                            echo"</table>";
                            break;
                        }
                        else{
                            // if no, the table will be displayed
                            echo "<table border=1px>";             
                            foreach($myfile as $element){
                                $element = explode(",", $element);
                                echo "<tr>";
                                foreach($element as $attribute){
                                    echo "<td>$attribute</td>";
                                }
                                echo "</tr>";
                            }
                            echo"</table>";
                            break;
                        }
                    }     
                default:
                    $errors[] = "File not uploaded!";                
                    break;
            }
        }
        // prints all our errors at the end
        if(count($errors) > 0){
            foreach($errors as $error) 
                echo "</br>$error</br>";
        }           
    }
?>
</body>
</html>