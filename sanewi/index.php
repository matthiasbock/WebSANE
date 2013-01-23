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

include("scanner.cfg");
include("params.cfg");
include("defs.h");

// Assign default values to variables if they are not initialized
if ($mode=="") {
 	$mode=$preset_mode;
	};
if ($resolution=="") {
 	$resolution=$preset_resolution;
	};
if ($brightness=="") {
 	$brightness=$preset_brightness;
	};
if ($contrast=="") {
 	$contrast=$preset_contrast;
	};
if ($left=="") {
 	$left=$preset_left;
	};
if ($top=="") {
 	$top=$preset_top;
	};
if ($width=="") {
 	$width=$preset_width;
	};
if ($height=="") {
 	$height=$preset_height;
	};
if ($customfname=="") {
 	$customfname=$preset_customfname;
	};
if ($format=="") {
 	$format=$preset_format;
	};

// Check if this is authentic command run

readLastID();

if ($oldrequestid=="") {
$oldrequestid=0;
}

if ($id=="") {
$id=$oldrequestid;
}

//echo("old: $oldrequestid / new: $id");
if ($oldrequestid==$id) {
// echo("Do nothing, came here by refresh");
}
else {
//echo("Work!");
if ($mycmd==dopreview) {
 doPreview();
 } else if ($mycmd==doscan) {
 doScan($customfname);
 } else if ($mycmd==doclear) {
 doClear();
 } else if ($mycmd==dodropone) {
 doDropOne($fname);
 }
 saveID(); 
} 

 $requestid=time();
 
// Generate HTML output

echo("<HTML>");
echo("
    <HEAD>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1257\">	
    <meta http-equiv=\"Pragma\" content=\"no-cache\">
    <link HREF=\"$baseurl/style/style.css\" REL=STYLESHEET>
	<TITLE>SANE Web Interface</TITLE>
    </HEAD>
    ");

echo("<BODY BACKGROUND=\"images/bg.gif\">");

//echo("<P>Pieslegums no: $REMOTE_ADDR</P>");

echo("<TABLE BORDER=0 WIDTH=100%>");
echo("<TR>");
echo("<TD COLSPAN=2>");
echo("<HR COLOR=green>");
echo("</TD>");
echo("</TR>");

echo("<TR>");
echo("<TD>");
echo("<B>SANE Web Interface<B>");
echo("</TD>");
echo("<TD ALIGN=RIGHT>");
echo("<A HREF=\"$baseurl/help.php\">Help</A>");
echo("</TD>");
echo("</TR>");

echo("<TR>");
echo("<TD COLSPAN=2>");
echo("<HR COLOR=green>");
echo("</TD>");
echo("</TR>");
echo("</TABLE>");


echo("<TABLE BORDER=0>");
echo("<TR>");
echo("<TH><A HREF=\"$baseurl/help.php#options\">Options</A></TH>");
echo("<TH><A HREF=\"$baseurl/help.php#preview\">Preview</A></TH>");
echo("<TH><A HREF=\"$baseurl/help.php#control\">Control</A></TH>");
echo("<TH><A HREF=\"$baseurl/help.php#scans\">Scan folder</A></TH>");
echo("</TR>");

echo("<TR>");
echo("<TD VALIGN=\"TOP\">");

echo("
<FORM 
    NAME=\"controlform\"
    ACTION=\"$baseurl/index.php?mycmd=dopreview\"
    METHOD=\"post\"
    ENCTYPE=\"multipart/form-data\">
    
<TABLE BORDER=\"0\">

<TR>
<TD ALIGN=\"left\">Mode:</TD>
<TD>
<SELECT NAME=\"mode\">");

if ($mode=="Lineart"){
echo("<OPTION VALUE=\"Lineart\" SELECTED>Lineart");
} else {
echo("<OPTION VALUE=\"Lineart\">Lineart");
}

if ($mode=="Grayscale"){
echo("<OPTION VALUE=\"Grayscale\" SELECTED>Grayscale");
} else {
echo("<OPTION VALUE=\"Grayscale\">Grayscale");
}

if ($mode=="Color"){
echo("<OPTION VALUE=\"Color\" SELECTED>Color");
} else {
echo("<OPTION VALUE=\"Color\">Color");
}

echo("
</SELECT>
</TD>
<TD></TD>
</TR>

<TR>
<TD COLSPAN=\"2\"><HR></TD>
</TR>

<TR>
<TD ALIGN=\"left\">Resolution:</TD>
<TD>
<SELECT NAME=\"resolution\">
<OPTION VALUE=\"16\">16
<OPTION VALUE=\"64\">64
<OPTION VALUE=\"128\">128
<OPTION VALUE=\"192\" SELECTED>192
<OPTION VALUE=\"256\">256
<OPTION VALUE=\"320\">320
<OPTION VALUE=\"384\">384
<OPTION VALUE=\"448\">448
</SELECT>
</TR>

<TR>
<TD ALIGN=\"left\">Alt res.:</TD>
<TD>
<INPUT TYPE=\"checkbox\" NAME=\"altres\">
<INPUT TYPE=\"text\" NAME=\"resolution1\" SIZE=\"6\" VALUE=\"$resolution\">
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
<TD><INPUT TYPE=\"text\" NAME=\"brightness\" SIZE=\"6\" VALUE=\"$brightness\"></TD>

<TR>
<TD COLSPAN=\"2\">(-127..127 in steps of 1)</TD>
</TR>

<TR>
<TD COLSPAN=\"2\"><HR></TD>
</TR>

<TR>
<TD ALIGN=\"left\">Contrast:</TD>
<TD><INPUT TYPE=\"text\" NAME=\"contrast\" SIZE=\"6\" VALUE=\"$contrast\"></TD>
</TR>

<TR>
<TD COLSPAN=\"2\">(-127..127 in steps of 1)</TD>
</TR>

<TR>
<TD COLSPAN=\"2\"><HR></TD>
</TR>

<TR>
<TD ALIGN=\"left\">Left:</TD>
<TD><INPUT TYPE=\"text\" NAME=\"left\" SIZE=\"6\" VALUE=\"$left\"></TD>
</TR>

<TR>
<TD ALIGN=\"left\">Top:</TD>
<TD><INPUT TYPE=\"text\" NAME=\"top\" SIZE=\"6\" VALUE=\"$top\"></TD>
</TR>

<TR>
<TD ALIGN=\"left\">Width:</TD>
<TD><INPUT TYPE=\"text\" NAME=\"width\" SIZE=\"6\" VALUE=\"$width\"></TD>
</TR>

<TR>
<TD ALIGN=\"left\">Height:</TD>
<TD><INPUT TYPE=\"text\" NAME=\"height\" SIZE=\"6\" VALUE=\"$height\"></TD>
</TR>

<TR>
<TD COLSPAN=\"2\"><HR></TD>
</TR>

<TR>
<TD COLSPAN=\"2\" ALIGN=\"left\">Filename:</BR>
<INPUT TYPE=\"text\" SIZE=\"32\" NAME=\"customfname\" value=\"$customfname\">
</TD>


<TR>
<TD COLSPAN=\"2\"><HR></TD>
</TR>

<TR>
<TD ALIGN=\"left\">Image format:</TD>
<TD>

<SELECT NAME=\"format\">
");

if ($format=="png"){
echo("<OPTION VALUE=\"png\" SELECTED>png");
} else {
echo("<OPTION VALUE=\"png\">png");
}

if ($format=="tiff"){
echo("<OPTION VALUE=\"tiff\" SELECTED>tiff");
} else {
echo("<OPTION VALUE=\"tiff\">tiff");
}

if ($format=="bmp"){
echo("<OPTION VALUE=\"bmp\" SELECTED>bmp");
} else {
echo("<OPTION VALUE=\"bmp\">bmp");
}

if ($format=="gif"){
echo("<OPTION VALUE=\"gif\" SELECTED>gif");
} else {
echo("<OPTION VALUE=\"gif\">gif");
}

echo("
</SELECT>
</TD>
</TR>

<TR>
<TD COLSPAN=\"2\"><HR></TD>
</TR>

</TABLE>
</FORM>

");

echo("</TD>");
echo("<TD VALIGN=TOP>");
echo("<EMBED WIDTH=\"230\" HEIGHT=\"370\" SRC=\"preview.svg\" type=\"image/svg+xml\" wmode=\"transparent\">");
echo("</TD>");


echo("<TD VALIGN=\"TOP\">");

// [Controls]
echo("<TABLE BORDER=0>");

echo("<TR>");
echo("<TD ALIGN=LEFT VALIGN=TOP>");
echo("<A HREF=\"javascript:j_ask_preview()\"><img border=0 src=\"images/preview.gif\"></A>");
echo(" <A HREF=\"javascript:j_ask_preview()\">Get preview</A>");
echo("</TD>");
echo("</TR>");

echo("<TR>");
echo("<TD ALIGN=LEFT VALIGN=TOP>");
echo("<A HREF=\"javascript:j_ask_scan()\"><img border=0 src=\"images/scan.gif\"></A>");
echo(" <A HREF=\"javascript:j_ask_scan()\">Scan new</A>");
echo("</TD>");
echo("</TR>");

echo("<TR>");
echo("<TD ALIGN=LEFT VALIGN=TOP>");
echo("<HR>");
echo("</TD>");
echo("</TR>");

echo("<TR>");
echo("<TD ALIGN=LEFT VALIGN=TOP>");
echo("<A HREF=\"javascript:j_ask_clear()\"><img border=0 src=\"images/clear.gif\"></A>");
echo(" <A HREF=\"javascript:j_ask_clear()\">Drop scans</A>");
echo("</TD>");
echo("</TR>");



echo("</TABLE>");

echo("</TD>");
echo("<TD VALIGN=TOP>");

// [Scans]
// List files in scan spool directory except for PNM raw data and log files
echo("<TABLE BORDER=0>");
echo("<TR>");
echo("<TD VALIGN=TOP>");
$handle=opendir($spooldirname); 
while ($file = readdir($handle)) { 
if ($file!="." && $file!=".." && !eregi(".pnm",$file) && !eregi(".log",$file)) { 
         echo("<LI><A HREF=\"$baseurl/spool/$file\"\n>$file</A>"); 
	 echo(" <A HREF=\"javascript:j_ask_drop_one('$file')\"><FONT COLOR=RED>X</FONT></A>");	 
 } 
}
closedir($handle); 
echo("</TD>");
echo("</TR>");


echo("</TABLE>");

echo("</TD>");

echo("</TR>");

echo("</TABLE>");


echo("<TABLE BORDER=0 WIDTH=100%>");
echo("<TR>");
echo("<TD COLSPAN=2>");
echo("<HR COLOR=green>");
echo("</TD>");
echo("</TR>");

echo("<TR>");
echo("<TD ALIGN=CENTER COLSPAN=2>");
echo("Copyright (c) 2003 <A HREF=\"mailto:benga@parks.lv?subject=SANE_Web_Interface\">Gunars Benga</A>");
echo("</TD>");
echo("</TR>");

echo("<TR>");
echo("<TD ALIGN=CENTER COLSPAN=2>");
echo("
<A HREF=\"http://sourceforge.net/projects/sanewi\">SANE Web Interface</A> is free software distributed under the terms of the 
<A HREF=\"http://www.gnu.org/licenses/gpl.html\">GNU General Public License</A>");
echo("</TD>");
echo("</TR>");

echo("</TABLE>");

//.................................................................................
// Javascript functions embedded in served document
//.................................................................................

echo("
<script language=javascript>
var htmldocument=document;

function j_ask_preview()
{
var formObj = document.controlform;
var formMode=formObj.mode.value;
var formBrightness=formObj.brightness.value;
var formContrast=formObj.contrast.value;

document.location.href=\"$baseurl/index.php?\
id=$requestid&\
mycmd=dopreview&\
mode=\"+formMode+\"&\
brightness=\"+formBrightness+\"&\
contrast=\"+formContrast;
}

function j_ask_scan()
{
var formObj = document.controlform;
var formMode=formObj.mode.value;
var formResolution=formObj.resolution.value;
var formAltRes=formObj.altres.checked;
var formResolution1=formObj.resolution1.value;
var formBrightness=formObj.brightness.value;
var formContrast=formObj.contrast.value;

var formLeft=formObj.left.value;
var formTop=formObj.top.value;
var formWidth=formObj.width.value;
var formHeight=formObj.height.value;
var formCustomfname=formObj.customfname.value;
var formFormat=formObj.format.value;

if (formAltRes==true) {
formResolution=formResolution1
}

document.location.href=\"$baseurl/index.php?\
id=$requestid&\
mycmd=doscan&\
mode=\"+formMode+\"&\
resolution=\"+formResolution+\"&\
brightness=\"+formBrightness+\"&\
contrast=\"+formContrast+\"&\
left=\"+formLeft+\"&\
top=\"+formTop+\"&\
width=\"+formWidth+\"&\
height=\"+formHeight+\"&\
customfname=\"+formCustomfname+\"&\
format=\"+formFormat;
}

function j_ask_clear()
{
var response = confirm('You will loose all scans. Sure to delete?');
if (response) {
document.location.href=\"$baseurl/index.php?\
id=$requestid&\
mycmd=doclear\"
}
}

function j_ask_drop_one(fname)
{
var response = confirm('Sure to delete '+fname+'?');
if (response) {
document.location.href=\"$baseurl/index.php?\
id=$requestid&\
mycmd=dodropone&\
fname=\"+fname
}
}

</script>
");

echo("</BODY>");
echo("</HTML>");

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// PHP functions running at the server
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function doPreview() {
global $baseurl;
global $device;
global $previewdirname;
global $previewidfname;
global $mode;
global $brightness;
global $contrast;

$timestamp=time();

// Put down new preview image ID
    $fp = fopen($previewidfname, "w");
    fputs($fp, "$timestamp");
	fclose($fp);

// Generate new SVG, containing latest preview ID	
    $fp = fopen("preview.svg", "w");

fputs($fp, "<?xml version=\"1.0\"?> 

<!--
Copyright (c) 2003 Gunars Benga (e-mail: benga@parks.lv; gbenga@users.sourceforge.net)
 
This file is part of SANE Web Interface.
 
SANE Web Interface is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
		
SANE Web Interface is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
		
You should have received a copy of the GNU General Public License
along with SANE Web Interface; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
--> 					    

<svg width=\"230\" height=\"370\" 
 style=\"text-rendering:optimizeSpeed; shape-rendering:optimizeSpeed; image-rendering:optimizeSpeed;\" 
 onload=\"loadHandler(evt)\" 
 onmousedown=\"processMouseDown(evt)\"
 onmouseup=\"processMouseUp(evt)\"
 onmousemove=\"processMouseMove(evt)\" 
>

<rect id=\"bkgrnd\" x=\"0\" y=\"0\" width=\"230px\" height=\"370px\" stroke=\"none\" fill=\"#E0E0E0\"/> 

<image x=\"0\" y=\"0\" width=\"230px\" height=\"370px\" xlink:href=\"$baseurl/preview/$timestamp.png\"></image>

<rect id=\"bkgrnd\" x=\"0\" y=\"0\" width=\"229px\" height=\"369px\" stroke=\"green\" fill=\"none\"/> 

<g id=\"selector\" stroke=\"blue\" transform=\"translate(0,0)\" >
<rect 
 id=\"rubberband\" 
 x=\"0\" y=\"0\" 
 width=\"0\" height=\"0\" 
 fill=\"none\" 
 stroke=\"blue\" 
 stroke-width=\"1\"/> 
</g>

   <script><![CDATA[

var svgdoc;
var sel_x,sel_y;
var rb_w,rb_h;
selecting=false;
var px2mm;

      function loadHandler(evt) 
      {     
      svgdoc=evt.getTarget;
      
	sel_x=0;
	sel_y=0;
	
	rb_h=0;
	rb_w=0;
	
        px2mm=0.945859872611464968152866242038217;
	
	selecting=false;
      }

      function processMouseDown(evt) 
      {
	if (evt.button != 2) {
	
	 selecting=true;
	 
	 sel_x=evt.clientX;
	 sel_y=evt.clientY;
	 	 
         object=svgdoc.getElementById(\"selector\");
	 object.setAttribute(\"transform\",\"translate(0,0)\");        	 
	 object.setAttribute(\"transform\",\"translate(\"+eval(sel_x)+\",\"+eval(sel_y)+\")\");
	  
	 rb_w=0;
	 rb_h=0;
	 	 
	 object=svgdoc.getElementById(\"rubberband\");
	 object.setAttribute(\"width\",rb_w);        
	 object.setAttribute(\"height\",rb_h);
	 
	 htmldocument.controlform.left.value=Math.round(sel_x*px2mm);
	 htmldocument.controlform.top.value=Math.round(sel_y*px2mm);
	 	 
       }
      }

      function processMouseMove(evt) 
      {
	 if (selecting==true) {
	 	  
	  rb_w=evt.clientX-sel_x;
	  rb_h=evt.clientY-sel_y;
	  	  
	  object=svgdoc.getElementById(\"rubberband\");
	  object.setAttribute(\"width\",rb_w);        
	  object.setAttribute(\"height\",rb_h);
	  	  
	  htmldocument.controlform.width.value=Math.round(rb_w*px2mm);
	  htmldocument.controlform.height.value=Math.round(rb_h*px2mm);	  
	 }
      }

      function processMouseUp(evt) 
      {
	 if (selecting==true) {selecting=false}
	}

   ]]></script>
   
</svg> 
");
	fclose($fp);

// Write shell script for acquiring new preview image	
    $fp = fopen("preview.sh", "w");

    fputs($fp, "#!/bin/sh
#
# Copyright (c) 2003 Gunars Benga (e-mail: benga@parks.lv; gbenga@users.sourceforge.net)
# 
# This file is part of SANE Web Interface.
# 
# SANE Web Interface is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# 		
# SANE Web Interface is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 		
# You should have received a copy of the GNU General Public License
# along with SANE Web Interface; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#

rm -f $previewdirname/*.pnm
rm -f $previewdirname/*.png
	
/usr/X11R6/bin/scanimage \\
 --preview=yes \\
 --device $device \\
 --mode=$mode \\
 --resolution=24 \\
 --brightness=$brightness \\
 --contrast=$contrast \\
 --speed=Fast \\
 -l 0 -t 0 -x 230 -y 370 \\
> $previewdirname/$timestamp.pnm \\
2> $previewdirname/err.log

/usr/bin/convert \\
 $previewdirname/$timestamp.pnm \\
 $previewdirname/$timestamp.png \\
 2>> $previewdirname/err.log
");

fclose($fp);

system("./wrap_preview.sh");
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function doScan($customfname) {
global $baseurl;
global $device;
global $spooldirname;
global $previewidfname;

global $mode;
global $resolution;
global $brightness;
global $contrast;
global $left;
global $top;
global $width;
global $height;
global $format;
global $REMOTE_ADDR;

if (trim($customfname)=="") {
$hostname=gethostbyaddr($REMOTE_ADDR);
$scantimestamp=date("d.m.y_H:i:s");
$newfname="${hostname}_${scantimestamp}";
} else {
$newfname=$customfname;
}

$fp = fopen("scan.sh", "w");
fputs($fp, "#!/bin/sh
#
# Copyright (c) 2003 Gunars Benga (e-mail: benga@parks.lv; gbenga@users.sourceforge.net)
# 
# This file is part of SANE Web Interface.
# 
# SANE Web Interface is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# 		
# SANE Web Interface is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 		
# You should have received a copy of the GNU General Public License
# along with SANE Web Interface; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#

myfname=\"$newfname\"

if [ -f  $spooldirname/\$myfname.$format ]; then
mydate=`date +%T`;
myfname=\"\${myfname}_\${mydate}\";
fi

/usr/X11R6/bin/scanimage \\
 --device net:localhost:hp:/dev/sg0 \\
 --mode=$mode \\
 --resolution=$resolution \\
 --brightness=$brightness \\
 --contrast=$contrast \\
 --speed=Fast \\
 -l $left -t $top -x $width -y $height \\
> $spooldirname/scan.pnm \\
2> $spooldirname/err.log

/usr/bin/convert \\
 $spooldirname/scan.pnm \\
 $spooldirname/\$myfname.$format \\
 2>> $spooldirname/err.log
");

fclose($fp);

 system("./wrap_scan.sh");
}

function doClear() {
global $spooldirname;
$fp = fopen("clear.sh", "w");

fputs($fp, "#!/bin/sh
#
# Copyright (c) 2003 Gunars Benga (e-mail: benga@parks.lv; gbenga@users.sourceforge.net)
# 
# This file is part of SANE Web Interface.
# 
# SANE Web Interface is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# 		
# SANE Web Interface is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 		
# You should have received a copy of the GNU General Public License
# along with SANE Web Interface; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#

rm -f $spooldirname/*.png
rm -f $spooldirname/*.tiff
rm -f $spooldirname/*.bmp
rm -f $spooldirname/*.gif
");

 fclose($fp);

 system("./wrap_clear.sh");
}

//++++++++++++++++++++++++
function doDropOne($fname) {
global $spooldirname;
$fp = fopen("dropone.sh", "w");

fputs($fp, "#!/bin/sh
#
# Copyright (c) 2003 Gunars Benga (e-mail: benga@parks.lv; gbenga@users.sourceforge.net)
# 
# This file is part of SANE Web Interface.
# 
# SANE Web Interface is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# 		
# SANE Web Interface is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 		
# You should have received a copy of the GNU General Public License
# along with SANE Web Interface; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#

rm -f $spooldirname/$fname
");

 fclose($fp);

 system("./wrap_dropone.sh");

}
//+++++++++++++++++++++++

function saveID() {
global $requestidfname;
global $id;
    $fp = fopen($requestidfname, "w");
    fputs($fp, "$id");
	fclose($fp);
//echo("[saved $requestid to $requestidfname]\n");	
}

function readLastID() {
global $requestidfname;
global $oldrequestid;
    $fp = fopen($requestidfname, "r");
	$oldrequestid=fread($fp, 255);
	fclose($fp);
//echo("[loaded $oldrequestid from $requestidfname]\n");	
}

?>


