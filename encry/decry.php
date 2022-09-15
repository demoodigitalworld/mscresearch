<?php
include "header.php";
session_start();
?>




<div class="container">
    <div class="card shadow" style="border-top: 3px solid red; margin-bottom: 30px;">
        <div class="card-body text-justify">
            <div style="padding:20px;">
                <div class="row">
                    <div class="col-md-7">
                        <h3>Decryption Mode</h3>
                        <hr>
                        <?php
                         function str_to_array($str)
                         {
                             return preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);
                         }
                        $enc_text = $mytype = $decryption_key = $decryption = '';
                        if (isset($_POST['enc'])) {
                            $mytype = $_POST['mytype'];
                            $enc_text = $_POST['enc_text'];
                            if ($mytype == 'AES-128-CTR') {
                                $decryption_key = $_POST['key'];
                                $ciphering = "AES-128-CTR";
                                $iv_length = openssl_cipher_iv_length($ciphering);
                                $options   = 0;
                                $decryption_iv = '1234567891011121';
                                $encryption = $enc_text;
                                $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
                                // echo $decryption;
                            } elseif ($mytype == 'BF-CBC') {
                                $ciphering = "BF-CBC";
                                $iv_length = openssl_cipher_iv_length($ciphering);
                                $options   = 0;
                                $encryption_iv = $_SESSION['aa'];
                                $decryption_iv = random_bytes($iv_length);
                                $decryption_keys = openssl_digest(php_uname(), 'MD5', TRUE);
                                $encryption = $enc_text;
                                $decryption = openssl_decrypt($encryption, $ciphering, $decryption_keys, $options, $encryption_iv);
                            } elseif ($mytype == 'AES-128-CTR1') {
                                $decryption_key = $_POST['key'];
                                $ciphering = "AES-128-CTR";
                                $iv_length = openssl_cipher_iv_length($ciphering);
                                $options   = 0;
                                $decryption_iv = '0101010101010101';
                                $encryption = $enc_text;
                                $decryption = openssl_decrypt($encryption, $ciphering, $decryption_key, $options, $decryption_iv);
                            } 
                            elseif ($mytype == 'Atbash') {
                                //Atbash Substitution Decryption Algorithm
                                $arabic_txt = str_to_array($enc_text);
                                $alphabet = str_to_array(" ا ب ت ث ج ح خ د ذ ر ز س ش ص ض ط ظ ع غ ف ق ك ل م ن و ه ي ");
                                $map = array_combine($alphabet, array_reverse($alphabet));

                                for ($i = 0; $i < sizeof($arabic_txt); $i++) {
                                    $char = array_search($arabic_txt[$i], $map);
                                    if ($char) {
                                        $arabic_txt[$i] = $char;
                                    }
                                }
                                $decryption = implode($arabic_txt);
                                // echo $arabic_txt;
                                
                             }
                             elseif ($mytype == 'aes-256-cbc') {
                                 //Mohammed Abdullah Decryption Algorithm
                                $encryption_ = $_SESSION['key'];
                                $ciphering = "aes-256-cbc";
                                $encryption = $enc_text;
                                $iv = $_SESSION['iv'];
                                $decryption = openssl_decrypt($encryption, $ciphering, $encryption_, 0, $iv); 
                                
                            } else {
                                echo "<script>window.alert('please select Encrytion Type');</script>";
                            }
                        }
                        ?>
                        <form class="form-group" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Decryption Type</label>
                                    <?php if ($mytype == 'AES-128-CTR') {
                                    ?>
                                        <input type="text" value="Ammar Sabeeh Hmoud Altamimi Decryption Algorithm" class="form-control" disabled>
                                    <?php } elseif ($mytype == 'BF-CBC') { ?>
                                        <input type="text" value="Basim najim al-din abed al-obaidi Decryption Algorithm" class="form-control" disabled>
                                    <?php } elseif ($mytype == 'AES-128-CTR1') { ?>
                                        <input type="text" value="Prakash Kuppuswamy Decryption Algorithm" class="form-control" disabled>
                                        <?php } elseif ($mytype == 'Atbash') { ?>
                                        <input type="text" value="Atbash Substitution Decryption Algorithm" class="form-control" disabled>
                                        <?php } elseif ($mytype == 'aes-256-cbc') { ?>
                                        <input type="text" value="Mohammed Abdullah Decryption Algorithm" class="form-control" disabled>
                                    <?php
                                    } else { ?>
                                        <select class="form-control" name='mytype'>
                                            <option value="--">:::- DECRYPTION ALGORITHM -:::</option>
                                            <option value="AES-128-CTR">Ammar Sabeeh Hmoud Altamimi Decryption Algorithm</option>
                                            <option value="BF-CBC">Basim najim al-din abed al-obaidi Decryption Algorithm</option>
                                            <option value="AES-128-CTR1">Prakash Kuppuswamy Decryption Algorithm</option>
                                            <option value="Atbash">Atbash Substitution Decryption Algorithm</option>
                                            <option value="aes-256-cbc">Mohammed Abdullah Decryption Algorithm</option>
                                        </select>
                                    <?php } ?>

                                </div>
                                <div class="col-md-6">
                                    <label>Decryption Key</label>
                                    <?php 
                                    if ($decryption_key) {
                                    ?>
                                    <input type="text" name="key" disabled value="<?php if ($decryption_key) {
                                                                                echo $decryption_key;
                                                                            } ?>" class="form-control">
                                    <?php }else {?>
                                        <input type="text" name="key" value="<?php if ($decryption_key) {
                                                                                echo $decryption_key;
                                                                            } ?>" class="form-control">
                                    <?php } ?>
                                </div>
                            </div>
                            <label>Encrypted Text</label>
                            <?php 
                                    if ($enc_text) {
                                    ?>
                            <textarea class="form-control" name="enc_text" rows="5" disabled placeholder="VFVg2FDsfYJjSmQL553W07omzOA="> <?php if ($enc_text) { echo $enc_text; } ?></textarea>
                            <?php }else{?>
                                <textarea class="form-control" name="enc_text" rows="5" placeholder="VFVg2FDsfYJjSmQL553W07omzOA="> <?php if ($enc_text) { echo $enc_text; } ?></textarea>
                                <?php }?>
                            <br>
                            <?php 
                                    if ($enc_text) {
                                    ?>
                            <input type="submit" name="enc" disabled class="btn btn-primary col-md-6" value="Decrypt Now">
                            <?php }else{?>
                            <input type="submit" name="enc" class="btn btn-primary col-md-6" value="Decrypt Now">
                                <?php }?>
                            <a href="index.php" class="btn btn-secondary">Homeage</a>
                            <a href="encry.php" class="btn btn-success">Goto Encryption</a>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <h3>Output</h3>
                        <hr>
                        <label>Decrypted Text</label>
                        <textarea class="form-control" name="enc_text" rows='5' id='myInput'><?php echo $decryption; ?></textarea>
                        <br>

                        <?php
                        if ($decryption) {
                        ?>
                            <!-- &nbsp;&nbsp;&nbsp;<button onclick="myFunction()" class="btn btn-info">Copy text</button> -->
                            &nbsp;&nbsp;&nbsp; <a href="encry.php" class="btn btn-danger ">Goto Encrytion Page</a>
                        <?php
                            // Do stuff
                            usleep(mt_rand(100, 10000));

                            // At the end of your script
                            $time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
                            echo '<h3>Execution Time</h3>';
                            echo "<b>Results Timeout:</b> in $time Seconds\n";
                            memory_get_peak_usage();

                            $mem1 = memory_get_usage();
                            $a = $decryption;
                            echo "<br/><b>Cipher Size: </b>".((strlen($a) * 8)/4) ."Bytes" ;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include "footer.php";
?>