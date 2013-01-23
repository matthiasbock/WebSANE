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

// define a structured data type holding one instance information

include("include/usrSettings.php");
include("include/sstatus.php");
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// PHP functions running at the server
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function doPreview($sysSettings, $usrSettings) {


	$timestamp=time();

	// Put down new preview image ID


	 $fp = fopen($sysSettings->dfname_pid(), "w");
	 fputs($fp, "$timestamp");
	 fclose($fp);

	// Generate new SVG, containing latest preview ID	

	 $fp = fopen("preview.svg", "w");


	fputs($fp, "<?xml version=\"1.0\"?>
	<svg  width=\"230\" height=\"370\"
		style=\"text-rendering:optimizeSpeed; shape-rendering:optimizeSpeed; image-rendering:optimizeSpeed;\" 
		xmlns=\"http://www.w3.org/2000/svg\"	 		 
		xmlns:xlink=\"http://www.w3.org/1999/xlink\" 
		xmlns:svg=\"http://www.w3.org/2000/svg\">

		<rect id=\"bkgrnd\" x=\"0\" y=\"0\" width=\"230px\" height=\"370px\" stroke=\"none\" fill=\"#E0E0E0\"/> 

		<image x=\"0\" y=\"0\" width=\"230px\" height=\"370px\" xlink:href=\"{$sysSettings->ddir_preview()}/$timestamp.png\"></image>

		<rect id=\"bkgrnd\" x=\"0\" y=\"0\" width=\"229px\" height=\"369px\" stroke=\"green\" fill=\"none\"/> 

		<g id=\"selector\" stroke=\"blue\" transform=\"translate(0,0)\" >
			<rect  id=\"rubberband\"  x=\"0\" y=\"0\"  width=\"0\" height=\"0\"  fill=\"none\"  stroke=\"blue\"  stroke-width=\"1\"/> 
		</g>
   	</svg>");
	fclose($fp);
	if ((trim($sysSettings->ddir())!="") && (trim($sysSettings->ddir_preview())!="") ){

	system("#!/bin/sh
		rm -f {$sysSettings->ddir()}/{$sysSettings->ddir_preview()}/*.{$sysSettings->dformat_scan()}
		rm -f  {$sysSettings->ddir()}/{$sysSettings->ddir_preview()}/*.png
		if [  $(echo {$usrSettings->ddev()}|grep test) ==\"\"  ]; then

			{$sysSettings->dscanimage()}  \\
			--preview=yes \\
			--device {$usrSettings->ddev()} \\
			>  {$sysSettings->ddir()}/{$sysSettings->ddir_preview()}/$timestamp.{$sysSettings->dformat_scan()} \\
			2>> {$sysSettings->dfname_log()};
		else
			{$sysSettings->dscanimage()}  \\
				--device {$usrSettings->ddev()} \\
				>  {$sysSettings->ddir()}/{$sysSettings->ddir_preview()}/$timestamp.{$sysSettings->dformat_scan()} \\
				2>> {$sysSettings->dfname_log()};
		fi;		


		{$sysSettings->dconvert()} \\
			  {$sysSettings->ddir()}/{$sysSettings->ddir_preview()}/$timestamp.{$sysSettings->dformat_scan()} \\
			 {$sysSettings->dconvert_options()} \\
			  {$sysSettings->ddir()}/{$sysSettings->ddir_preview()}/$timestamp.png \\
			 2>> {$sysSettings->dfname_log()};
		");
	}

}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function doScan($sysSet,$usrSet) {

if (trim($usrSet->dfname())=="") {
	$hostname=gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$scantimestamp=date("d.m.y_H:i:s");
	$newfname="${hostname}_${scantimestamp}";

} else {
	$newfname=$usrSet->dfname();
}
	if ((trim($sysSet->ddir())!="") && (trim($sysSet->ddir_spool())!="")){

		system("
		#!/bin/sh\
		myfname=\"$newfname\";
		if [ -f   {$sysSet->ddir()}/{$sysSet->ddir_spool()}/\$myfname.{$usrSet->dformat()} ]; then
			mydate=`date +%T`;
			myfname=\"\${myfname}_\${mydate}\";
		fi;
		if [  $(echo {$usrSet->ddev()}|grep test) == \"\"  ]  ;then
			{$sysSet->dscanimage()} \\
			--device {$usrSet->ddev()} \\
			--mode {$usrSet->dmode()} \\
			--resolution {$usrSet->dres()} \\
			--contrast {$usrSet->dcont()} \\
			-l {$usrSet->dleft()} \\
			-t {$usrSet->dtop()} \\
			-x {$usrSet->dwidth()} \\
			-y {$usrSet->dheight()} \\
			> {$sysSet->dfname_out()}.{$sysSet->dformat_scan()} 	\\
			2>> {$sysSet->dfname_log()} ;
		else
			{$sysSet->dscanimage()} \\
			--device {$usrSet->ddev()} \\
			> {$sysSet->dfname_out()}.{$sysSet->dformat_scan()} \\
			2>> {$sysSet->dfname_log()} ;
		fi;

		{$sysSet->dconvert()}  \\
			{$sysSet->dfname_out()}.{$sysSet->dformat_scan()} \\
			{$sysSet->dconvert_options()} \\
			 {$sysSet->ddir()}/{$sysSet->ddir_spool()}/\$myfname.{$usrSet->dformat()} \\
			2>> {$sysSet->dfname_log()};
		");
	}
}

//++++++++++++++++++++++++
function doSendMail($sysSettings, $usrSettings){
	passthru("EMAIL={$usrSettings->dmailfrom()};
				mutt -s \"Scanned file {$usrSettings->dfname()} from {$usrSettings->ddev()} at {$_SERVER['SERVER_NAME']} \" \\
				-a $fname \\
				{$usrSettings->dmailto()} \\
				2>> {$sysSettings->dfname_log()};
		  ");
}


//delete commands
//++++++++++++++++++++++++
function doClear($sysSet,$usrSet) {
	if ((trim($sysSet->ddir())!="") && (trim($sysSet->ddir_spool())!="")){
		system("rm -f  {$sysSet->ddir()}/{$sysSet->ddir_spool()}/*.*");
	}
}

//++++++++++++++++++++++++
function doDropOne($sysSet,$usrSet) {
	if ((trim($sysSet->ddir())!="") && (trim($sysSet->ddir_spool())!=""))
	{
		system("rm -f  {$sysSet->ddir()}/{$sysSet->ddir_spool()}/{$usrSet->dfname_drop()}");
	}
}














//+++++++++++++++++++++++
//Display commands

function append_modes($sysSet,$usrSet){ 

	echo("<SELECT NAME=\"mode\">");

	$tmp=$sysSet->dmodes();
	for( $i=0; $i<(sizeof($tmp)); $i++){

		if ($usrSet->dmode()==$tmp[$i]){	
			echo ("<OPTION VALUE= $tmp[$i] SELECTED>$tmp[$i] ");
		}
		else {
			echo("<OPTION VALUE=\"$tmp[$i]\">$tmp[$i]");
		}
	}
	unset($tmp);

	echo("</SELECT>");
}

function append_formats($sysSet,$usrSet){ 

	echo("<SELECT NAME=\"format\"> ");
	$tmp=$sysSet->dformats();
	for( $i=0; $i<(sizeof($tmp)); $i++){

		if ($usrSet->dformat()==$tmp[$i]){	
			echo ("<OPTION VALUE= $tmp[$i] SELECTED>$tmp[$i] ");
		}
		else {
			echo("<OPTION VALUE=\"$tmp[$i]\">$tmp[$i]");
		}
	}
	unset($tmp);
	echo("	</SELECT> ");
}

function append_devices($sysSet,$usrSet){ 

	echo("<SELECT NAME=\"dev\">");
	$tmp=$sysSet->ddevs();
	for( $i=0; $i<(sizeof($tmp)); $i++){
		if ($usrSet->ddev()==$tmp[$i]){	
			echo ("<OPTION VALUE= $tmp[$i] SELECTED>$tmp[$i] ");
		}
		else {
			echo("<OPTION VALUE=\"$tmp[$i]\">$tmp[$i]");
		}
	}
	unset($tmp);
	echo("</SELECT>");
}

function append_current_files($sysSet,$usrSet){



	echo("	<Table align=\"center\">
			
				<TH><A HREF=\"help.php#scans\">Scan folder</A></TH>
				<TR>
					<TD VALIGN=TOP> ");
	
					

	$u="{$sysSet->ddir()}/{$sysSet->ddir_spool()}";
	$handle=opendir($u); 
	while ($file = readdir($handle)) { 
		if ($file!="." && $file!=".." && !eregi(".{$sysSet->dformat_scan()}",$file) && !eregi(".log",$file)) { 
	        	echo("<LI><A HREF=\"spool/$file\"\n>$file</A>"); 
	//		echo(" <A HREF=\"javascript:j_ask_send_mail('$file')\"><FONT COLOR=RED>Mail To</FONT></A>");	 
			echo(" <A HREF=\"javascript:j_ask_drop_one('$file')\"><FONT COLOR=RED>X</FONT></A>");	 
		} 
	}
	closedir($handle);
	unset($u); 
	
	echo("				</TD>
				</TR>
			</table>
		");

}

function append_bottom(){
	echo("

		<TABLE BORDER=0 WIDTH=100%>
			<TR>
				<TD COLSPAN=2>
					<HR COLOR=green>
				</TD>
			</TR>
			<TR>
				<TD ALIGN=CENTER COLSPAN=2>
					Copyright (c) 2010 <A HREF=\"mailto:nicolasb.info@gmail.com?subject=SANE_Web_Interface\">Nicolas Bardier</A> and 2003 <A HREF=\"mailto:benga@parks.lv?subject=SANE_Web_Interface\">Gunars Benga</A>
				</TD>
			</TR>
			<TR>
				<TD ALIGN=CENTER COLSPAN=2>
					<A HREF=\"http://sourceforge.net/projects/sanewi\">SANE Web Interface</A> is free software distributed under the terms of the 
					<A HREF=\"http://www.gnu.org/licenses/gpl.html\">GNU General Public License</A>
				</TD>
			</TR>
		</TABLE>");
}

	function append_head(){
		echo("
			<TABLE  BORDER=0 WIDTH=100%>
				<TR>
					<TD COLSPAN=2>
						<HR COLOR=green>
					</TD>
				</TR>
				<TR>
					<TD>
						<B>SANE Web Interface<B>
					</TD>
					<TD ALIGN=RIGHT>
						<A HREF=\"help.php\">Help</A>
					</TD>
				</TR>
				<TR>
					<TD COLSPAN=2>
						<HR COLOR=green>
					</TD>
				</TR>	
			</TABLE>
		");
	}


function generateHTML($sysSet, $usrSet, $defSet,$session){

	echo("<?xml version=\"1.0\"?>

	<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
      		<html  lang=\"en\" xml:lang=\"en\">
		    <HEAD>
		    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1257\">	
		    <meta http-equiv=\"Pragma\" content=\"no-cache\">
		    <link HREF=\"style/style.css\" REL=STYLESHEET>
			<TITLE>SANE Web Interface</TITLE>
		    </HEAD>

		<BODY BACKGROUND=\"images/bg.gif\">

			<FORM 
			NAME=\"controlform\"
			ACTION=\"index.php?mycmd=dopreview\"
			METHOD=\"post\"
			ENCTYPE=\"multipart/form-data\">");

			append_head();

	
	echo("		
			<TABLE Align=\"center\" BORDER=0>
				<TR>
					<TH><A HREF=\"help.php#options\">Options</A></TH>
					<TH><A HREF=\"help.php#preview\">Preview</A></TH>
					<TH><A HREF=\"help.php#control\">Control</A></TH>
					
				</TR>
				<TR>
					<TD VALIGN=\"TOP\">	

	
						<TABLE BORDER=\"0\">
							<TR>
								<TD ALIGN=\"left\">Mode:</TD>
								<TD>");

	append_modes($sysSet,$usrSet);		
	echo("							</TD>
								<TD></TD>
							</TR>
							<TR>
								<TD COLSPAN=\"2\"><HR></TD>
							</TR>
							<TR>
								<TD ALIGN=\"left\">Resolution:</TD>
								<TD>
									<INPUT TYPE=\"text\" NAME=\"res\" SIZE=\"6\" VALUE=\"{$usrSet->dres()}\">
								</TD>
							</TR>

							<TR>
								<TD COLSPAN=\"2\">(12..1600dpi in steps of 1)</TD>
							</TR>

							<TR>
								<TD COLSPAN=\"2\"><HR></TD>
							</TR>

							<TR>
								<TD ALIGN=\"left\">Brightness:</TD>
								<TD><INPUT TYPE=\"text\" NAME=\"bright\" SIZE=\"6\" VALUE=\"{$usrSet->dbright()}\"></TD>

							<TR>
								<TD COLSPAN=\"2\">(-127..127 in steps of 1)</TD>
							</TR>

							<TR>	
								<TD COLSPAN=\"2\"><HR></TD>
							</TR>

							<TR>
								<TD ALIGN=\"left\">Contrast:</TD>
								<TD><INPUT TYPE=\"text\" NAME=\"cont\" SIZE=\"6\" VALUE=\"{$usrSet->dcont()}\"></TD>
							</TR>

							<TR>
								<TD COLSPAN=\"2\">(-127..127 in steps of 1)</TD>
							</TR>

							<TR>
								<TD COLSPAN=\"2\"><HR></TD>
							</TR>
							<TR>
								<TD ALIGN=\"left\">Left:</TD>
								<TD><INPUT TYPE=\"text\" NAME=\"left\" SIZE=\"6\" VALUE=\"{$usrSet->dleft()}\"></TD>
							</TR>

							<TR>
								<TD ALIGN=\"left\">Top:</TD>
								<TD><INPUT TYPE=\"text\" NAME=\"top\" SIZE=\"6\" VALUE=\"{$usrSet->dtop()}\"></TD>
							</TR>

							<TR>
								<TD ALIGN=\"left\">Width:</TD>
								<TD><INPUT TYPE=\"text\" NAME=\"width\" SIZE=\"6\" VALUE=\"{$usrSet->dwidth()}\"></TD>
							</TR>

							<TR>
								<TD ALIGN=\"left\">Height:</TD>
								<TD><INPUT TYPE=\"text\" NAME=\"height\" SIZE=\"6\" VALUE=\"{$usrSet->dheight()}\"></TD>
							</TR>

							<TR>
								<TD COLSPAN=\"2\"><HR></TD>
							</TR>

						</TABLE>
					



							<TD VALIGN=TOP>
					");

//

echo("<EMBED  WIDTH=\"230px\" HEIGHT=\"370px\" SRC=\"preview.svg\" type=\"image/svg+xml\" wmode=\"transparent\">");
echo("
							</TD>
						<TD VALIGN=\"TOP\">


						<TABLE BORDER=0>
					

							<TR>
								<TD COLSPAN=\"2\" ALIGN=\"left\">Filename:</BR>
								<!--{$usrSet->dfname()} -->
								<INPUT TYPE=\"text\" SIZE=\"16\" NAME=\"fname\" value=\"\">
								</TD>
							</TR>	
							<TR>
								<TD COLSPAN=\"2\"><HR></TD>
							</TR>

							<TR>
								<TD ALIGN=\"left\">Image format:</TD>
								<TD>");
	append_formats($sysSet,$usrSet);
	echo("							</TD>
							</TR>

							<TR>
								<TD COLSPAN=\"2\"><HR></TD>
							</TR>

							<TR>
								<TD ALIGN=\"left\">Select scanner:</TD>
								<TD>");

	append_devices($sysSet,$usrSet);
	echo("							</TD>
							</TR>

							<TR>
								<TD COLSPAN=\"2\"><HR></TD>
							</TR>

							<TR>
								<TD ALIGN=LEFT VALIGN=TOP>
									<A HREF=\"javascript:j_ask_preview()\"><img border=0 src=\"images/preview.gif\"></A>
									<A HREF=\"javascript:j_ask_preview()\">Get preview</A>
								</TD>
							</TR>
							<TR>
								<TD ALIGN=LEFT VALIGN=TOP>
									<A HREF=\"javascript:j_ask_scan()\"><img border=0 src=\"images/scan.gif\"></A>
									<A HREF=\"javascript:j_ask_scan()\">Scan new</A>
								</TD>
							</TR>
							<TR>
								<TD ALIGN=LEFT VALIGN=TOP>
									<HR>
								</TD>
							</TR>
							<TR>
								<TD ALIGN=LEFT VALIGN=TOP>
									<A HREF=\"javascript:j_ask_clear()\"><img border=0 src=\"images/clear.gif\"></A>
									<A HREF=\"javascript:j_ask_clear()\">Drop scans</A>
								</TD>
							</TR>
						
						</TABLE>

					</TD>
					
				</TR>
			</TABLE>
			<HR COLOR=green>");
			
	append_current_files($sysSet,$usrSet);
	echo("</FORM>");
	append_bottom();





//.................................................................................
// Javascript functions embedded in served document

// Javascript functions embedded in served document
// Javascript functions embedded in served document
//.................................................................................


	echo("
	<script language=javascript>
		var htmldocument=document;

function j_ask_preview()
{
var formObj = document.controlform;
<!--var formObj2 = document.controlform2;-->
var formMode=formObj.mode.value;
var formResolution=formObj.res.value;
var formBrightness=formObj.bright.value;
var formContrast=formObj.cont.value;

var formLeft=formObj.left.value;
var formTop=formObj.top.value;
var formWidth=formObj.width.value;
var formHeight=formObj.height.value;
var formCustomfname=formObj.fname.value;
var formFormat=formObj.format.value;
var formDevice=formObj.dev.value;


document.location.href=\"index.php?\
mycmd=dopreview&\
id={$session->dnextID()}&\
dev=\"+formDevice+\"&\
mode=\"+formMode+\"&\
res=\"+formResolution+\"&\
bright=\"+formBrightness+\"&\
cont=\"+formContrast+\"&\
left=\"+formLeft+\"&\
top=\"+formTop+\"&\
width=\"+formWidth+\"&\
height=\"+formHeight+\"&\
fname=\"+formCustomfname+\"&\
format=\"+formFormat

}

function j_ask_scan()
{
var formObj = document.controlform;

var formMode=formObj.mode.value;
var formResolution=formObj.res.value;
var formBrightness=formObj.bright.value;
var formContrast=formObj.cont.value;

var formLeft=formObj.left.value;
var formTop=formObj.top.value;
var formWidth=formObj.width.value;
var formHeight=formObj.height.value;
var formCustomfname=formObj.fname.value;
var formFormat=formObj.format.value;
var formDevice=formObj.dev.value;


document.location.href=\"index.php?\
mycmd=doscan&\
id={$session->dnextID()}&\
dev=\"+formDevice+\"&\
mode=\"+formMode+\"&\
res=\"+formResolution+\"&\
bright=\"+formBrightness+\"&\
cont=\"+formContrast+\"&\
left=\"+formLeft+\"&\
top=\"+formTop+\"&\
width=\"+formWidth+\"&\
height=\"+formHeight+\"&\
fname=\"+formCustomfname+\"&\
format=\"+formFormat
}

function j_ask_clear()
{

var formObj = document.controlform;

var formMode=formObj.mode.value;
var formResolution=formObj.res.value;
var formBrightness=formObj.bright.value;
var formContrast=formObj.cont.value;

var formLeft=formObj.left.value;
var formTop=formObj.top.value;
var formWidth=formObj.width.value;
var formHeight=formObj.height.value;
var formCustomfname=formObj.fname.value;
var formFormat=formObj.format.value;
var formDevice=formObj.dev.value;

var response = confirm('You will loose all scans. Sure to delete?');
if (response) {
document.location.href=\"index.php?mycmd=doclear&\
id={$session->dnextID()}&\
dev=\"+formDevice+\"&\
mode=\"+formMode+\"&\
res=\"+formResolution+\"&\
bright=\"+formBrightness+\"&\
cont=\"+formContrast+\"&\
left=\"+formLeft+\"&\
top=\"+formTop+\"&\
width=\"+formWidth+\"&\
height=\"+formHeight+\"&\
fname=\"+formCustomfname+\"&\
format=\"+formFormat

}
}

function j_ask_drop_one(fname)
{

var formObj = document.controlform;

var formMode=formObj.mode.value;
var formResolution=formObj.res.value;
var formBrightness=formObj.bright.value;
var formContrast=formObj.cont.value;

var formLeft=formObj.left.value;
var formTop=formObj.top.value;
var formWidth=formObj.width.value;
var formHeight=formObj.height.value;
var formCustomfname=formObj.fname.value;
var formFormat=formObj.format.value;
var formDevice=formObj.dev.value;

var response = confirm('Sure to delete '+fname+'?');
if (response) {
document.location.href=\"index.php?mycmd=dodropone&\
id={$session->dnextID()}&\
dev=\"+formDevice+\"&\
mode=\"+formMode+\"&\
res=\"+formResolution+\"&\
bright=\"+formBrightness+\"&\
cont=\"+formContrast+\"&\
left=\"+formLeft+\"&\
top=\"+formTop+\"&\
width=\"+formWidth+\"&\
height=\"+formHeight+\"&\
fname=\"+formCustomfname+\"&\
format=\"+formFormat+\"&\
fname_drop=\"+fname
}
}

function j_ask_send_mail(fname)
{

var formObj = document.controlform;

var formMode=formObj.mode.value;
var formResolution=formObj.res.value;
var formBrightness=formObj.bright.value;
var formContrast=formObj.cont.value;

var formLeft=formObj.left.value;
var formTop=formObj.top.value;
var formWidth=formObj.width.value;
var formHeight=formObj.height.value;
var formCustomfname=formObj.fname.value;
var formFormat=formObj.format.value;
var formDevice=formObj.dev.value;


var response = prompt('Send '+fname+' from:','');
var response2 = prompt('Send '+fname+' to:','');


if ((response!='') && (response2!='')) {

	document.location.href=\"index.php?mycmd=dosendmail&\
id={$session->dnextID()}&\
dev=\"+formDevice+\"&\
mode=\"+formMode+\"&\
res=\"+formResolution+\"&\
bright=\"+formBrightness+\"&\
cont=\"+formContrast+\"&\
left=\"+formLeft+\"&\
top=\"+formTop+\"&\
width=\"+formWidth+\"&\
height=\"+formHeight+\"&\
fname=\"+formCustomfname+\"&\
format=\"+formFormat+\"&\
&fname=\"+fname+\"&\
mailto=\"+response2+\"&\
&mailfrom=\"+response
}
}



</script>
");

echo("</BODY>");
echo("</HTML>");
}

?>
