<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Saneweb
 * A php frontend for SANE running in batch mode
 *
 * @package		codzoo.saneweb
 * @author		neil.fan@live.com
 * @copyright	Copyright (c) 2008 - 2011, Codzoo, Inc.
 * @link		http://codzoo.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * SANE Manipulation class
 *
 * @package		codzoo.saneweb
 * @category	Sane_lib
 * @author		neil.fan@codzoo.com
 * @link		http://codzoo.com
 */
class Scanner{

    /**
     * @const scanner is not running
     */
    const STATUS_STOP  = 0x0000 ;

    /**
     * @const status the scanner is ready
     */
    const STATUS_READY = 0x0001 ;
    /**
     * @const scanner is busy with a job
     */
    const STATUS_BUSY  = 0x0010 ;

    /**
     * @const file name format in batch mode
     */
    const BATCH_FORMAT = '%04d.pnm';

    private $config ;

    public function __construct($parameters=array())
    {
        $CI =& get_instance();
        $CI->config->load('saneweb', TRUE);
        $this->config = $CI->config->item('saneweb');

		if ( ! empty($parameters))
        {
            $this->config = array_merge($this->config, $parameters);
        }
    }

    protected function config_item($item, $default_value=NULL)
    {
        return 
            isset($this->parameters[$item]) ?
            $this->parameters[$item] :
            $default_value ;
    }


    private function get_current_batch_start_number()
    {
    }

    public function get_list()
    {
        $scanners = array();
        $cmd = 'scanimage -f "%i|%m|%v|%t|%d%n" ';
        exec($cmd, $output);
        if($output)
        {
            foreach($output as $line)
            {
                $ary = explode('|', $line);
                $scanners[] = array(
                    'index'    => $ary[0],
                    'model'    => $ary[1],
                    'vendor'    => $ary[2],
                    'type'    => $ary[3],
                    'device'    => $ary[4]
                );
            }
        }

        return $scanners ;
    }

    public function get_supported_options($device)
    {
        $cmd = sprintf('scanimage -A -d "%d"', $device) ;
    }

    public function start_scanning($device='', $options=array())
    {
    }
}

/* End of file Saneweb.php */
