<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
        return $this->frame();
	}

    /**
     * Display the main frame
     */
    public function frame()
    {
        $this->load->view('front/frame');
    }
}

/* End of file front.php */
/* Location: ./application/controllers/front.php */

