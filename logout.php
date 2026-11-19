<?php
session_start();

main();

function main(): void
{
    if (!isset($_SESSION["SUCCESS"])) {
        clearSession();
        // I cant use my helper :(
        header("Location: login.php");
    }
    clearSession();
    header("Location: login.php");
}

function clearSession():void {
    $_SESSION["SUCCESS"] = false;
    unset($_SESSION["SUCCESS"]);
    unset($_SESSION["SESS_FIRST_NAME"]);
    unset($_SESSION["SESS_LAST_NAME"]);
    unset($_SESSION["SESS_MEMBER_ID"]);
    session_destroy();
}

