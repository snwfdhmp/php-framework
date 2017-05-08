<?

/**
* 
*/
class Provider
{
	private $ressources = array(
		'image' => array(
			'logo' => 'logo.png'
			),
		'js' => array(
			'bootstrap' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous',
			'fontawesome' => 'https://use.fontawesome.com/f51a5e5d23.js',
			'jquery' => 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js',
			)
		);
	
	function __construct()
	{
		# code...
	}

	function provide($type, $name) {
		return $this->provide_ressource($type, $name);
	}

	function provide_ressource($type, $name) {
		if(array_key_exists($type, $this->ressources)) {
			if (array_key_exists($name, $this->ressources[$type])) {
				return $this->ressources[$type][$name];
			}
			else {
				global $main;
				$main->error("Provider: ${type} does not contain any named '${name}' ressource");
				return -1;
			}
		}
	}
}

?>