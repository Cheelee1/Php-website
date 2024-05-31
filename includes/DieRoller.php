<?php
function DieRoller($times, $sides){
    $total = 0;
    for ($i = 0; $i < $times; $i++){
        $total += mt_rand(1,$sides);
    }
    return $total;
}
$times = $_POST["times"] ?? 1;
$sides = $_POST["sides"] ?? 6;

?>
<form method ="POST" action ="Index.php?page=DieRoller">
Times:<input name = "times" type ="text" value ="<?php echo $times?>"/></br>
Sides:<input name = "sides" type ="text" value ="<?php echo $sides?>"/></br>
<input type = "submit" value ="Roll!" name ="submit">
</form>

<?php
if (isset($_POST["submit"])){
    $errors = array();

//verify if times is empty
//verify its a number
//verfy its pos
    if(Empty($times)){
        $errors[] ="Times is empty!";
    }
    elseif(is_numeric($times)){
        if($times <= 0){
            $errors[] = "Times cannot be negative!";
        }

    }
    else{
        $errors[] = "Times is not a number!";
    }
//same for sides
    if(Empty($sides)){
        $errors[] ="Sides is empty!";
    }
    elseif(is_numeric($sides)){
        if($sides <= 0){
            $errors[] = "Sides cannot be negative!";
        }
    }
    else{
        $errors[] = "Sides is not a number!";
    }

//each check if fails append error message
    if(count($errors) > 0){
        foreach($errors as $error) 
            echo "$error</br>";
    }
    else{
        echo "You rolled a {$times}d{$sides}</br>";
        echo DieRoller($times,$sides);
    }
    
}
?>






