<?php
    session_destroy();

    $_SESSION["success"] = "Successfully logged out";

    header("Location: /");
    exit();
?>