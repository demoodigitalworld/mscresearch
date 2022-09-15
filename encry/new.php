<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Cipher</title>
</head>

<body>

    <?php
    $simple_string = $encryption_key = $encryption = '';
    if (isset($_POST['encry'])) {
        $simple_string = $_POST['arab'];
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options   = 0;
        $encryption_iv = '1234567891011121';
        $encryption_key = $_POST['keyss'];
        $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
        echo $encryption;
    }
    // Storing a string into the variable which 
    // needs to be Encrypted 


    // Displaying the original string 
    // echo "Original String: " . $simple_string;

    // Storingthe cipher method 


    // Using OpenSSl Encryption method 


    // Non-NULL Initialization Vector for encryption 

    // Storing the encryption key 


    // Using openssl_encrypt() function to encrypt the data 

    // echo "Encrypted String: " . $encryption . "\n";
    // Displaying the encrypted string 

    // Non-NULL Initialization Vector for decryption 
    // $decryption_iv = '1234567891011121';

    // Storing the decryption key 
    // $decryption_key = "56";

    // Using openssl_decrypt() function to decrypt the data 
    // $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv);

    // Displaying the decrypted string 
    // echo "Decrypted String: " . $decryption;

    ?>



    <form method="post">
        <label>Enter Arabic Text</label>
        <textarea name="arab"><?php if ($simple_string) {
                                    echo $simple_string;
                                } ?></textarea>
        <br>
        <label>Encrytion Key</label>
        <input type="text" name="keyss" value="<?php if ($encryption_key) {
                                                    echo $encryption_key;
                                                } ?>">
        <br>
        <input type="submit" name="encry" value="encrypt">

    </form>
    <label>Encrypted Text:</label>
    <textarea name="enc"><?php echo $encryption; ?></textarea>

    <br>
    <hr>






    <?php
    $simples_string = $decryption_key = $decryption = '';
    if (isset($_POST['decry'])) {
        $simples_string = $_POST['desc'];
        $ciphering = "AES-128-CTR";
        $iv_length = openssl_cipher_iv_length($ciphering);
        $options   = 0;
        $decryption_iv = '1234567891011121';
        $decryption_key = $_POST['keysss'];
        $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
    }

    ?>


    <form method="post">
        <label>Enter Encrypted Text</label>
        <textarea name="desc"><?php if ($simples_string) {
                                    echo $simples_string;
                                } ?></textarea>
        <br>
        <label>Encrytion Key</label>
        <input type="text" name="keysss" value="<?php if ($decryption_key) {
                                                    echo $decryption_key;
                                                } ?>">
        <br>
        <input type="submit" name="decry" value="decrypt">

    </form>
    <label>decrypted Text:</label>
    <?php echo $decryption; ?>






    <div id="tool-container">
        <h1> Encrypt & Decrypt Text Online </h1>
        <p>
            Protect your text by Encrypting and Decrypting any given text with a key that no one knows <br>

        </p>


        <h2>Encryption</h2>
        <p>
            <!--  NOTE:key changed on 13 June 2016-->
        </p>
        <table>
            <tr>
                <td><span class="input-title"><strong>Text to Encrypt</strong></span></td>
            </tr>
            <tr>
                <td><textarea id="input" rows="10" cols="80"></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" id="doFunctionButton" value="Encrypt" onclick="doFunction(event,'ENCRYPT')" /></td>
            </tr>

        </table>
        <br>
        <table>
            <tr>
                <td><span class="result-title"><strong>Encrypted Text</strong></span></td>
            </tr>
            <tr>
                <td><textarea id="result" rows="10" cols="80"></textarea></td>
            </tr>
        </table>

        <br>
        <br>
        <h2>Decryption</h2>

        <table>
            <tr>
                <td><span class="input-title"><strong>Encrypted Text</strong></span></td>
            </tr>
            <tr>
                <td><textarea id="input2" rows="10" cols="80"></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" id="doFunctionButton" value="Decrypt" onclick="doFunction(event,'DECRYPT',2)" /></td>
            </tr>

        </table>
        <br>
        <table>
            <tr>
                <td><span class="result-title"><strong>Decrypted Text</strong></span></td>
            </tr>
            <tr>
                <td><textarea id="result2" rows="10" cols="80"></textarea></td>
            </tr>
        </table>
    </div>

</body>

</html>