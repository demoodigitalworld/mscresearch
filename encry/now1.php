<?php

// Storing a string into the variable which 
// needs to be Encrypted 
$simple_string = "أهْلاً وسَهْلاً, مُرحّب بِه, يُرَحِّب, يُرَحِّب, تَرْحيب";

// Displaying the original string 
echo "Original String: " . $simple_string . "\n";

// Storing cipher method 
$ciphering = "BF-CBC";
$iv_length = openssl_cipher_iv_length($ciphering);
$options   = 0;
$encryption_iv = random_bytes($iv_length);
$encryption_key = openssl_digest(php_uname(), 'MD5', TRUE);
$encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);

// Using OpenSSl encryption method 

// Using random_bytes() function which gives 
// randomly 16 digit values 

// Alternatively, any 16 digits may be used 
// characters or numeric for iv 

// Encryption of string process begins

// Display the encrypted string 
echo "Encrypted String: " . $encryption . "\n";

// Decryption of string process begins
// Used random_bytes() that gives randomly 
// 16 digit values 
$decryption_iv = random_bytes($iv_length);
$decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);
$decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $encryption_iv);

// Store the decryption key 

// Decrypting the string 

// Showing the decrypted string 
echo "Decrypted String: " . $decryption;
