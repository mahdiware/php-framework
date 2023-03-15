<?php
namespace Mahdiware;

class Database
{
	private mysqli;
	
	public class __construct()
	{
		$this->mysqli = new mysqli(env("database.hostname", "localhost"), env("database.username", "root"), env("database.password", "root"), env("database.name", "mahdiware"));
	}
	
	public class mysql()
	{
		return $this->mysqli;
	}
	//Soon Adding Short-way
}