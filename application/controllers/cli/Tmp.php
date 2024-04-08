<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tmp extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('pressdown');
	}


	public function img()
	{
		// <imgalt=""class="kindle-cn-inline-character"src="Image00102.jpg"/>

		$path = MARKDOWN_SRC_PATH . "shiji\\";
		$dir = scandir($path);

		$imgs = [];

		foreach ($dir as $file) {
			if(in_array($file, ['.', '..', 'index.md'])) {
				continue;
			}
			$content = file_get_contents($path . $file);
			preg_match_all("/Image(\d*)\.jpg/", $content, $matches);



			$imgs = array_merge($imgs, $matches[0]);

		}

		$imgs = array_unique($imgs);

		file_put_contents("d:\a.txt", json_encode(array_values($imgs)));
		return;
	}

	public function replaceImg()
	{
		$map = [
			'<imgalt="char"class="kindle-cn-inline-character"src="Image00003.jpg"/>' => "蟜",
			'<imgalt="char"class="kindle-cn-inline-character"src="Image00004.jpg"/>' => "讙",
			'<imgalt="char"class="kindle-cn-inline-character"src="Image00005.jpg"/>' => "驩",
			'<imgalt="char"class="kindle-cn-inline-character"src="Image00006.jpg"/>' => "絺",
		];


		$path = MARKDOWN_SRC_PATH . "\\shiji\\";
		$dir = scandir($path);


		foreach ($dir as $file) {

			if(in_array($file, ['.', '..', 'index.md', '1.md'])) {
				continue;
			}
			$content = file_get_contents($path . $file);
			$pure_content = str_replace(array_keys($map), array_values($map), $content);

			echo $path . $file;
			file_put_contents($path . $file, $pure_content);
		}
		exit();
	}

}
/**
 * [
 * "Image00003.jpg",
 * "Image00004.jpg",
 * "Image00005.jpg",
 * "Image00006.jpg",
 * "Image00033.jpg",
 * "Image00034.jpg",
 * "Image00131.jpg",
 * "Image00132.jpg",
 * "Image00133.jpg",
 * "Image00134.jpg",
 * "Image00135.jpg",
 * "Image00136.jpg",
 * "Image00137.jpg",
 * "Image00138.jpg",
 * "Image00139.jpg",
 * "Image00140.jpg",
 * "Image00141.jpg",
 * "Image00142.jpg",
 * "Image00143.jpg",
 * "Image00144.jpg",
 * "Image00145.jpg",
 * "Image00146.jpg",
 * "Image00147.jpg",
 * "Image00148.jpg",
 * "Image00149.jpg",
 * "Image00150.jpg",
 * "Image00151.jpg",
 * "Image00152.jpg",
 * "Image00153.jpg",
 * "Image00154.jpg",
 * "Image00155.jpg",
 * "Image00156.jpg",
 * "Image00157.jpg",
 * "Image00158.jpg",
 * "Image00159.jpg",
 * "Image00160.jpg",
 * "Image00161.jpg",
 * "Image00162.jpg",
 * "Image00163.jpg",
 * "Image00164.jpg",
 * "Image00165.jpg",
 * "Image00166.jpg",
 * "Image00167.jpg",
 * "Image00168.jpg",
 * "Image00169.jpg",
 * "Image00170.jpg",
 * "Image00171.jpg",
 * "Image00172.jpg",
 * "Image00173.jpg",
 * "Image00174.jpg",
 * "Image00175.jpg",
 * "Image00176.jpg",
 * "Image00177.jpg",
 * "Image00178.jpg",
 * "Image00179.jpg",
 * "Image00180.jpg",
 * "Image00181.jpg",
 * "Image00182.jpg",
 * "Image00183.jpg",
 * "Image00184.jpg",
 * "Image00185.jpg",
 * "Image00186.jpg",
 * "Image00187.jpg",
 * "Image00188.jpg",
 * "Image00189.jpg",
 * "Image00190.jpg",
 * "Image00191.jpg",
 * "Image00192.jpg",
 * "Image00193.jpg",
 * "Image00194.jpg",
 * "Image00195.jpg",
 * "Image00196.jpg",
 * "Image00197.jpg",
 * "Image00198.jpg",
 * "Image00199.jpg",
 * "Image00200.jpg",
 * "Image00201.jpg",
 * "Image00202.jpg",
 * "Image00203.jpg",
 * "Image00204.jpg",
 * "Image00205.jpg",
 * "Image00206.jpg",
 * "Image00207.jpg",
 * "Image00208.jpg",
 * "Image00209.jpg",
 * "Image00210.jpg",
 * "Image00211.jpg",
 * "Image00212.jpg",
 * "Image00213.jpg",
 * "Image00214.jpg",
 * "Image00215.jpg",
 * "Image00216.jpg",
 * "Image00217.jpg",
 * "Image00218.jpg",
 * "Image00219.jpg",
 * "Image00220.jpg",
 * "Image00221.jpg",
 * "Image00222.jpg",
 * "Image00223.jpg",
 * "Image00224.jpg",
 * "Image00225.jpg",
 * "Image00226.jpg",
 * "Image00227.jpg",
 * "Image00228.jpg",
 * "Image00229.jpg",
 * "Image00230.jpg",
 * "Image00231.jpg",
 * "Image00032.jpg",
 * "Image00232.jpg",
 * "Image00233.jpg",
 * "Image00234.jpg",
 * "Image00235.jpg",
 * "Image00236.jpg",
 * "Image00237.jpg",
 * "Image00238.jpg",
 * "Image00035.jpg",
 * "Image00239.jpg",
 * "Image00240.jpg",
 * "Image00241.jpg",
 * "Image00242.jpg",
 * "Image00243.jpg",
 * "Image00244.jpg",
 * "Image00245.jpg",
 * "Image00246.jpg",
 * "Image00247.jpg",
 * "Image00248.jpg",
 * "Image00249.jpg",
 * "Image00250.jpg",
 * "Image00251.jpg",
 * "Image00252.jpg",
 * "Image00253.jpg",
 * "Image00254.jpg",
 * "Image00255.jpg",
 * "Image00256.jpg",
 * "Image00257.jpg",
 * "Image00026.jpg",
 * "Image00007.jpg",
 * "Image00008.jpg",
 * "Image00009.jpg",
 * "Image00036.jpg",
 * "Image00037.jpg",
 * "Image00014.jpg",
 * "Image00038.jpg",
 * "Image00039.jpg",
 * "Image00040.jpg",
 * "Image00041.jpg",
 * "Image00042.jpg",
 * "Image00043.jpg",
 * "Image00044.jpg",
 * "Image00045.jpg",
 * "Image00046.jpg",
 * "Image00047.jpg",
 * "Image00048.jpg",
 * "Image00010.jpg",
 * "Image00049.jpg",
 * "Image00050.jpg",
 * "Image00051.jpg",
 * "Image00052.jpg",
 * "Image00053.jpg",
 * "Image00054.jpg",
 * "Image00055.jpg",
 * "Image00056.jpg",
 * "Image00057.jpg",
 * "Image00058.jpg",
 * "Image00059.jpg",
 * "Image00060.jpg",
 * "Image00017.jpg",
 * "Image00061.jpg",
 * "Image00062.jpg",
 * "Image00063.jpg",
 * "Image00064.jpg",
 * "Image00065.jpg",
 * "Image00066.jpg",
 * "Image00067.jpg",
 * "Image00068.jpg",
 * "Image00069.jpg",
 * "Image00070.jpg",
 * "Image00071.jpg",
 * "Image00011.jpg",
 * "Image00012.jpg",
 * "Image00013.jpg",
 * "Image00072.jpg",
 * "Image00073.jpg",
 * "Image00074.jpg",
 * "Image00075.jpg",
 * "Image00076.jpg",
 * "Image00077.jpg",
 * "Image00078.jpg",
 * "Image00079.jpg",
 * "Image00080.jpg",
 * "Image00081.jpg",
 * "Image00082.jpg",
 * "Image00083.jpg",
 * "Image00084.jpg",
 * "Image00085.jpg",
 * "Image00086.jpg",
 * "Image00087.jpg",
 * "Image00088.jpg",
 * "Image00089.jpg",
 * "Image00090.jpg",
 * "Image00091.jpg",
 * "Image00092.jpg",
 * "Image00093.jpg",
 * "Image00015.jpg",
 * "Image00016.jpg",
 * "Image00018.jpg",
 * "Image00019.jpg",
 * "Image00020.jpg",
 * "Image00094.jpg",
 * "Image00095.jpg",
 * "Image00096.jpg",
 * "Image00097.jpg",
 * "Image00098.jpg",
 * "Image00099.jpg",
 * "Image00100.jpg",
 * "Image00101.jpg",
 * "Image00102.jpg",
 * "Image00103.jpg",
 * "Image00105.jpg",
 * "Image00106.jpg",
 * "Image00107.jpg",
 * "Image00108.jpg",
 * "Image00027.jpg",
 * "Image00028.jpg",
 * "Image00109.jpg",
 * "Image00110.jpg",
 * "Image00111.jpg",
 * "Image00029.jpg",
 * "Image00030.jpg",
 * "Image00031.jpg",
 * "Image00021.jpg",
 * "Image00112.jpg",
 * "Image00113.jpg",
 * "Image00114.jpg",
 * "Image00115.jpg",
 * "Image00116.jpg",
 * "Image00117.jpg",
 * "Image00118.jpg",
 * "Image00119.jpg",
 * "Image00120.jpg",
 * "Image00121.jpg",
 * "Image00122.jpg",
 * "Image00123.jpg",
 * "Image00124.jpg",
 * "Image00125.jpg",
 * "Image00126.jpg",
 * "Image00127.jpg",
 * "Image00128.jpg",
 * "Image00129.jpg",
 * "Image00130.jpg"
 * ]
 */
