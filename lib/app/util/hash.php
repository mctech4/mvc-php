<?php
namespace app\util;

class hash
{
	private static $password_algo = "whirlpool";
	private static $password_salt = "passwordsalty";
	private static $data_algo = "md5";
	private static $data_salt = "datasalty";
	
	public static function load($algo, $data, $salt) {
		$ctx = hash_init($algo, HASH_HMAC, $salt);
		hash_update($ctx, $data);
		return hash_final($ctx);
	}
	public static function password($data) {
		return self::load(self::$password_algo, $data, self::$password_salt);
	}
	public static function data($data)
	{
		return self::load(self::$data_algo, $data, self::$data_salt);
	}
}