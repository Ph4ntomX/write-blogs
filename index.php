<?php
    session_start();

    require "lib/functions.php";

    $path = $_SERVER["REQUEST_URI"];
    if(str_contains($path, ".php")) {
        header("Location: /");
    }

    // remove query string from path
    $path = parse_url($path, PHP_URL_PATH);

    switch($path) {
        case "/login" :
            require "pages/login.php";
            break;
        case "/signup" :
            require "pages/signup.php";
            break;
        case "/logout" :
            require "pages/logout.php";
            break;
        case "/auth/login" :
            var_dump($_POST);
            require "lib/auth/do_login.php";
            break;
        case "/auth/signup" :
            require "lib/auth/do_signup.php";
            break;
        case "/dashboard" :
            require "pages/manage/dashboard.php";
            break;
        case "/post" :
            require "pages/post.php";
            break;
        case "/manage/users" :
            require "pages/manage/users/index.php";
            break;
        case "/manage/users/add" :
            require "pages/manage/users/add.php";
            break;
        case "/manage/users/edit" :
            require "pages/manage/users/edit.php";
            break;
        case "/manage/users/change-password" :
            require "pages/manage/users/change-password.php";
            break;
        case "/manage/users/do_add" :
            require "lib/manage/users/add.php";
            break;
        case "/manage/users/do_edit" :
            require "lib/manage/users/edit.php";
            break;
        case "/manage/users/do_changepassword" :
            require "lib/manage/users/changepwd.php";
            break;
        case "/manage/users/do_delete" :
            require "lib/manage/users/delete.php";
            break;
        case "/manage/posts" :
            require "pages/manage/posts/index.php";
            break;
        case "/manage/posts/add" :
            require "pages/manage/posts/add.php";
            break;
        case "/manage/posts/edit" :
            require "pages/manage/posts/edit.php";
            break;
        case "/manage/posts/do_add" :
            require "lib/manage/posts/add.php";
            break;
        case "/manage/posts/do_edit" :
            require "lib/manage/posts/edit.php";
            break;
        case "/manage/posts/do_delete" :
            require "lib/manage/posts/delete.php";
            break;
        default :
            require "pages/home.php";
            break;
    }
?>