<?php
namespace Mahdiware;
use mysqli;

class Database
{
	private $mysqli;
	
	public function __construct()
	{
		$this->mysqli = new mysqli(env("database.hostname", "localhost"), env("database.username", "root"), env("database.password", "root"), env("database.name", "mahdiware"));
	}
	
	public function mysql()
	{
		return $this->mysqli;
	}
	//Soon Adding Short-way
}