<?php
function auth_user_name() {

    return $_SESSION['user_name'] ?? null;
}

function auth_user_type() {

    return $_SESSION['user_type'] ?? null;
}

function auth_user_id() {

    return $_SESSION['user_id'] ?? null;
}
?>