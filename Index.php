<?php
session_start();

?>

<!DOCTYPE html>
<html>
<body>
    <div id = "DynamicContent">
        <?php
            require_once('includes/NavMenu.php');
            require_once('includes/DBConnect.php');
            $page = $_REQUEST['page']??"null";
            switch ($page) {
                case "Signup":
                    require_once('includes/Signup.php');
                    break;
                case "Login":
                    require_once('includes/Login.php');
                    break;
                case "Home":
                    echo "Home Page";
                    break;
                case "Gallery":
                    require_once('includes/Gallery.php');
                    break;
                case "CsvUploader":
                    require_once('includes/CsvUploader.php');
                    break;
                case "DieRoller":
                    require_once('includes/DieRoller.php');
                    break;
                case "NumberConverter":
                    require_once('includes/NumberConverter.php');
                    break;
                case "Logout":
                    session_destroy();
                    echo '<script>alert("You have logged out!");</script>';
                    session_start();
                    echo '<script>window.location.replace("index.php);</script>';
                    break;

                default:
                    echo "Home Page";
            }
        ?>
    </div>
</body>
</html>






