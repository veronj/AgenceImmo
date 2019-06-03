<?php

    // Prepare data
    $param = array(
        'message' => 'hello world',
        'amount'   => '12.20',
        'currency' => 'EUR',
        'type' => 'phone',
        "recipient" => "+33600000001",
        "vendor_token" => "58385365be57f651843810",
        "user_token" => "+33600000001"
    );

    ksort($param); // alphabetical sorting

    $sig = array();

    foreach ($param as $key => $val) {
        $sig[] .= $key.'='.$val;
    }

    // Concat the private token (provider one or vendor one) and has the result
    $callSig = md5(implode("&", $sig)."58385365c0157470110435");
echo "\n";
    echo $callSig;
    echo "\n";2ac46b3c7bed431e56f001dcf580fb62