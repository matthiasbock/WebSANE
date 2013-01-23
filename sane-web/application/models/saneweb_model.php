<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saneweb_model extends CI_Model
{
    protected $CI ;
    protected $config = array();

    public function __construct()
    {
        parent::__construct();

        $this->CI =& get_instance();
        $this->CI->config->load('saneweb', TRUE);
    }

    protected function get_config($item)
    {
        return $this->CI->config->item($item, 'saneweb');
    }

    public function get_all_doc()
    {
        $ary = array();
        $dir = $this->get_config('cache_dir') . '/doc/' ;

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    $f = $dir . $file ;
                    if(is_file($f))
                    {
                        if( pathinfo($f, PATHINFO_EXTENSION) == 'pnm')
                        {
                            $ary[] = pathinfo($f, PATHINFO_FILENAME);
                        }
                    }
                }
                closedir($dh);
            }
        }

        return $ary ;
    }

}

/* End of file model/saneweb_model.php */

