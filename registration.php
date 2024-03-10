<?php
session_start();

// Function to validate username format
function isValidUsername($username) {
    // Username should contain only letters, numbers, underscores, and hyphens
    return preg_match('/^[a-zA-Z0-9_-]+$/', $username);
}

$errors = [];

if (isset($_SESSION["webprog"])) {
    header("Location: contact.php");
    exit();
}

require_once "database.php";

if (isset($_POST["submit"])) {
    $required_fields = ["lastName", "firstName", "email", "username", "password", "country", "region", "phone_number", "street", "lot_blk", "phaseSubdivision", "barangay", "cityMunicipality", "province"];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = "The $field field is required.";
        }
    }

    $lastName = $_POST["lastName"];
    $firstName = $_POST["firstName"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $country = $_POST["country"];
    $region = $_POST["region"];
    $phone_number = $_POST["phone_number"];
    $street = $_POST["street"];
    $lot_blk = $_POST["lot_blk"];
    $phaseSubdivision = $_POST["phaseSubdivision"];
    $barangay = $_POST["barangay"];
    $cityMunicipality = $_POST["cityMunicipality"];
    $province = $_POST["province"];
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Validations
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (!isValidUsername($username)) {
        $errors[] = "Invalid username. It should contain only letters, numbers, underscores, and hyphens.";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    if ($_POST["password"] !== $_POST["retypePassword"]) {
        $errors[] = "Passwords do not match.";
    }

    $sql = "SELECT * FROM webprog WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        $errors[] = "Email already exists!";
    }

    // If no errors, insert user into database
    if (empty($errors)) {
        $sql = "INSERT INTO webprog (lastName, firstName, email, username, password, country, region, phone_number, street, lot_blk, phaseSubdivision, barangay, cityMunicipality, province) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssssssssssss", $lastName, $firstName, $email, $username, $passwordHash, $country, $region, $phone_number, $street, $lot_blk, $phaseSubdivision, $barangay, $cityMunicipality, $province);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>You are Registered Successfully!</div>";
        } else {
            die("Something went wrong, double check your information.");
        }        
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="logandreg.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.2.js"></script>
    <script>
    $(document).ready(function() {
        // Initialize all the dropdowns with their respective location types
        $('#region').ph_locations({'location_type': 'regions'});
        $('#province').ph_locations({'location_type': 'provinces'});
        $('#cityMunicipality').ph_locations({'location_type': 'cities'});
        $('#barangay').ph_locations({'location_type': 'barangays'});

        // Automatically fill up the regions dropdown upon page load
        $('#region').ph_locations('fetch_list');

        // When a region is selected, populate the province dropdown based on the selected region
        $('#region').on('change', function() {
            $('#province').ph_locations('fetch_list', {region_code: $(this).val()});
        });

        $('#province').on('change', function() {
            $('#cityMunicipality').ph_locations('fetch_list', {province_code: $(this).val()});
        });

        // When a city is selected, populate the barangay dropdown based on the selected city
        $('#cityMunicipality').on('change', function() {
            $('#barangay').ph_locations('fetch_list', {cityMunicipality: $(this).val()});
        });
    });
    </script>
    <script>
    function getFullPhoneNumber() {
        var countryCode = document.getElementById("countryCode").value;
        var phone_number = document.getElementById("phone_number").value;
        var fullPhoneNumber = countryCode + phone_number;
        console.log("Full Phone Number: ", fullPhoneNumber);
        // You can do whatever you want with the full phone number here, such as sending it to a server
    }
    </script>
</head>
<body>
<nav style="width: 100%; height: 85px;">
    <label class="logo">My Personal Website</label>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about_me.php">About Me</a></li>
        <li><a class="active" href="#">Contacts</a></li>
        <li><a href="blog.php">Blog</a></li>
    </ul>
</nav>

<button class="hamburger">
    <div class="bar"></div>
</button>

<nav class="mobile-nav">
    <a href="index.php">Home</a>
    <a href="about_me.php">About Me</a>
    <a class="active" href="login.php">Contacts</a>
    <a href="blog.php">Blog</a>
</nav>

<div class="container" style="margin: 70px auto;">
    <h1 class="form-title">Registration Form</h1>
    <form action="registration.php" method="post">
        <div class="main-user-info">
            <div class="user-input-box">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" placeholder="Last Name"/>
            </div>
            <div class="user-input-box">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" placeholder="First Name"/>
            </div>
            <div class="user-input-box">
                <label for="lot_blk">Lot/Blk:</label>
                <input type="text" id="lot_blk" name="lot_blk" placeholder="Lot/Blk"/>
            </div>
            <div class="user-input-box">
                <label for="street">Street:</label>
                <input type="text" id="street" name="street" placeholder="Street"/>
            </div>
            <div class="user-input-box">
                <label for="phaseSubdivision">Phase/Subdivision:</label>
                <input type="text" id="phaseSubdivision" name="phaseSubdivision" placeholder="Phase/Subdivision"/>
            </div>
            <div class="user-input-box">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email"/>
            </div>
            <div class="user-input-box">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Username"/>
            </div>
            <div class="user-input-box">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password"/>
            </div>
            <div class="user-input-box">
                <label for="retypePassword">Retype Password:</label>
                <input type="password" id="retypePassword" name="retypePassword" placeholder="Retype Password"/>
            </div>
            <div class="user-input-box">
                <label for="phone_number">Country Code:</label>
                <select id="countryCode" name="countryCode" style="margin-bottom: 10px">
                    <option value="">Select Country Code</option>
                    <option value="+63">PH (+63)</option>
                </select>
                <input type="text" id="phone_number" name="phone_number" placeholder="Enter Phone Number">
            </div>
            <div class="user-input-box">
                <label for="country">Select Country:</label>
                <select id="country" name="country">
                    <option value="">Select Country</option>
                    <option value="PH">Philippines (PH)</option>
                </select>
            </div>  
            <div class="user-input-box">
                <label for="province">Select Province:</label>
                <select id="province" name="province">
                    <option value="">Select Province</option>
                </select>
            </div>
            <div class="user-input-box">
                <label for="region">Select Region:</label>
                <select id="region" name="region" style="width: 100%;">
                    <option value="">Select Region</option>
                </select>
            </div>
            <div class="user-input-box">
                <label for="cityMunicipality">Select City/Municipality:</label>
                <select id="cityMunicipality" name="cityMunicipality">
                    <option value="">Select City/Municipality</option>
                </select>
            </div>
            <div class="user-input-box">
                <label for="barangay">Select Barangay:</label>
                <select id="barangay" name="barangay">
                    <option value="">Select Barangay</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn">Register</button>
            <div class="register-link">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </form>
</div>
</body>
</html>
