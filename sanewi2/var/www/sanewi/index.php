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


// first of all, load some default info, system config, and functions to use

include("/etc/sanewi/settings.cfg");
include("include/commands.php");

//initialize or reload prevoius variables
$sysSet = new syssettings($dir, $dir_spool, $dir_log, $dir_preview, 
			$cmd_scanimage, $cmd_convert,$cmd_convert_options, 
			$fname_previewid,$fname_requestid,$fname_log,$fname_out,$fname_scan, 
			$devices, 
			$formats, 
			$modes, 
			$format_scan,
			$page_bgcolor,$page_headerbgcolor,$page_tablebgcolor,	$page_cellbgcolor);

$defSet = new defsettings($contrast_max,$contrast_min,$resolution_max,$resolution_min,$brightness_max,$brightness_min,
			$preset_mode,$preset_resolution,$preset_brightness,$preset_contrast,
			$preset_left,$preset_top,$preset_width,$preset_height,
			$preset_device,
			$preset_format,
			$preset_mailto,	$preset_mailfrom, 
			$preset_customfname);




$usrSet = new usrsettings($preset_mode,$preset_resolution,$preset_brightness,$preset_contrast,
			$preset_left,$preset_top,$preset_width,	$preset_height,
			$preset_device,	
			$preset_format,
			$preset_mailto,$preset_mailfrom,
			$preset_customfname);


$usrSet->umode($_GET["mode"],$sysSet, $defSet); 
$usrSet->ures($_GET["res"],$sysSet, $defSet);
$usrSet->ubright($_GET["bright"],$sysSet, $defSet);
$usrSet->ucon($_GET["cont"],$sysSet, $defSet);
$usrSet->usel($_GET["left"],$_GET["width"],$_GET["top"],$_GET["height"],$sysSet, $defSet);
$usrSet->ufname($_GET["fname"],$sysSet, $defSet);
$usrSet->ufname_drop($_GET["fname_drop"],$sysSet,$defSet);
$usrSet->uformat($_GET["format"],$sysSet, $defSet);
$usrSet->udev($_GET["dev"],$sysSet, $defSet);
$usrSet->umail($_GET["mailto"],$_GET["mailfrom"],$sysSet, $defSet);



$session=new sstatus($sysSet->dfname_rid(),$_GET["id"],$_GET["mycmd"]);
$session->saveCurrID($sysSet->dfname_rid());


//execute command, if appropiate
if ($session->ddo()){
	$mycmd=$session->dcmd();
	if ($mycmd==dopreview) {
		doPreview($sysSet,$usrSet);
	} else if ($mycmd==doscan) {
		doScan($sysSet,$usrSet );
	} else if ($mycmd==doclear) {
		doClear($sysSet,$usrSet);
	} else if ($mycmd==dodropone) {
		doDropOne($sysSet,$usrSet);
	} else if ($mycmd==dosendmail) {
		doSendMail($sysSet,$usrSet);
	}
}

// Generate HTML output and wait for next command
generateHTML($sysSet, $usrSet, $defSet,$session);

// destruct variables
$session->__destruct();
$usrSet->__destruct();
$defSet->__destruct();
$sysSet->__destruct();

?>
