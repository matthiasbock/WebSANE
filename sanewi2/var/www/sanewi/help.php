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

include("/etc/sanewi/settings.cfg");

 
// Generate HTML output

echo("<HTML>");
echo("
    <HEAD>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1257\">	
    <meta http-equiv=\"Pragma\" content=\"no-cache\">
    <link HREF=\"style/style.css\" REL=STYLESHEET>
	<TITLE>SANE Web Interface - Help</TITLE>
    </HEAD>
    ");

echo("<BODY BACKGROUND=\"images/bg.gif\">");
echo("<A NAME=top>");
//echo("<P>Pieslegums no: $REMOTE_ADDR</P>");

echo("<CENTER>");
echo("<TABLE BORDER=0 WIDTH=790>");
echo("<TR>");
echo("<TD COLSPAN=2>");
echo("<HR COLOR=green>");
echo("</TD>");
echo("</TR>");

echo("<TR>");
echo("<TD>");
echo("<B>SANE Web Interface - Help<B>");
echo("</TD>");

echo("<TD ALIGN=RIGHT>");
echo("<A HREF=\"\">Back</A>");
echo("</TD>");
echo("</TR>");

echo("<TR>");
echo("<TD COLSPAN=2>");
echo("<HR COLOR=green>");
echo("</TD>");
echo("</TR>");
echo("<TR>");
echo("<TD COLSPAN=2>");

echo("<P><A NAME=sane><B>Sane</B></A></P>");

echo("
<P>
SANE (Scanner Access Now Easy) is software for Unix like operating systems (BSD, Linux), that controls the scanner and allows other computers on the same network to access it.
</P>
<P>
So far there was no convenient way for users of MS Windows to utilize this service.
Therefore this \"scanner portal\" was developed. Every employee who has the Internet Explorer browser now is able to use the SANE operated scanner.
</P>
"); 

echo("<TR>");
echo("<TD COLSPAN=2>");
echo("<P><HR><A NAME=interface><B>Interface</B></A></P>");
echo("<P>Click on marked areas to go directly to the description of that interface section.</P>");
echo("
<P>
<IMG SRC=\"help/interface.gif\" WIDTH=318 HEIGHT=219 BORDER=0 USEMAP=\"#map\">
</P>
<MAP NAME=\"map\">
<AREA SHAPE=\"RECT\" COORDS=\"14,28,95,210\" HREF=\"#options\">
<AREA SHAPE=\"RECT\" COORDS=\"158,25,206,73\" HREF=\"#control\">
<AREA SHAPE=\"RECT\" COORDS=\"85,20,175,166\" HREF=\"#preview\">
<AREA SHAPE=\"RECT\" COORDS=\"197,30,288,89\" HREF=\"#scans\">
</MAP>
");
echo("<P>Note: You can get instant help on particular interface section during your work if you click the section header.</P>");
echo("</TD>");
echo("</TR>");

echo("<TR>");
echo("<TD COLSPAN=2>");
echo("<P><A NAME=options><HR><B>1. Options</B></A></P>");
// Chapter on Options
echo("<TABLE CELLSPACING=5 BORDER=0>");
echo("<TR>");
echo("<TD VALIGN=TOP>");
echo("<P><IMG BORDER=1 SRC=\"help/options.gif\"></P>");
echo("</TD>");
echo("<TD VALIGN=TOP>");
echo("
<P>
Here you set the scanning options.
</P>
<P>
Mode<BR>
<LI> Lineart - black-and-white;
<LI> Grayscale - shades of gray (like in old photographs);
<LI> Color - color.
</P>
<P>
Resolution<BR>
Sets the \"magnification\" when scanning.
Default values are given so that they can be divided by 8, which is required by software when scanning black-and-white images. Any other value can be set checking the \"Alt.res.\" checkbox and putting in the desired value.
</P>
<P>
Brightness<BR>
Adjusts the brightness of the scan in comparison to the standard level.
</P>
<P>
Contrast<BR>
Adjusts the contrast of the scan in comparison to the standard level.
</P>
<P>
Left,Top,Width,Height<BR>
Sets dimensions of the area to scan, i.e. x and y of the top left corner and width and height of the scan area. Default is ISO A4 paper size.
</P>
<P>
Filename<BR>
Here you may assign a specific filename to the scan image file, if you wish.
As well you may leave this blank, then the file name will be generated automatically and will contain the IP address of the client computer and the timestamp.
If accidentally you scan twice with the same name, don't worry, the new scan will have name with a timestamp added. The old scan will remain in place.

</P>
<P>
Image format<BR>
Choose what format the data coming from the scanner will be stored in. Possible choices:
<LI> png - (Portable Network Graphics), alpha channel, good quality with good compression. Open standard.
<LI> tiff - (Tagged Image File Format), optimal for saving of black-and-white images. Similar to JPEG. For AutoCAD b/w background images use this!
<LI> bmp - (Microsoft Windows Bitmap), very big files, usually not compressed.
<LI> gif - (Graphics Interchange Format), alpha channel, good lossless compression, but only max 256 colors.
</P>
");
echo("</TD>");
echo("</TR>");
echo("</TABLE>");
// end chapter
echo("<A HREF=\"#top\">Top</A>");

echo("</TD>");
echo("</TR>");
echo("<TR>");
echo("<TD COLSPAN=2>");

echo("<P><A NAME=preview><HR><B>2. Preview</B></A></P>");
// Chapter on Preview
echo("<TABLE CELLSPACING=5 BORDER=0>");
echo("<TR>");
echo("<TD VALIGN=TOP>");
echo("<P><IMG BORDER=1 SRC=\"help/preview.gif\"></P>");
echo("</TD>");
echo("<TD VALIGN=TOP>");
echo("<P>
Here you can see a smaller preliminary image which can be acquired by clicking the \"Get preview\" button.
</P>
<P>
The purpose of this is to let you :
<LI> adjust the scanning options with no need to do a full scan, thus saving time;
<LI> select only a part of the image for scanning
</P>
<P>
When acquiring a preview the following of the options are taken into account by the software:
<LI>mode;
<LI>brightness;
<LI>contrast.
</P>
<P>
Press the left mouse button and drag the mouse to select the scan area, then release the button.
</P>
<P>
Note: When you initially start your session, you will see the preview image acquired during the last session. Place your document into the scanner, adjust scanning options and acquire your own preview image.
</P>

");
echo("</TD>");
echo("</TABLE>");
// end chapter
echo("<A HREF=\"#top\">Top</A>");

echo("</TD>");
echo("</TR>");
echo("<TR>");
echo("<TD COLSPAN=2>");

echo("<P><A NAME=control><HR><B>3. Control</B></A></P>");
// Chapter on Control
echo("<TABLE CELLSPACING=5 BORDER=0>");
echo("<TR>");
echo("<TD VALIGN=TOP>");
echo("<P><IMG BORDER=1 SRC=\"help/control.gif\"></P>");
echo("</TD>");
echo("<TD VALIGN=TOP>");
echo("<P>
These are controls:
<LI>Get preview - acquires a new preview image;
<LI>Scan new - scans the selected scan area and produces a new image file;
<LI>Drop scans - deletes all image files stored on server.
</P>");
echo("</TD>");
echo("</TABLE>");
// end chapter
echo("<A HREF=\"#top\">Top</A>");

echo("</TD>");
echo("</TR>");
echo("<TR>");
echo("<TD COLSPAN=2>");

echo("<P><A NAME=scans><HR><B>4. Scan folder</B></A></P>");
// Chapter on Control
echo("<TABLE CELLSPACING=5 BORDER=0>");
echo("<TR>");
echo("<TD VALIGN=TOP>");
echo("<P><IMG BORDER=1 SRC=\"help/scans.gif\"></P>");
echo("</TD>");
echo("<TD VALIGN=TOP>");
echo("<P>
Scanned images are stored in a special directory on the server.
</P>
<P>
You can:
<BR>a) open them directly by just clicking the file name;
<BR>b) save them on your computer by right clicking the file name and selecting \"Save target as\".
</P>
<P>
Particular file may be deleted by clicking the red \"<FONT COLOR=red>X</FONT>\" after the file name.
</P>
<P>
Name of the image file is either the one provided by user or the automatically generated one containing the IP of the client and the timestamp. 
</P>
<P>
File extension depends upon the selected image format.
</P>
</P>
Note: If the automatically generated image file name displays IP address which is not yours, possibly your connection is going through the proxy server. Turn proxy off for local addresses in your Internet Explorer options. 
<P>
");
echo("</TD>");
echo("</TABLE>");
// end chapter
echo("<A HREF=\"#top\">Top</A>");

echo("</TD>");
echo("</TR>");

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
//end page

echo("</BODY>");
echo("</HTML>");
?>
