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
 * Sane Document Manipulation class
 *
 * @package		codzoo.saneweb
 * @category	Sane_lib
 * @author		neil.fan@codzoo.com
 * @link		http://codzoo.com
 */
class Document{

    const DEFAULT_THUMB_SIZE = 160 ;
    const DEFAULT_PREVIEW_SIZE = 600 ;

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

    private function config_item($item, $default_value=NULL)
    {
        return 
            isset($this->config[$item]) ?
            $this->config[$item] :
            $default_value ;
    }

    public function get_document_list()
    {
        $ary = array();
        $dir = $this->config_item('data_path') . '/doc/' ;

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

        // sort all docs from newest to oldest
        rsort($ary) ;

        return $ary ;
 
    }


    public function get_doc($fname)
    {
        return $this->config_item('data_path') . '/doc/' . $fname.'.pnm' ;
    }

    public function get_thumb($fname)
    {
        return $this->config_item('data_path') . '/thumb/' . $fname.'.jpg' ;
    }

    public function get_preview($fname)
    {
        return $this->config_item('data_path') . '/preview/' . $fname.'.jpg' ;
    }

    public function reset($fname)
    {
        $doc     =  $this->get_doc($fname);
        $thumb   =  $this->get_thumb($fname);
        $preview =  $this->get_preview($fname);

        // first, create the thumb image
        // -2 to give space for the border;
        $size_thumb = $this->config_item('size_thumb', self::DEFAULT_THUMB_SIZE) - 2;
        $cmd = sprintf(
            'convert -quiet "%s" -strip -thumbnail "%dx%d>" -gravity center -compress JPEG -quality 80 -border 1 "%s" ',
            $doc,
            $size_thumb,
            $size_thumb,
            $thumb
        );
        exec($cmd);

        // then, create the preview image
        // -2 to give space for the border;
        $size_preview = $this->config_item('size_preview', self::DEFAULT_PREVIEW_SIZE) - 2;
        $cmd = sprintf(
            'convert -quiet "%s" -strip -thumbnail "%dx%d>" -gravity center -compress JPEG -quality 80 -border 1 "%s" ',
            $doc,
            $size_preview,
            $size_preview,
            $preview
        );
        exec($cmd);
    }



}

/* End of file Saneweb.php */

