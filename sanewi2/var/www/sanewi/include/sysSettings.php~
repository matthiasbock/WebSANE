<?php

class syssettings {
		
	public $dir;
	public $dir_spool;
	public $dir_log;
	public $dir_preview;

	public $cmd_scanimage;
	public $cmd_convert;
	public $cmd_convert_options;

	public $fname_previewid;
	public $fname_requestid;

	public $fname_log;
	public $fname_out;
	public $fname_scan;

	public $devices;
	public $formats;
	public $modes;
	public $format_scan;

	public $page_bgcolor;
	public $page_headerbgcolor;
	public $page_tablebgcolor;
	public $page_cellbgcolor;





	public function __construct ($dir, $dir_spool, $dir_log, $dir_preview, 
				$cmd_scanimage, $cmd_convert,$cmd_convert_options, 
				$fname_previewid,$fname_requestid,$fname_log,$fname_out,$fname_scan, 
				$devices, 
				$formats, 
				$modes, 
				$format_scan,
				$page_bgcolor,$page_headerbgcolor,$page_tablebgcolor,	$page_cellbgcolor)
	{
		$this->dir_preview=$dir_preview;
		$this->dir_spool=$dir_spool;
		$this->cmd_scanimage=$cmd_scanimage;
		$this->cmd_convert=$cmd_convert;
		$this->dir=$dir;
		$this->dir_log=$dir_log;
		$this->cmd_convert_options=$cmd_convert_options;
		$this->format_scan=$format_scan;
		$this->fname_previewid=$fname_previewid;
		$this->fname_requestid=$fname_requestid;
		$this->fname_log=$fname_log;
		$this->fname_out=$fname_out;
		$this->fname_scan=$fname_scan;

		$this->devices=$devices;
		$this->formats=$formats;
		$this->modes=$modes;	
		$this->page_bgcolor=$page_bgcolor;
		$this->page_headerbgcolor=$page_headerbgcolor;
		$this->page_tablebgcolor=$page_tablebgcolor;
		$this->page_cellbgcolor=$page_cellbgcolor;
	}

	public function __destruct(){
		unset ($this->dir_preview);
		unset ($this->dir_spool);
		unset ($this->cmd_scanimage);
		unset ($this->cmd_convert);
		unset ($this->dir);
		unset ($this->dir_log);
		unset ($this->cmd_convert_options);
		unset ($this->format_scan);
		unset ($this->fname_previewid);
		unset ($this->fname_requestid);
		unset ($this->fname_log);
		unset ($this->fname_out);
		unset ($this->fname_scan);

		unset ($this->devices);
		unset ($this->formats);
		unset ($this->modes);	
		unset ($this->page_bgcolor);
		unset ($this->page_headerbgcolor);
		unset ($this->page_tablebgcolor);
		unset ($this->page_cellbgcolor);
		}

	public function ddir(){
			return	$this->dir;
		}
	public function ddir_spool(){
			return	$this->dir_spool;
		}
	public function ddir_preview(){
			return	$this->dir_preview;
		}
	public function dscanimage(){
			return	$this->cmd_scanimage;
		}
	public function dconvert(){
			return	$this->cmd_convert;
		}
	public function dconvert_options(){
			return	$this->cmd_convert_options;
		}
	public function dfname_pid(){
			return	$this->fname_previewid;
		}
	public function dfname_rid(){
			return	$this->fname_requestid;
		}
	public function dfname_log(){
			return	$this->fname_log;
		}
	public function dfname_out(){
			return	$this->fname_out;
		}
	public function dfname_scan(){
			return	$this->fname_scan;
		}
	public function ddevs(){
			return	$this->devices;
		}
	public function dformats(){
			return	$this->formats;
		}
	public function dformat_scan(){
			return	$this->format_scan;
		}
	public function dmodes(){
			return	$this->modes;
		}
	public function dpage_bgcolor(){
			return	$this->page_bgcolor;
		}
	public function dpage_headerbgcolor(){
			return	$this->page_headerbgcolor;
		}
	public function dpage_tablebgcolor(){
			return	$this->page_tablebgcolor;
		}
	public function dpage_cellbgcolor(){
			return	$this->page_cellbgcolor;
		}

}
?>
