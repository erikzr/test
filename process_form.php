<?php
// process_form.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Here you can process your form data as needed
    // For example, save the data to the database or handle file uploads

    // After processing the form, redirect to the success page
    header("Location: success.php");
    exit();
}
?>
