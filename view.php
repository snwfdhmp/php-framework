<?

include_once 'provider.php';
include_once 'main.php';
include_once 'renderer.php';
/**
* 
*/
class View
{
	public $layouts_url = "../views/layouts";
	public $views_url = "../views";
	protected $attached_main_controller = NULL;
	protected $provider = NULL;
	
	public function __construct()
	{
		$this->provider = new Provider();
	}

	// calling constructor with a MainController in param 1 will attach this MainController to this View. It will cause the View to use MainController provider.
	public static function withAttachedMainController(MainController $obj)
	{
		$instance = new self();
		$instance->attachMain($obj);
		return $instance;
	}

	public static function withMain(MainController $obj)
	{
		return View::withAttachedMainController($obj);
	}

	public function attachMain(MainController $obj)
	{
		$this->attached_main_controller = $obj;
		$this->provider = $obj->provider;
	}

	public function render_accueil()
	{
		print rt("h1", "Bienvenue", array("class"=>array("titres"), "id"=>"titles")). $this->pr("image", "logo") . "";
	}

	public function render_404()
	{
		print "<h2>Erreur : Cette page n'existe pas</h2>";
	}

	public function provide($type, $name)
	{
		return $this->provider->provide($type, $name);
	}

	public function pr($type, $name)
	{
		return Renderer::provide_and_render($this->provider, $type, $name);
	}
}

?>