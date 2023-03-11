namespace Mahdiware\Session;

//This file has not been completed, please do not use it 
class Session
{
	public function __construct()
	{
		session_start();
		ini_set('session.save_path', "Application/src/writable/sessions");
   		ini_set('session.sid_length', "70");
	}
	
	public function has(string $name)
	{
		return isset($_SESSION[$name]);
	}
	
	public function remove(string $name)
	{
		
	}
	
	public function set(string $name, $value)
	{
		return $_SESSION[$name] = $value;
	}
}