<?php
class ActionUtils
{
    public static function redirectAndClose(string $location, string $message = ""): never
    {
        if ($message !== "") {
            $_SESSION["flash_error"] = $message;
        }
        header("Location: ../" . $location);
        exit;
    }
}
?>
