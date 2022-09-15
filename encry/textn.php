<?php 
//Define cipher 
$cipher = "aes-256-cbc"; 

//Generate a 256-bit encryption key 
$encryption_key = openssl_random_pseudo_bytes(32); 

// Generate an initialization vector 
$iv_size = openssl_cipher_iv_length($cipher); 
$iv = openssl_random_pseudo_bytes($iv_size); 

//Data to encrypt 
$data = "أهلا بك"; 
$encrypted_data = openssl_encrypt($data, $cipher, $encryption_key, 0, $iv); 

echo "Encrypted Text: " . $encrypted_data;


//Decrypt data 
$decrypted_data = openssl_decrypt($encrypted_data, $cipher, $encryption_key, 0, $iv); 

echo "Decrypted Text: " . $decrypted_data; 
?>