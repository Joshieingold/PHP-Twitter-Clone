<?php 
//insert the user's data into the users table of the DB
//if everything is successful, redirect them to the login page.
//if there is an error, redirect back to the signup page with a friendly message

$errors = [];
Init();
// Try to get User from the POST
$user = getUserFromPost();


// Function Handles Initialization of the service
function Init(): void {
    // Make sure we arrived here via post.
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../Signup.php");
        exit;
    }
}

// Function Creates a user object from the POST values sent in.
function getUserFromPost(): User {
    $newUser = new User();
    try {
        $newUser->setFirstName($_POST["firstName"]);
        $newUser->setLastName($_POST["lastName"]);
        $newUser->setScreenName( $_POST["screenName"]);
        $newUser->setPassword( $_POST["password"]);
        $newUser->setConfirmPassword( $_POST["confirmPassword"]);
        $newUser->setAddress( $_POST["address"]);
        $newUser->setProvince( $_POST["province"]);
        $newUser->setPostalCode( $_POST["postalCode"]);
        $newUser->setLocation( $_POST["location"]);
        $newUser->setPhone($_POST["phone"]);
        $newUser->setEmail($_POST["email"]);
        return $newUser;
    } catch (\Throwable $th) {
        //TODO: I dont think this works
        $errors[] = $th;
        exit;
    }

}


// Function returns a boolean of if a screen name is taken or not.
// {Param 1}: mysqli = Connection Refererence.
// {Param 2}: name = Screen Name to Check.
function IsScreenNameTaken($mysqli, $name): bool {
    $query = "SELECT * FROM users WHERE screen_name = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $does_exit = $result->num_rows > 0;
    $stmt->close();
    return $does_exit;
}

?>
