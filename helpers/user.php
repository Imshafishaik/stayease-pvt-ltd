<?php
function auth_user_name() {

    return $_SESSION['user_name'] ?? null;
}

function auth_user_type() {

    return $_SESSION['user_type'] ?? null;
}

function admin_user_name() {
    return $_SESSION['admin_name'] ?? null;
}

function admin_user_id() {
    return $_SESSION['admin_id'] ?? null;
}

function auth_user_id() {

    return $_SESSION['user_id'] ?? null;
}
?>