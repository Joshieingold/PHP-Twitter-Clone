<?php
session_start();
require_once __DIR__ . "/../models/user.php"; // It wont work unless I do this..
require_once __DIR__ . "/../connect.php"; // Hope this doesnt make it not work for you......

main();

function main(): void
{
    global $con;
    initialize();
    $postedUser = getUserFromPost();
    $username = $postedUser->getScreenName();
    $pass = $postedUser->getPassword();
    if (!validateAccount($con, $username, $pass )) {
        redirectAndClose("login.php", "Incorrect Username or password");
    }
    $_SESSION["success"] = true;
    PassUserToSession($con, $postedUser);
    redirectAndClose("index.php");
}

function PassUserToSession(mysqli $dbRef, User $goodUser): void {
    // THIS SHOULD NOT BE HIT
    if (!isset($_SESSION["success"]) || $_SESSION['success'] == false) {
        return;
    }
    $fullUser = getUserFromUsername($dbRef, $goodUser->getScreenName());
    $_SESSION["SESS_FIRST_NAME"] = $fullUser->getFirstName();
    $_SESSION["SESS_LAST_NAME"] = $fullUser->getLastName();
    $_SESSION["SESS_MEMBER_ID"] = $fullUser->getId();
}

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
function getUserFromPost(): User
{
    $newUser = new User();
    try {
        $newUser->setScreenName($_POST['username']);
        $newUser->setPassword($_POST['password']);
        return $newUser;
    } catch (\Throwable $th) {
        RedirectAndClose("login.php", "There was an error processing your submission: " . $th->getMessage());
    }
}

function initialize(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        redirectAndClose("login.php", "How did you get there?");
    }
    unset($_SESSION['success']);
}


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

// Function Redirects user to the signup page and exits
function redirectAndClose(string $location, string $message = ""): never
{
    if ($message !== "") {
        $_SESSION["flash_error"] = $message;
    }
    header("Location: ../" . $location);
    exit;
}
