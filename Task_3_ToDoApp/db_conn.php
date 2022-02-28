<!-- PDO is a php data objects -->
<?php 

$sName = "localhost:3307";
$uName = "root";
$pass = "";
// database name in phpadmin
$db_name = "to_do_list";

try {
  // creating a PDO instance
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);
                    
    //if there is an error in SQL, PDO will throw no exceptions; PDO will issue no warnings; it will simply return false. 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
}
