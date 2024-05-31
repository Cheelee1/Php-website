<html>
    <head>
    <title>Sign up page</title>
    </head>
    <body>
        <?php
            $username = $_POST["uname"] ?? "";
            $password = $_POST["psw"] ?? "";
            $conPassword = $_POST["conpsw"] ?? "";
        ?>
        <form method ="POST" action ="">
            <label for="uname"><b>Username:</b></label></br>
            <input type="text" placeholder="Enter Username" name="uname" value="<?php echo $username ?>"></br>

            <label for="psw"><b>Password:</b></label></br>
            <input type="password" placeholder="Password" name="psw" value="<?php echo $password ?>"></br>

            <label for="psw"><b>Confirm Password:</b></label></br>
            <input type="password" placeholder="Confirm Password" name="conpsw" value="<?php echo $conPassword ?>"></br>
            <button type="submit" name="submit">sign up</button></br>
            <label>
        </form>

        <?php
            $usernameRegex = "/^[A-Za-z0-9_]*$/";
            $pswRegex = "/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W_])(?=\S*\s{0})\S*$/";
            if(isset($_POST['submit'])){
                $errors = [];
                // checks if they are empty
                if($username == ""){
                    $errors[] = "Username is empty!";
                }
                else if($password == ""){
                    $errors[] = "Password is empty!";
                }
                else if($conPassword == ""){
                    $errors[] = "Please confirm password!";
                }
                // password must match
                else if($password != $conPassword){
                    $errors[] = "Passwords must match!";
                }
                // username regex validation
                if(!preg_match($usernameRegex,$username)){
                    $errors[] = "Username can only contain letters, number, and underscores!";
                }                
                // validates lowercase letters
                if(!preg_match("/(?=\S*[a-z])/",$password)){
                    $errors[] = "Password must have at least one lowercase letter!";

                }
                // validates uppercase letters
                if(!preg_match("/(?=\S*[A-Z])/",$password)){
                    $errors[] = "Password must have at least one capitol letter!";
                }           
                // validates lowercase letters         
                if(!preg_match("/(?=\S*[\d])/",$password)){
                    $errors[] = "Password must have at least one number!";

                }
                // validates lowercase letters  
                if(!preg_match("/(?=\S*[\W_])/",$password)){
                    $errors[] = "Password must have at least one special character!";

                }
                // validates whitespaces letters
                if(!preg_match("/(?=\S*\s{0})\S*$/",$password)){
                    $errors[] = "Password cannot contain white spaces!";

                }
                // validates length of username
                if(strlen($username)< 6) {
                    $errors[] = "Username is too short!";

                }
                else if(strlen($username) > 12) {
                    $errors[] = "Username is too long!";

                }
                // validates length of password
                if(strlen($password)< 8) {
                    $errors[] = "Password is too short!";

                }
                else if(strlen($password) > 16) {
                    $errors[] = "Password is too long!";

                }
                // prints out all errors
                if(count($errors) > 0){
                    foreach($errors as $error) 
                        echo "</br>$error</br>";
                }
                // opens a log file and stores each person(s) info
                else{
                    // stores user info in DB 
                    $password =  password_hash($password, PASSWORD_DEFAULT);
                    include("includes\DBConnect.php");
                    date_default_timezone_set('America/New_York');
                    $stmt = $pdo ->prepare("INSERT INTO users (username,password, accessLevel) VALUES(?,?,?)");
                    $stmt->execute([$username,$password,0]);
                    header("Location: \index.php?page=Login");
                }

            }

        
        ?>
    </body>
</html>