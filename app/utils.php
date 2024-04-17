<?php
function validate_form_input_login($username, $password) : bool {
    $username_pattern = '/^[a-zA-Z0-9_]+$/';
    $password_pattern = '/^(?=.*[A-Z]).{4,34}$/';

    if (preg_match($username_pattern, $username) and preg_match($password_pattern, $password)) {
        return true;
    }

    return false;
}

function validate_form_input_signup($username, $password, $phone, $email) : bool {
    $username_pattern = '/^[a-zA-Z0-9_]+$/';
    $password_pattern = '/^(?=.*[A-Z]).{4,34}$/';
    $phone_pattern = '/^\d{8}$/';
    $email_pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    if (preg_match($username_pattern, $username) 
    and preg_match($password_pattern, $password)
    and preg_match($phone_pattern, $phone)
    and preg_match($email_pattern, $email)) {
        return true;
    }

    return false;
}

function validate_form_input_update($username, $phone, $email, $role, $id) : bool {
    $username_pattern = '/^[a-zA-Z0-9_]+$/';
    $phone_pattern = '/^\d{8}$/';
    $email_pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

    if (preg_match($username_pattern, $username) 
    and preg_match($phone_pattern, $phone)
    and preg_match($email_pattern, $email)
    and in_array($role, array(0, 1, 2, 3))
    and ctype_digit($id)) {
        return true;
    }

    return false;
}