<?php

class defsettings {

	public $cont_max;
	public $cont_min;	
	public $res_max;
	public $res_min;
	public $bright_max;
	public $bright_min;

	public $dev;
	public $mode;	// Lineart|Grayscale|Color
	public $res;	// 12..1600dpi (in steps of 1)
	public $bright;		// -127..127 (in steps of 1)
	public $cont;		// -127..127 (in steps of 1)
	// xy presets
	public $left;
	public $top;
	public $width;
	public $height;

	public $format;
	public $mailto;
	public $mailfrom;

	public $fname_custom;

	public function __construct ($cont_max,$cont_min,$res_max,$res_min,$bright_max,$bright_min,$mode,$res,$bright,$cont,$left,$top,$width,$height,$dev,$format,$mailto,$mailfrom, $fname){

		$this->cont_max=$cont_max;
		$this->cont_min=$cont_min;	
		$this->res_max=$res_max;
		$this->res_min=$res_min;
		$this->bright_max=$bright_max;
		$this->bright_min=$bright_min;

		$this->dev=$dev;
		$this->mode=$mode;	// Lineart|Grayscale|Color
		$this->res=$res;	// 12..1600dpi (in steps of 1)
		$this->bright=$bright;		// -127..127 (in steps of 1)
		$this->cont=$cont;		// -127..127 (in steps of 1)
		// xy presets
		$this->left=$left;
		$this->top=$top;
		$this->width=$width;
		$this->height=$height;
	
		$this->format=$format;
		$this->mailto=$mailto;
		$this->mailfrom=$mailfrom;
		$this->fname_custom=$fname;
	}

	public function __destruct(){
		unset ($this->cont_max);
		unset ($this->cont_min);	
		unset ($this->res_max);
		unset ($this->res_min);
		unset ($this->bright_max);
		unset ($this->bright_min);

		unset ($this->dev);
		unset ($this->mode);	// Lineart|Grayscale|Color
		unset ($this->res);	// 12..1600dpi (in steps of 1)
		unset ($this->bright);		// -127..127 (in steps of 1)
		unset ($this->cont);		// -127..127 (in steps of 1)
		// xy presets
		unset ($this->left);
		unset ($this->top);
		unset ($this->width);
		unset ($this->height);
	
		unset ($this->format);
		unset ($this->mailto);
		unset ($this->mailfrom);
		unset ($this->fname_custom);
		}

	public function dcmax(){
		return	$this->cont_max;
		}
	public function dcmin(){
		return	$this->cont_min;
		}
	public function drmax(){
		return	$this->res_max;
		}
	public function drmin(){
		return	$this->res_min;
		}
	
	public function dbmax(){
		return	$this->bright_max;
		}
	public function dbmin(){
		return	$this->bright_min;
		}
	public function ddev(){
		return	$this->dev;
		}
	public function dmode(){
		return	$this->mode;
		}
	public function dres(){
		return	$this->res;
		}
	public function dbright(){
		return	$this->bright;
		}
	public function dcont(){
		return	$this->cont;
		}
	public function dleft(){
		return	$this->left;
		}
	public function dtop(){
		return	$this->top;
		}
	public function dwidth(){
		return	$this->width;
		}
	public function dheight(){
		return	$this->height;
		}
	public function dformat(){
		return	$this->format;
		}
	public function dmailto(){
		return	$this->mailto;
		}
	public function dmailfrom(){
		return	$this->mailfrom;
		}
	public function dfname(){
		return	$this->fname_custom;
		}



}
