<?php


class Pressdown
{

	protected $CI;

	public function __construct($config = [])
	{
		log_message('info', 'Pressdown Class Initialized');
		$this->CI =& get_instance();
		$this->CI->load->library('parsedownExtra', null, 'parsedown');
		$this->CI->load->library('parser');
	}

	public function parser($mdPath, &$vars = [])
	{
		$content = '';
		// --
		$file = fopen($mdPath, 'r');
		try {
			$delimitators = 0;
			while (!feof($file)) {
				$line = fgets($file);

				if ($delimitators < 2) {
					if (preg_match('/---\s+\n/', $line)) {
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
				}
				$content .= $line;
			}
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
		} finally {
			fclose($file);
		}
		return $this->CI->parsedown->text($content);
	}

	public function preview($md_path, $vars = [])
	{
		return $this->render($md_path, $vars);
	}

	public function html($mdDir = MARKDOWN_SRC_PATH, $vars = [])
	{
		$Folder = new DirectoryIterator($mdDir);
		foreach ($Folder as $File) {
			if ($File->isDir() && !$File->isDot()) {
				$this->html($File->getPathname());
			}

			$filename = $File->getFilename();
			if(in_array($filename, ['.', '..'])) {
				continue;
			}
			$extension = pathinfo($filename, PATHINFO_EXTENSION);
			if ($extension !== 'md') {
				continue;
			}

			// --
			$md_folder = strtr(
				rtrim(MARKDOWN_SRC_PATH, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);

			$str = $this->render($File->getRealPath(), $vars, true);

			$html_folder = strtr(
				rtrim(MARKDOWN_HTML_PATH, '/\\'),
				'/\\',
				DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
			);

			$absFilePath = str_replace([$md_folder,'.md'], [$html_folder, '.html'], $File->getRealPath());

			$distDir = dirname($absFilePath);
			if (!is_dir($distDir)) {
				mkdir($distDir);
			}
			file_put_contents($absFilePath, $str);
			unset($_vars);
		}
	}

	private function render($abs_path, $vars, $return = FALSE)
	{
		$abs_path = strtr(
			rtrim($abs_path, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
		$_vars['generated_time'] = date('Y-m-d H:i:s');
		$html = $this->parser($abs_path, $_vars);

		$_vars['html'] = $html;

		$md_folder = strtr(
			rtrim(MARKDOWN_SRC_PATH, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);

		$tpl_folder = strtr(
			rtrim(TEMPLATE_PATH, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);

		$tpl = str_replace([$md_folder, '.md'], [$tpl_folder, '.php'], $abs_path);

		if (!file_exists($tpl)) {
			$tpl = dirname($tpl) . DIRECTORY_SEPARATOR . 'default.php';
			if (!file_exists($tpl)) {
				throw new Exception('template not found !!!', 404);
			}
		}
		return $this->CI->parser->parse(str_replace([VIEWPATH, '.php'], ['', ''], $tpl), $_vars + $vars, $return);
	}

}
