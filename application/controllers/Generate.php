<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generate extends CI_Controller
{

	public function __construct() {
		parent::__construct();
		$this->load->library('parser');
		$this->load->library('pressdown');
	}

	public function html() {
		$this->pressdown->html();
	}

	public function shiji()
	{
		$path = MARKDOWN_SRC_PATH . 'shiji/';
		$Folder = new DirectoryIterator($path);

		$data = [];
		$files = [];
		foreach ($Folder as $File) {
			$filename = $File->getFilename();
			if(in_array($filename, ['.', '..', 'index.md'])) {
				continue;
			}

			$file = fopen($path . $filename, 'r');
			$vars = [];
			try {
				$flag = true;
				$delimitators = 0;

				while ($flag && !feof($file)) {
					$line = fgets($file);
					if ($delimitators < 2) {
						if (preg_match('/---\s{0,}/', $line)) {
							$delimitators += 1;
							continue;
						}
						if($delimitators > 0) {
							$d = explode(":", $line, 2);
							if(count($d) != 2 ) {
								continue;
							}
							$vars[trim($d[0])] = trim(trim($d[1]), '"');
							continue;
						}
					} else {
						$flag = false;
					}
				}
			}catch (Exception $e) {
				var_dump($e->getMessage());
			} finally  {
				fclose($file);
			}

			$href = (int)str_replace('.md', '', $filename);
			$files[] = $href;

			$data[] = ['href' => "shiji/{$href}"] + $vars;
		}

		asort($files, SORT_NUMERIC );

		var_dump($files);



		$html = MARKDOWN_HTML_PATH;





		$content = $this->parser->parse('template/shiji/index', ['data' => $data], true);
		echo $content . PHP_EOL;
		exit();
	}
}
