<?php
/**
 * Created by PhpStorm.
 * User: steevenz
 * Date: 23/08/2016
 * Time: 19:25
 */

namespace O2System\Gears;

class Toolbar
{
	public function getOutput()
	{
		ob_start();
		include GEARSPATH . 'Views/Toolbar.php';
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}
}