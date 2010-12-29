<?php
$account_key = 'YOUR SITE KEY';
$api_key     = 'YOUR MULTIPASS API KEY';

$salted = $api_key . $account_key;
$hash = hash('sha1',$salted,true);
$saltedHash = substr($hash,0,16);
$iv = "OpenSSL for Ruby";

$user_data = array(
	'uid' => '123abc',
	'customer_email' => 'testuser@yoursite.com',
	'customer_name' => 'Test User',
	'expires' => date("c", strtotime("+5 minutes"))
);

$data = json_encode($user_data);

// AES encryption: 
//   double XOR first block
for ($i = 0; $i < 16; $i++) {
	$data[$i] = $data[$i] ^ $iv[$i];
}

//   pad using block size of 16 bytes
$pad = 16 - (strlen($data) % 16);
$data = $data . str_repeat(chr($pad), $pad);

//   encrypt using AES128-cbc
$cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128,'','cbc','');
mcrypt_generic_init($cipher, $saltedHash, $iv);
$encryptedData = mcrypt_generic($cipher,$data);
mcrypt_generic_deinit($cipher);

// Base64 encode the encrypted data
$encryptedData = base64_encode($encryptedData);

// Convert encoded data to the URL safe variant
$encryptedData = preg_replace('/\=$/', '', $encryptedData);
$encryptedData = preg_replace('/\n/', '', $encryptedData);
$encryptedData = preg_replace('/\+/', '-', $encryptedData);
$encryptedData = preg_replace('/\//', '_', $encryptedData);

$multipass = urlencode($encryptedData);
?>