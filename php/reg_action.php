<?php
$connection=mysqli_connect("localhost","root","","tech_hunt");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = test_input($_POST['fname']);
    $last_name = test_input($_POST['lname']);
    $email = test_input($_POST['email']);

    $password = $_POST['password'];

    $gender = test_input($_POST['gender']);

    $city = test_input($_POST['city']);

    $country = test_input($_POST['country']);

    $zip = test_input($_POST['zip']);

    $address = test_input($_POST['street_address']);

    $phone = $_POST['phone'];

    if(substr($phone,0,1) == '0')
        $phone = substr($phone,1);

    $phone_code = test_input($_POST['phone_code']);

    $phone += 0;
    $zip += 0;
    $phone_code +=0;


    $query = "SELECT email FROM user_info WHERE email='$email'";

    $result = mysqli_num_rows(mysqli_query($connection,$query));

    if($result != 0)
    {
        die ("Email Already Exists");
        mysqli_close($connection);
    }



    $query = "INSERT INTO user_info
    (email,first_name, last_name, phone_code,phone, gender, password, address, city, zip, country)
    VALUES
    ('$email','$first_name','$last_name',$phone_code,$phone,'$gender', '$password','$address','$city',$zip,'$country')";



    $temp = mysqli_query($connection, $query);
    if ($temp)
        echo "Uploaded";
    else
        die("Query Failed");

    mysqli_close($connection);

}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>