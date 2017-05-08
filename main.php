<?
include_once "view.php";
include_once "provider.php";


/**
* 
*/
class MainController
{
	public $provider = NULL;
	
	function __construct()
	{
		$provider = new Provider();
	}

	function call_view($view_name) {
		$func_call = 'render_'.$view_name;
		$view = new View();
		//$view = View::withMain($this);
		if(method_exists($view, $func_call)) {
			call_user_func(array($view, $func_call));
		} else {
			call_user_func(array($view, 'render_404'));
		}
	}

	function error($err) {
		die($err);
	}
}

function error($err) {
	if(! isset($GLOBALS['main']))
		die('No global MainController. (isset($GLOBALS[\'main\']) -> false)');
	
	$GLOBALS['main']->error($err);
}

?>