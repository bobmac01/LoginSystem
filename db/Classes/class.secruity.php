<?php

class security
{

	function passwordSalt($pass)
	{
		// Anything more uses more processing power
		$cost = 10;
		// this creates a random salt
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		// Using a blowfish algorithm
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		// Hashing the salt
		$hash = crypt($pass, $hash);
		// returning hash to verify and store data
		return $hash;

	}


}

?>