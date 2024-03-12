<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class License
{
    private $_CI;

    public function __construct()
    {

        $this->_CI = & get_instance();
    }

    function generate()
    {
        $num_segments = 5;
        $segment_chars = 5;

        $tokens = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $license_string = '';
        // Build Default License String
        // It will generate random string with suffix of timestamp
        for ($i = 0; $i < $num_segments; $i++) {
            $segment = '';
            for ($j = 0; $j < $segment_chars; $j++) {
                $segment .= $tokens[rand(0, strlen($tokens)-1)];
            }
            $license_string .= $segment;
            if ($i < ($num_segments - 1)) {
                $license_string .= '-';
            }
        }

        $license_string .= '-'.strtoupper(time());

        return $license_string;
    }
    //https://stackoverflow.com/questions/45567962/convert-encrypt-and-decrypt-c-sharp-function-to-php-function
    // https://www.geeksforgeeks.org/how-to-encrypt-and-decrypt-a-php-string/
    function extend($company)
    {
        $companyId = $company["id"];
        $licenseKey = $company["license_key"];

        $endDate = $company["end_date"];

        $stringToEncrypt = $company["id"] . "_" . $company["original_machine_id"];
        
        // Store the cipher method
        $ciphering = "aes-256-cbc";
        
        // Use OpenSSl Encryption method
        $options = OPENSSL_RAW_DATA;
        
        // Non-NULL Initialization Vector for encryption
        $encryption_iv = $company["machine_id"];
        
        // Store the encryption key
        $encryption_key = substr(hash("sha256", $company["license_key"], true), 0, 32);

        // Use openssl_encrypt() function to encrypt the data
        $encryptedKey = base64_encode(openssl_encrypt($stringToEncrypt, $ciphering, $encryption_key, $options, $encryption_iv));
        return $encryptedKey;

        /*
        // Display the encrypted string
        echo "Encrypted String: " . $encryptedKey . "\n";
        
        // Non-NULL Initialization Vector for decryption
        $decryption_iv = $company["machine_id"];
        
        // Store the decryption key
        $decryption_key = $encryption_key;
        
        // Use openssl_decrypt() function to decrypt the data
        $decryptedKey =   openssl_decrypt ($encryptedKey, $ciphering, 
                $decryption_key, $options, $decryption_iv);
        echo "<br>";
        // Display the decrypted string
        echo "Decrypted String: " . $decryptedKey;
        exit;
        */

    }

}