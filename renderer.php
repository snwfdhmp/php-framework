<?

/**
* 
*/
class Renderer
{
	
	function __construct()
	{
		# code...
	}

	function render_image($src) {
		return "<img src='${src}' style='width:50px;'>";
	}

	public static function properties_string($properties) {
		$attr_html = "";
		if(is_array($properties)) {
			$prop_iter = new CachingIterator(new ArrayIterator($properties));
			foreach ($prop_iter as $attr) {
				$attr_html .= key($properties).'="';
				if(is_array($attr)) {
					$attr_iter = new CachingIterator(new ArrayIterator($attr));
					foreach ($attr_iter as $set_attr) {
						$attr_html .= $set_attr;
						if($attr_iter->hasNext())
							$attr_html.=' ';
					}
					$attr_html .= '"';
				}
				else {
					$attr_html .= $attr.'"';
				}
				if($prop_iter->hasNext())
					$attr_html .= ' ';
			}
		}
		return $attr_html;
	}

	public static function render_tag($tag, $txt = "", $properties = "") {
		return "<${tag} ".Renderer::properties_string($properties).">${txt}</${tag}>";
	}

	public static function provide_and_render($provider, $type, $name) {
		$renderer = new Renderer();
		if(! method_exists($renderer, 'render_'.$type)) {
			error('Renderer: Cannot render type '.$type);
			return -1;
		}

		$ressource = $provider->provide($type, $name);

		if($ressource == -1) {
			error('Renderer: Provider->provide has returned -1');
			return -1;
		}

		return call_user_func(array($renderer, 'render_'.$type), $ressource);
	}

}

function rt($tag, $txt = "", $properties = "")
{
	return Renderer::render_tag($tag, $txt, $properties);
}

?>