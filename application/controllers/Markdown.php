<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Markdown extends CI_Controller
{

	public function __construct() {
		parent::__construct();
		$this->load->library('pressdown');
	}

	public function index() {
		$router = $this->router;
		$segments = $router->uri->segments;

		$md = implode(DIRECTORY_SEPARATOR, $segments);
		if (file_exists($path = MARKDOWN_SRC_PATH . "{$md}.md")) {
			$this->pressdown->preview($path, []);
			return;
		}

		if (file_exists($path = MARKDOWN_SRC_PATH . "{$md}/")) {


			// 转换字符或替换字串
			$path = strtr($path, '/\\', DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR);

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

				$data[$href] = ['href' => "{$href}"] + $vars;
			}

			ksort($data, SORT_NUMERIC );





			$this->parser->parse('template/shiji/index', ['data' => $data]);
			return;
		}
		show_404('not found');
	}


	protected function catalog($dir)
	{
		
	}

}
