<?php

//
// Copyright (c) 2003 Gunars Benga (e-mail: benga@parks.lv; gbenga@users.sourceforge.net)
//
// This file is part of SANE Web Interface.
//
// SANE Web Interface is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
//
// SANE Web Interface is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with SANE Web Interface; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
//

include("include/sysSettings.php");
include("include/defSettings.php");

class usrsettings {
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
	public $fname_drop;


	public function __construct($mode,$res,$bright,$cont,$left,$top,$width,$height,$dev,$format,$mailto,$mailfrom, $fname){
		 	$this->mode=$mode;
		 	$this->res=$res;
		 	$this->bright=$bright;
		 	$this->cont=$cont;
			$this->left=$left;
		 	$this->top=$top;
 			$this->width=$width;
		 	$this->height=$height;
		  	$this->format=$format;
			$this->dev=$dev;
			$this->mailto=$mailto;
			$this->mailfrom=$mailfrom;		
			$this->fname_custom=$fname;
			$this->fname_drop="";
			

		}

	public function __destruct(){
			unset ($this->mode);
			unset ($this->res);
			unset ($this->bright);
			unset ($this->cont);
			unset ($this->left);
			unset ($this->top);
			unset ($this->width);
			unset ($this->height);
			unset ($this->format);
			unset ($this->dev);
			unset ($this->mailto);
			unset ($this->mailfrom);
			unset ($this->fname_custom);
			unset ($this->fnmae_drop);
		}

	public function dfname_drop(){
			return	$this->fname_drop;
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
	


	public function ufname_drop($fname, $syssettings,$defsettings ){

			$this->fname_drop=$fname;
		}

	public function udev($dev, $syssettings,$defsettings ){


			if ( in_array(trim($dev),$syssettings->ddevs())) {
				$this->dev=$dev;
			}
			else{
				$this->dev=$defsettings->ddev();
			}

		}

	public function ucon($cont, $syssettings, $defsettings ){
			
			if ((trim($cont)!="")&&(($cont<=$defsettings->dcmax())&&($cont>=$defsettings->dcmin()   ))) {
				$this->cont=$cont;
			}
			else	{
				$this->cont=$defsettings->dcont();
			}
		}

	public function umode($mode,$syssettings,$defsettings) {
	
			// check new mode is ok

			$m_tmp=trim($mode);
			
			if (in_array($m_tmp,$syssettings->dmodes()))	{
				$this->mode=$m_tmp;
			}
			else {
				$this->mode=$defsettings->dmode();
			}
		}

	public function ures($res, $syssettings, $defsettings){

			if ((trim($res)!="")&&(($res<=$defsettings->drmax())&&($res>=$defsettings->drmin()))) {
				$this->res=$res;
			}
			else{
				$this->res=$defsettings->dres();
			}

		}

	public function ubright($bright, $syssettings, $defsettings){
		
			
			if ((trim($bright)!="")&&  (($bright<=$defsettings->dbmax())&&($bright>=$defsettings->dbmin()))  ) {
				$this->bright=$bright;
			}
			else{
				$this->bright=$defsettings->dbright();
			}
		}

	public function usel($left, $width, $top, $height, $syssettings, $defsettings){

			$l=trim($left);
			$r=trim($width);
			$u=trim($top);
			$d=trim($height);
	
			if (($l!="") && (($defsettings->dleft()<=$l)&&($l<=$defsettings->dwidth()))){
				$this->left=$l; }
			else {
				$this->left=$defsettings->dleft();
			}	

			if (($u!="") && (($defsettings->dtop()<=$u)&&($u<=$defsettings->dheight()))){
				$this->top=$u; }
			else{
				$this->top=$defsettings->dtop();
			}


			if (($r!="") && ( ($l<=$r)&& ($r<=$defsettings->dwidth()) )) {
				$this->width=$r; }
			else {
				$this->width=$defsettings->dwidth();
			}


		
			if (($d!="") && (( $u<=$d)&& ($d<=$defsettings->dheight()))   ){
				$this->height=$d; }
			else {
				$this->height=$defsettings->dheight();
			}
		}	


	public function ufname($fn, $syssettings, $defsettings){

	
			if (trim($fn)!="") {
				$this->fname_custom=$fn;
			}
		}

	public function uformat($format, $syssettings, $defsettings){
			$f=trim($format);
			if (in_array($f,$syssettings->dformats())) {
				$this->format=$f;
			}
		}

	
	public function umail($mailto, $mailfrom){

			$to=trim($mailto);
			$from=trim($from);
			if ($to!="") {
				$this->mailto=$to;
			}

			if ($from!="") {
				$this->mailfrom=$from;
			}
		}


}


?>
