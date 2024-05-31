<html>
    <head>
    <title>Welcome Please Login!</title>
    </head>
    <body>
        <?php
            $username = $_POST["uname"] ?? "";
            $password = $_POST["psw"] ?? "";
        ?>
        <form method ="POST" action ="">
            <label for="uname"><b>Username:</b></label></br>
            <input type="text" placeholder="Enter Username" name="uname" value="<?php echo $username ?>"></br>
            <label for="psw"><b>Password:</b></label></br>
            <input type="password" placeholder="Password" name="psw" value="<?php echo $password ?>"></br>
            <button type="submit" name="submit">Login</button></br>
            <a href="index.php?page=Signup">Click here to sign up!</a>
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
                else{
                    date_default_timezone_set('America/New_York');
                    $timeLog =date('Y-m-d G:i:s');
                    // interacting with DB
                    include("includes\DBConnect.php");
                    $stmt = $pdo ->prepare("SELECT * FROM users WHERE username = ?");
                    // gets full row
                    $stmt->execute([$username]);
                    
                    $row = $stmt->fetch();
                    // verify if password matches password in DB 
                    if (@password_verify($password,$row["password"])){
                        echo "logged in!";
                        $_SESSION["dbuser"] = $username;
                        $_SESSION["dbalevel"] = $row["accessLevel"];
                        $stmt = $pdo ->prepare("INSERT INTO login_log (username, logDate) VALUES(?,?)");
                        $stmt->execute([$username,$timeLog]);
                        header("Location: \index.php");
                    }
                    else{
                        $errors[] = "Login not recognized!";
                    }
                }                
                // prints out all errors
                if(count($errors) > 0){
                    foreach($errors as $error) 
                        echo "</br>$error</br>";
                }


            }

        
        ?>
    </body>
</html>