<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {

    /**
     * how many files to display per page
     */
    const COUNT_PER_PAGE = 24 ;
    const DIR_PNM        = 'cache/pnm' ;
    const DIR_THUMB      = 'cache/thumb' ;
    const EXT_PNM        = 'pnm' ;
    const EXT_THUMB      = 'png' ;
    const SIZE_THUMB     = 160 ;
    const SIZE_PREVIEW   = 600 ;

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
        $this->load->helper('url');
        redirect('/');
	}

    public function get_documents($from=0)
    {
        header("Content-Type: application/json");

        $this->load->library('saneweb/document');
        $docs = $this->document->get_document_list();

        $documents = array() ;
        foreach($docs as $doc)
        {
            $documents[] = array(
                'doc'=>$doc,
                'thumb'=>$this->document->get_thumb($doc),
                'preview'=>$this->document->get_preview($doc)
            );
        }
        echo json_encode($documents);
    }


    public function get_thumb($fname)
    {
        $this->load->library('saneweb/document');
        $thumb = $this->document->get_thumb($fname) ;

        $this->load->helper('url');
        redirect($thumb, 'location', 301);
        exit();
    }

    public function get_preview($fname)
    {
        $this->load->library('saneweb/document');
        $preview = $this->document->get_preview($fname) ;

        $this->load->helper('url');
        redirect($preview, 'location', 301);
    }

    public function reset_all()
    {
        $this->load->library('saneweb/document');
        $docs = $this->document->get_document_list();
        foreach($docs as $doc)
        {
            $this->document->reset($doc) ;
        }
    }

}

/* End of file service.php */
