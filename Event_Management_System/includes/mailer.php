<?php
function send_otp_email($to, $otp) {
  $subject = "Evently Password Reset OTP";
  $message = "Your OTP for password reset is: $otp. It expires in 10 minutes.";
  $headers = "From: no-reply@evently.com";

  // Simple mail() for now (works if SMTP configured in php.ini)
  mail($to, $subject, $message, $headers);
}
