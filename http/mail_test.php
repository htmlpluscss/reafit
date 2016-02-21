<?php
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "info@reafit.ru";
    $to = "79198889134@ya.ru";
    $subject = "PHP Mail Test script";
    $message = "This is a test to check the PHP Mail functionality";
    $headers = "From:" . $from;
    var_dump(mail($to,$subject,$message, $headers));
    echo "Test email sent";
?>