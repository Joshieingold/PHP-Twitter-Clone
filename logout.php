<?php
session_start();
require_once __DIR__ . "/../utils/ActionUtils.php";


main();

function main(): void
{
    if (!isset($_SESSION["success"])) {
        clearSession();
        ActionUtils::redirectAndClose("login.php");
    }
    clearSession();
    ActionUtils::redirectAndClose("index.php");
}

function clearSession():void {
    $_SESSION["success"] = false;
    unset($_SESSION["success"]);
    unset($_SESSION["SESS_FIRST_NAME"]);
    unset($_SESSION["SESS_LAST_NAME"]);
    unset($_SESSION["SESS_MEMBER_ID"]);
}

