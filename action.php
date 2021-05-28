<?php
$firstname = $_POST['firstname'];
$lastname  = $_POST['lastname'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$message = $_POST['message'];
if (!empty($firstname) || !empty($lastname) || !empty($email) || !empty($gender) || !empty($country) || !empty($message) )
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "travelmania";
// Create connection
$conn = mysqli_connect ($host, $dbusername, $dbpassword, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From contact Where email = ? Limit 1";
  $INSERT = "INSERT Into contact (firstname , lastname , email , gender , country , message)values(?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssss", $firstname , $lastname , $email , $gender , $country , $message);
      $stmt->execute();
      echo "Thanks for contacting us";
     } 
     else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} 
else {
 echo "All field are required";
 die();
}
?>