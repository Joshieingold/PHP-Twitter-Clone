<?php
session_start();
require_once __DIR__ . "/../models/user.php"; // It wont work unless I do this..
require_once __DIR__ . "/../connect.php"; // Hope this doesnt make it not work for you......
require_once __DIR__ . "/../utils/ActionUtils.php";

main();

// Function Covers the lifecycle of this service
function main(): void
{
    global $con;
    initializePage();
    $postedUser = getUserFromPost();

    // Get the values we need from the posted user
    $username = $postedUser->getScreenName();
    $pass = $postedUser->getPassword();

    // Validates if account is correct with what is in the datbase.
    if (!validateAccount($con, $username, $pass )) {
        ActionUtils::redirectAndClose("login.php", "Incorrect Username or password");
    }

    // User is authorized
    $_SESSION["SUCCESS"] = true;
    PassUserToSession($con, $postedUser);
    ActionUtils::redirectAndClose("index.php");
}

// Make sure we arrived here via post.
function initializePage(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        ActionUtils::redirectAndClose("login.php", "How did you get there?");
    }
    // If user is using this proceedure
    // We dont know if they have suceeded until the rest of the proceedure runs.
    unset($_SESSION['SUCCESS']);
}

/////////////
// Actions //
/////////////

function PassUserToSession(mysqli $dbRef, User $goodUser): void {
    // THIS SHOULD NOT BE HIT
    if (!isset($_SESSION["SUCCESS"]) || $_SESSION['SUCCESS'] == false) {
        return;
    }
    $fullUser = getUserFromUsername($dbRef, $goodUser->getScreenName());
    $_SESSION["SESS_FIRST_NAME"] = $fullUser->getFirstName();
    $_SESSION["SESS_LAST_NAME"] = $fullUser->getLastName();
    $_SESSION["SESS_MEMBER_ID"] = $fullUser->getId();
}

////////////////
// Validation //
////////////////

function validateAccount(mysqli $mysqli, string $name, string $unhashedPass): bool
{
    $query = "SELECT * FROM users WHERE screen_name = ?;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $does_exist = $result->num_rows > 0;
    if (!$does_exist) {
        return false;
    }
    if ($row = $result->fetch_assoc()) {
        $hashedPass = $row['password'];
        if (password_verify($unhashedPass, $hashedPass)) {
            $stmt->close();
            return true;
        }
    }
    $stmt->close();
    return false;
}

////////////////////
// Data retrieval //
////////////////////

// Creates the session user model informed by the database.
function getUserFromUsername(mysqli $dbRef, string $screenName): User {
    $query = "SELECT user_id, first_name, last_name FROM users WHERE screen_name = ?;";
    $stmt = $dbRef->prepare($query);
    $stmt->bind_param("s", $screenName);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $user = new User();
        $firstName = $row['first_name'];
        $lastName = $row['last_name'];
        $id = $row['user_id'];
        $user->setId($id);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $stmt->close();
        return $user;
    }
    $stmt->close();
    return new User();
}

// Creates a lightweight user model based on the login information
function getUserFromPost(): User
{
    $newUser = new User();
    try {
        $newUser->setScreenName($_POST['username']);
        $newUser->setPassword($_POST['password']);
        return $newUser;
    } catch (\Throwable $th) {
        ActionUtils::redirectAndClose("login.php", "There was an error processing your submission: " . $th->getMessage());
    }
}
