<?php
include "header.php";
session_start();
?>




<div class="container">
    <div class="card shadow" style="border-top: 3px solid blue; margin-bottom: 30px;">
        <div class="card-body text-justify">
            <div style="padding:20px;">
                <div class="row">
                    <div class="col-md-7">
                        <h3>Encryption Mode</h3>
                        <hr>
                        <?php
                        function str_to_array($str)
                        {
                            return preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);
                        }
                        $arabic_text = $mytype = $encryption_key = $encryption = '';
                        if (isset($_POST['enc'])) {
                            $mytype = $_POST['mytype'];
                            $arabic_text = $_POST['arabic_text'];
                            if ($mytype == 'AES-128-CTR') {

                                //Ammar Sabeeh Hmoud Altamimi Encryption Algorithm

                                $encryption_key = $_POST['key'];
                                $ciphering = "AES-128-CTR";
                                $iv_length = openssl_cipher_iv_length($ciphering);
                                $options   = 0;
                                $encryption_iv = '1234567891011121';
                                $encryption = openssl_encrypt($arabic_text, $ciphering, $encryption_key, $options, $encryption_iv);
                            } elseif ($mytype == 'BF-CBC') {
                                //Basim najim al-din abed al-obaidi Encryption Algorithm
                                $ciphering = "BF-CBC";
                                $iv_length = openssl_cipher_iv_length($ciphering);
                                $options   = 0;
                                $encryption_iv = random_bytes($iv_length);
                                $_SESSION['aa'] = $encryption_iv;
                                $encryption_keys = openssl_digest(php_uname(), 'MD5', TRUE);
                                $encryption = openssl_encrypt($arabic_text, $ciphering, $encryption_keys, $options, $encryption_iv);
                            } elseif ($mytype == 'AES-128-CTR1') {
                                //Prakash Kuppuswamy Encryption Algorithm
                                $encryption_key = $_POST['key'];
                                $ciphering = "AES-128-CTR";
                                $iv_length = openssl_cipher_iv_length($ciphering);
                                $options   = 0;
                                $encryption_iv = '0101010101010101';
                                $encryption = openssl_encrypt($arabic_text, $ciphering, $encryption_key, $options, $encryption_iv);
                            } elseif ($mytype == 'Atbash') {
                                //Atbash Substitution Encryption Algorithm
                                
                                $arabic_txt = str_to_array($arabic_text);
                                $alphabet = str_to_array(" ا ب ت ث ج ح خ د ذ ر ز س ش ص ض ط ظ ع غ ف ق ك ل م ن و ه ي ");
                                $map = array_combine($alphabet, array_reverse($alphabet));

                                for ($i = 0; $i < sizeof($arabic_txt); $i++) {
                                    $char = array_search($arabic_txt[$i], $map);
                                    if ($char) {
                                        $arabic_txt[$i] = $char;
                                    }
                                }
                                $encryption = implode($arabic_txt);
                                // echo $arabic_txt;
                            } elseif ($mytype == 'aes-256-cbc') {
                                //Mohammed Abdullah Encryption Algorithm
                                $encryption_ = openssl_random_pseudo_bytes(32);
                                $_SESSION['key'] = $encryption_;
                                $ciphering = "aes-256-cbc";
                                $iv_size = openssl_cipher_iv_length($ciphering);
                                $iv = openssl_random_pseudo_bytes($iv_size);
                                $_SESSION['iv'] = $iv;
                                $encryption = openssl_encrypt($arabic_text, $ciphering, $encryption_, 0, $iv);
                            } else {
                                echo "<script>window.alert('please select Encrytion Type');</script>";
                            }
                        }
                        ?>
                        <form class="form-group" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Encryption Type</label>
                                    <?php if ($mytype == 'AES-128-CTR') {
                                    ?>
                                        <input type="text" value="Ammar Sabeeh Hmoud Altamimi Encryption Algorithm" class="form-control" disabled>
                                    <?php } elseif ($mytype == 'BF-CBC') { ?>
                                        <input type="text" value="Basim najim al-din abed al-obaidi Encryption Algorithm" class="form-control" disabled>
                                    <?php } elseif ($mytype == 'AES-128-CTR1') { ?>
                                        <input type="text" value="Prakash Kuppuswamy Encryption Algorithm" class="form-control" disabled>
                                    <?php } elseif ($mytype == 'Atbash') { ?>
                                        <input type="text" value="Atbash Substitution Encryption Algorithm" class="form-control" disabled>
                                    <?php } elseif ($mytype == 'aes-256-cbc') { ?>
                                        <input type="text" value="Mohammed Abdullah Encryption Algorithm" class="form-control" disabled>
                                    <?php
                                    } else { ?>
                                        <select class="form-control" name='mytype'>
                                            <option value="--">:::- ENCRYPTION ALGORITHM -:::</option>
                                            <option value="AES-128-CTR">Ammar Sabeeh Hmoud Altamimi Encryption Algorithm</option>
                                            <option value="BF-CBC">Basim najim al-din abed al-obaidi Encryption Algorithm</option>
                                            <option value="AES-128-CTR1">Prakash Kuppuswamy Encryption Algorithm</option>
                                            <option value="Atbash">Atbash Substitution Encryption Algorithm</option>
                                            <option value="aes-256-cbc">Mohammed Abdullah Encryption Algorithm</option>
                                        </select>
                                    <?php } ?>

                                </div>
                                <div class="col-md-6">
                                    <label>Encryption Key</label>
                                    <?php
                                    if ($encryption_key) {
                                    ?>
                                        <input type="text" name="key" disabled value="<?php if ($encryption_key) {
                                                                                            echo $encryption_key;
                                                                                        } ?>" class="form-control">
                                    <?php } else { ?>
                                        <input type="text" name="key" value="<?php if ($encryption_key) {
                                                                                    echo $encryption_key;
                                                                                } ?>" class="form-control">
                                    <?php } ?>
                                </div>
                            </div>
                            <label>Enter Arabic/Plain Text</label>
                            <?php
                            if ($arabic_text) {
                            ?>
                                <textarea class="form-control" name="arabic_text" rows="5" disabled placeholder="e.g أهْلاً وسَهْلاً"> <?php if ($arabic_text) {
                                                                                                                                            echo $arabic_text;
                                                                                                                                        } ?></textarea>
                            <?php } else { ?>
                                <textarea class="form-control" name="arabic_text" rows="5" placeholder="e.g أهْلاً وسَهْلاً"> <?php if ($arabic_text) {
                                                                                                                                    echo $arabic_text;
                                                                                                                                } ?></textarea>
                            <?php } ?>

                            <br>
                            <input type="submit" name="enc" class="btn btn-primary col-md-6" value="Encrypt Now">
                        </form>
                    </div>
                    <div class="col-md-5">
                        <h3>Output</h3>
                        <hr>
                        <label>Encrypted Text</label>
                        <textarea class="form-control" name="arabic_text" rows='5' id='myInput'><?php echo $encryption; ?></textarea>
                        <br>

                        <?php
                        if ($encryption) {
                        ?>
                            &nbsp;&nbsp;&nbsp;<button onclick="myFunction()" class="btn btn-info">Copy text</button>
                            &nbsp;&nbsp;&nbsp; <a href="decry.php" class="btn btn-success ">Goto Decryption Page</a>
                        <?php
                            // Do stuff
                            usleep(mt_rand(100, 10000));

                            // At the end of your script
                            $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
                            echo '<h3>Execution Time</h3>';
                            echo "<b>Results Timeout:</b> in $time Seconds\n";

                            $mem1 = memory_get_usage();
                            $a = $encryption;
                            echo "<br/><b>Cipher Size: </b>" . ((strlen($a) * 8) / 4) . "Bytes";
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php
    include "footer.php";
    ?>