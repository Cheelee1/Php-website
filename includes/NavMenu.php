<?php
if(!isset($_SESSION["dbuser"])){
    $_SESSION["dbuser"] = "Guest";
}


?>

<style>
body{
    font-family: Arial, Helvetica, sans-serif;
    font-weight: boldl
}
.navbar{
    overflow: hidden;
    background-color: #66FF66;
}
.navbar a{
    float: left;
    font-size: 25px;
    color: Black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}
.dropdown {
    float: left;
    overflow: hidden;
}
.dropdown .dropbtn {
    font-size: 25px;  
    border: none;
    outline: none;
    color: Black;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}
.navbar a:hover, .dropdown:hover .dropbtn {
    background-color: #CCFFFF;
    font-size: 27px;
}
.dropdown-content {
    display: none;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}
.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
    
  background-color: #CCFFFF;
}

.dropdown:hover .dropdown-content {
   
    display: block;
}
.right-container{
    float:right;
}
</style>
<html>
    <body>
        <div class = "navbar"id = "NavMenu">
            <div class = "right-container">
                <a href="index.php?page=Signup">Sign up</a>
                <a href="index.php?page=Login">Login</a>
                <a href="index.php?page=Logout">Logout</a>     
                <a href="index.php?page=Home"><?php echo $_SESSION['dbuser']; ?></a>       
            </div>

                <a href="index.php?page=Home">Home</a>
                <a href="index.php?page=Gallery">Gallery</a>
                
            <div class="dropdown">
                <button class="dropbtn">MiscTools</button>
                <div class="dropdown-content">
                    <a href="index.php?page=DieRoller">DieRoller</a>
                    <a href="index.php?page=NumberConverter">Number Converter</a>
                    <a href="index.php?page=CsvUploader">CsvUploader</a>
                </div>
            </div> 
        </div>
    </body>

</html>

