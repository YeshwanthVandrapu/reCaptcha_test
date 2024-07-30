<?php
function isValid(){
    return $_POST['fname'] != '' && $_POST['lname'] != '' && $_POST['email'] != '';
}

$success_output = '';
$error_output = '';

if (isValid()) {
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LfykhoqAAAAANl3r_pV_IiyViWTUcyZRUe2JVbi';
    $recaptcha_response = $_POST['recaptchaResponse'];
    $recaptcha = file_get_contents($recaptcha_url.'?secret='.$recaptcha_secret.'&response='.$recaptcha_response);
    $recaptcha = json_decode($recaptcha);
    if($recaptcha->success == true && $recaptcha->score >= 0.5 && $recaptcha->action == "contact"){
        $success_output = 'Your message was sent successfully.';
    } else {
        $error_output = 'Something went wrong. Please try again later';
    }
} else {
    $error_output = 'Please fill out all of the required fields.';
}

$output = [
    'error' => $error_output,
    'success' => $success_output
];
echo "<h2>$recaptcha->score</h2>";

echo json_encode($output);
?>
