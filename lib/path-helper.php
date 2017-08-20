<?php

namespace fewbricks\helpers;


/**
 * Class fewbricks
 * @package fewbricks
 */
class PathHelper {

	const BASE_PATH = 'fewbricks';

	protected static $template_path;

	protected $templates_paths;

    /**
     * Private ctor so nobody else can instantiate it
     *
     */
    private function __construct()
    {
    	$this->check_paths();
    }

    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new PathHelper();
        }
        return $inst;
    }

    /**
     *	Get valid paths for the current hierachy
     *  child -> parent -> plugin
     */
    public function check_paths() {
    	$this->paths = array_map(
			function($path) {
				//var_dump($path .'/' . $this->get_base_path());
				if (file_exists($path .'/' . $this->get_base_path())) return $path . '/' . $this->get_base_path();
	    	},
	    	[
	    		get_stylesheet_directory(),
	    		get_template_directory(),
	    		FEWBRICKS_PLUGIN_PATH
			]);
    }

	public function set_template_path($template_path) {
		self::$template_path = apply_filters('fewbricks/project_files_base_path', $template_path);
	}	

	/**
	 *	Return the template file base on your template hierachy
	 */
	public function get_template($file = '') {
		foreach ($this->paths as $base_path) {
			$filepath = $base_path . '/' .$file;
			if (file_exists($filepath)) {
				return $filepath;
			}
		}

		return null;
	}

	/**
	*	Get base path
	*/
	public function get_template_path($path = '') {
		return self::get_base_path() . $path;
	}

	public function get_base_path() {
	  return isset($this->template_path) ? $this->template_path : self::BASE_PATH;
	}
}