<?php
session_start();

main();
function main(): void
{
    if (!isset($_SESSION["success"])) {
        redirectAndClose("login.php");
    }
    clearSession();
    redirectAndClose("index.php");
}

function clearSession():void {
    $_SESSION["success"] = false;
    unset($_SESSION["success"]);
    unset($_SESSION["SESS_FIRST_NAME"]);
    unset($_SESSION["SESS_LAST_NAME"]);
    unset($_SESSION["SESS_MEMBER_ID"]);
}

function redirectAndClose(string $location, string $message = ""): never
{
    if ($message !== "") {
        $_SESSION["flash_error"] = $message;
    }
    header("Location: ../" . $location);
    exit;
}
//verify the user's login credentials. if they are valid redirect them to index.php/
//if they are invalid send them back to login.php

