<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doc_model extends Saneweb_model
{
    protected $fname ;

    /**
     * init with a fname
     */
    public function set_fname($fname)
    {
        $this->fname = $fname ;
    }

    public function validate()
    {
        return $fname && is_file($this->get_doc_path());
    }

    /**
     * Path for the doc file
     * @return string path
     */
    protected function get_doc_path()
    {
        return $this->get_config('cache_dir') . '/doc/' . $fname.'.pnm' ;
    }

    /**
     * Path for the thumb file
     * @return string path
     */
    protected function get_thumb_path()
    {
        return $this->get_config('cache_dir') . '/thumb/' . $fname.'.png' ;
    }

    /**
     * Path for the preview file
     * @return string path
     */
    protected function get_preview_path()
    {
        return $this->get_config('cache_dir') . '/preview/' . $fname.'.png' ;
    }

    /**
     * reset the thumb and preview image
     */
    protected function reset_preview_path()
    {
        $doc     =  $this->get_doc_path();
        $thumb   =  $this->get_thumb_path();
        $preview =  $this->get_preview_path();

        $size_preview = $this->get_config('size_preview');

        // first, create the thumb image
        // -2 to give space for the border;
        $size_thumb = $this->get_config('size_thumb') - 2;
        $cmd = sprintf(
            'convert -quiet "%s" -thumbnail "%dx%d>" -gravity center -quality 95 -border 1 "%s" ',
            $doc,
            $size_thumb,
            $size_thumb,
            $thumb
        );
        exec($cmd);

        // then, create the preview image
        // -2 to give space for the border;
        $size_preview = $this->get_config('size_preview') - 2;
        $cmd = sprintf(
            'convert -quiet "%s" -thumbnail "%dx%d>" -gravity center -quality 95 -border 1 "%s" ',
            $doc,
            $size_preview,
            $size_preview,
            $preview
        );
        exec($cmd);


    }


}

/* End of file model/saneweb/doc_model.php */
