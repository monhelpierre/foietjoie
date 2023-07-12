<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
// require_once(dirname(__FILE__).'/examples/lang/eng.php');
class Pdf extends Tcpdf
{
	
	function __construct()
	{
		parent::__construct();
	}

}
 ?>