<html>

    <body>
    <?php
    //Declares variables
        $numInput = $_POST["number"] ?? 0;
        $inputR = $_POST["input"] ?? NULL;

    ?>
    
        <form method ="POST" action ="Index.php?page=NumberConverter">
        Enter a number to convert:<input name = "number" type ="text" value ="<?php echo $numInput?>"/></br>
        <p>Select current data type<a></br>
        <input type="radio" name="input" value="decimal">Decimal</br>
        <input type="radio" name="input" value="binary">Binary</br>
        <input type="radio" name="input" value="octal">Octal</br>
        <input type="radio" name="input" value="hexidecimal">Hexidecimal</br>
        <input type = "submit" value ="Convert!" name ="submit">
        </form>
    <?php

    if (isset($_POST["submit"])){
        $errors = array();
        //checks if the input is a valid entry for each data type
        for ($i = 0; $i < strlen($numInput);$i++){
            if ($inputR == "decimal"){
                if (!is_numeric($numInput[$i])){
                    $errors[] = "Not a decimal!";
                    break;
                }
            }
            if ($inputR == "binary"){
                if(!is_numeric($numInput[$i])){
                    $errors[] = "Not a binary!";
                    break;
                }
                $temp = intval($numInput[$i]);

                if ($temp > 1){

                    $errors[] = "Not a binary!";
                    break;
                }
            }     
            if ($inputR == "octal"){
                if(!is_numeric($numInput[$i])){
                    $errors[] = "Not an octal!";
                    break;
                }
                $temp = intval($numInput[$i]);
                if ($temp > 7){
                    $errors[]= "Not an Octal!";
                    break; 
                }
            }
            if($inputR == "hexidecimal") {
                $temp = ($numInput[$i]);
                //if 0-9 a-f(A-F) is not in our hex error
                if(!preg_match('/^[0-9,a-f,A-F]*$/', $temp)){
                    $errors[] = "Not a hexidecimal!";
                    break;
                }
            }
        }
        // handles all the input errors and prints out the converted values
        if(Empty($numInput)){
            $errors[] ="Input is empty!";
        }
        elseif(is_numeric($numInput)){
            if($numInput <= 0){

                $errors[] = "input cannot be negative!";
            }
        }
        if(count($errors) > 0){
            foreach($errors as $error) 
                echo "</br>$error</br>";
        }        
        elseif($inputR == "decimal"){
            echo "</br>{$numInput} in decimal is ";
            echo ($numInput);
            echo "</br>{$numInput} in binary is ";
            echo bindec($numInput);
            echo "</br>{$numInput} in octal is ";
            echo decoct($numInput);
            echo "</br>{$numInput} in hexidecimal is ";
            echo dechex($numInput);
        }        
        elseif($inputR == "binary"){
            echo "</br>{$numInput} in decimal is ";
            echo bindec($numInput);
            echo "</br>{$numInput} in binary is ";
            echo ($numInput);
            echo "</br>{$numInput} in octal is ";
            echo ($numInput);
            echo "</br>{$numInput} in hexidecimal is ";
            echo bin2hex($numInput);
        }
        elseif($inputR == "octal"){
            echo "</br>{$numInput} in decimal is ";
            echo octdec($numInput);
            echo "</br>{$numInput} in binary is ";
            echo decbin(octdec($numInput));
            echo "</br>{$numInput} in octal is ";
            echo ($numInput);
            echo "</br>{$numInput} in hexidecimal is ";
            echo dechex($numInput);
        }
        elseif($inputR == "hexidecimal"){
            echo "</br>{$numInput} in decimal is ";
            echo hexdec($numInput);
            echo "</br>{$numInput} in binary is ";
            echo decbin(hexdec($numInput));
            echo "</br>{$numInput} in octal is ";
            echo ($numInput);
            echo "</br>{$numInput} in hexidecimal is ";
            echo  hexdec($numInput);
        }
    }
    ?>
    </body>
</html>