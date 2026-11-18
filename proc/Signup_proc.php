<?php
//insert the user's data into the users table of the DB
//if everything is successful, redirect them to the login page.
//if there is an error, redirect back to the signup page with a friendly message

main();


// Function Covers the lifecycle of this service
function main(): void
{
    //TODO:
    $dbRef = "";
    // Make sure all guard clauses are met.
    initialize();
    // Try to get User from the POST
    $user = getUserFromPost();
    // Upload the user to the db.
    sendUserToDb($dbRef, $user);
    exit;
}

// Function will add a user to the database if they pass all guards.
function sendUserToDb(mysqli $dbRef, User $userToAdd): void
{
    // Verify they do not exist in the DB already.
    // Could also do this for email...
    if (IsScreenNameTaken($dbRef, $userToAdd->getScreenName())) {
        RedirectBack();
    }
    if (!PasswordsAreSame($userToAdd)) {
        RedirectBack();
    }
    
    $query = "INSERT INTO `users`(
        `first_name`, `last_name`, `screen_name`, `password`, `address`,
        `province`, `postal_code`, `contact_number`, `email`, `location`,)
    VALUES( '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?')";
    $passHash = password_hash($userToAdd->getPassword(), PASSWORD_DEFAULT);
    $stmt = $dbRef->prepare($query);
    // PHP Hates what I have done
    // WHY DO YOU HATE PHP JOSH?!?
    // CAUSE I JUST WANT TO USE THE PROPERTY VALUES ITS NOT 'REALLY' A METHOD
    $stmt->bind_param("ssssssssss",
        $userToAdd->getFirstName(),
        $userToAdd->getLastName(),
        $userToAdd->getScreenName(),
        $passHash,
        $userToAdd->getAddress(),
        $userToAdd->getProvince(),
        $userToAdd->getPostalCode(),
        $userToAdd->getPhone(),
        $userToAdd->getEmail(),
        $userToAdd->getLocation()
    );

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
    $does_exit = $result->num_rows > 0;
    $stmt->close();
    return $does_exit;
}
function PasswordsAreSame(User $user): bool {
    return $user->getPassword() === $user->getConfirmPassword();
}

// Function Handles Initialization of the service
function initialize(): void
{
    // Make sure we arrived here via post.
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        RedirectBack();
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
        $newUser->setConfirmPassword($_POST["confirmPassword"]);
        $newUser->setAddress($_POST["address"]);
        $newUser->setProvince($_POST["province"]);
        $newUser->setPostalCode($_POST["postalCode"]);
        $newUser->setLocation($_POST["location"]);
        $newUser->setPhone($_POST["phone"]);
        $newUser->setEmail($_POST["email"]);
        return $newUser;
    } catch (\Throwable $th) {
        RedirectBack();
        // Should not get hit but php hates me if I dont put this.
        return new User();
    }
}
// Function Redirects user to the signup page and exits
function RedirectBack(): void
{
    header("Location: ../Signup.php");
    exit;
}

