<?php

//insert the user's data into the users table of the DB
//if everything is successful, redirect them to the login page.
//if there is an error, redirect back to the signup page with a friendly message

session_start();
require_once __DIR__ . "/../models/user.php"; // It wont work unless I do this..
require_once __DIR__ . "/../connect.php"; // Hope this doesnt make it not work for you......
require_once __DIR__ . "/../utils/ActionUtils.php";

main();


// Function Covers the lifecycle of this service
function main(): void
{
    global $con;
    // Make sure all guard clauses are met.
    initialize();
    // Try to get User from the POST
    $user = getUserFromPost();
    // Upload the user to the db.
    sendUserToDb($con, $user);
    // Why do you have signup capitalized but not login??
    ActionUtils::redirectAndClose("login.php");
    exit;
}

// Function will add a user to the database if they pass all guards.
function sendUserToDb(mysqli $dbRef, User $userToAdd): void
{
    // Verify they do not exist in the DB already.
    // Could also do this for email...
    if (IsScreenNameTaken($dbRef, $userToAdd->getScreenName())) {
        ActionUtils::redirectAndClose("Signup.php", "That Screen Name is Taken");
    }
    if (!PasswordsAreSame($userToAdd)) {
        ActionUtils::redirectAndClose("Signup.php", "Passwords must match");
    }

    // It makes me sad that url and description dont have defaults..
    $query = "INSERT INTO `users`(
        `first_name`, `last_name`, `screen_name`, `password`, `address`,
        `province`, `postal_code`, `contact_number`, `email`, `location`, `url`, `description`)
    VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '', '')";
    $stmt = $dbRef->prepare($query);
    $firstName   = $userToAdd->getFirstName();
    $lastName    = $userToAdd->getLastName();
    $screenName  = $userToAdd->getScreenName();
    $passHash = password_hash($userToAdd->getPassword(), PASSWORD_DEFAULT);
    $address     = $userToAdd->getAddress();
    $province    = $userToAdd->getProvince();
    $postalCode  = $userToAdd->getPostalCode();
    $phone       = $userToAdd->getPhone();
    $email       = $userToAdd->getEmail();
    $location    = $userToAdd->getLocation();
    $stmt->bind_param(
        "ssssssssss",
        $firstName,
        $lastName,
        $screenName,
        $passHash,
        $address,
        $province,
        $postalCode,
        $phone,
        $email,
        $location
    );
    if (!$stmt->execute()) {
        $stmt->close();
        ActionUtils::redirectAndClose("Signup.php", "Account could not be created.");
    }
    $stmt->close();
}

// Function returns a boolean of if a screen name is taken or not.
// {Param 1}: mysqli = Connection Refererence.
// {Param 2}: name = Screen Name to Check.
function IsScreenNameTaken(mysqli $mysqli, string $name): bool
{
    $query = "SELECT * FROM users WHERE screen_name = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $does_exist = $result->num_rows > 0;
    $stmt->close();
    return $does_exist;
}
function PasswordsAreSame(User $user): bool
{
    return $user->getPassword() === $user->getConfirmPassword();
}

// Function Handles Initialization of the service
function initialize(): void
{
    // Make sure we arrived here via post.
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        ActionUtils::redirectAndClose("Signup.php", "How did you get there?");
    }
}

// Function Creates a user object from the POST values sent in.
function getUserFromPost(): User
{
    $newUser = new User();
    try {
        $newUser->setFirstName($_POST["firstName"]);
        $newUser->setLastName($_POST["lastName"]);
        $newUser->setScreenName($_POST["screenName"]);
        $newUser->setPassword($_POST["password"]);
        $newUser->setConfirmPassword($_POST["confirmpassword"]);
        $newUser->setAddress($_POST["address"]);
        $newUser->setProvince($_POST["province"]);
        $newUser->setPostalCode($_POST["postalCode"]);
        $newUser->setLocation($_POST["location"]);
        $newUser->setPhone($_POST["phone"]);
        $newUser->setEmail($_POST["email"]);
        return $newUser;
    } catch (\Throwable $th) {
        ActionUtils::redirectAndClose("Signup.php", "There was an error processing your submission: " . $th->getMessage());
    }
}

