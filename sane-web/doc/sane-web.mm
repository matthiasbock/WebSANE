<map version="0.9.0">
<!-- To view this file, download free mind mapping software FreeMind from http://freemind.sourceforge.net -->
<attribute_registry SHOW_ATTRIBUTES="selected"/>
<node COLOR="#000000" CREATED="1308104807582" ID="ID_1045196191" MODIFIED="1318320744185" TEXT="sane-web">
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="20"/>
<hook NAME="accessories/plugins/AutomaticLayout.properties"/>
<node COLOR="#0033ff" CREATED="1308104876287" ID="ID_491623651" MODIFIED="1318320744115" POSITION="right" TEXT="Commands">
<edge STYLE="sharp_bezier" WIDTH="8"/>
<font NAME="SansSerif" SIZE="18"/>
<node COLOR="#00b439" CREATED="1308104878834" ID="ID_1517031796" MODIFIED="1318320744116" TEXT="scanimage">
<edge STYLE="bezier" WIDTH="thin"/>
<font NAME="SansSerif" SIZE="16"/>
<node COLOR="#990000" CREATED="1308104892225" ID="ID_1148843989" MODIFIED="1309951868203" TEXT="scanimage -L">
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="14"/>
</node>
<node COLOR="#990000" CREATED="1308104896115" ID="ID_1907838710" MODIFIED="1309951868203" TEXT="scanimage -A">
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="14"/>
</node>
</node>
<node COLOR="#00b439" CREATED="1308538399379" ID="ID_949153179" MODIFIED="1318320744117" TEXT="convert">
<edge STYLE="bezier" WIDTH="thin"/>
<font NAME="SansSerif" SIZE="16"/>
</node>
<node COLOR="#00b439" CREATED="1311083138531" ID="ID_933758969" MODIFIED="1318320744161" TEXT="scanimage --mode Gray --button-controlled=yes --resolution 300 --format pnm --batch=%03d.pnm&#xa;convert -compress JPEG -quality 60 *.pnm aa.pdf">
<edge STYLE="bezier" WIDTH="thin"/>
<font NAME="SansSerif" SIZE="16"/>
</node>
</node>
<node COLOR="#0033ff" CREATED="1308537473095" ID="ID_300174388" MODIFIED="1318320744168" POSITION="right" TEXT="Process">
<edge STYLE="sharp_bezier" WIDTH="8"/>
<font NAME="SansSerif" SIZE="18"/>
<node COLOR="#00b439" CREATED="1308537605801" ID="ID_1163400373" MODIFIED="1318320744169">
<richcontent TYPE="NODE"><html>
  <head>
    
  </head>
  <body>
    <p>
      Start <u><i><font color="#000000">scanimage</font>&#160;</i></u>command
    </p>
  </body>
</html></richcontent>
<edge STYLE="bezier" WIDTH="thin"/>
<font NAME="SansSerif" SIZE="16"/>
<node COLOR="#990000" CREATED="1308537706084" ID="ID_375844619" MODIFIED="1309951868203">
<richcontent TYPE="NODE"><html>
  <head>
    
  </head>
  <body>
    <p>
      scanimage output will be put in a dest directory
    </p>
  </body>
</html></richcontent>
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="14"/>
</node>
<node COLOR="#990000" CREATED="1308538136436" ID="ID_1472108964" MODIFIED="1309951868203" TEXT="scan in color mode, 300 dpi">
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="14"/>
</node>
</node>
<node COLOR="#00b439" CREATED="1308537933651" ID="ID_966371367" MODIFIED="1318320744170">
<richcontent TYPE="NODE"><html>
  <head>
    
  </head>
  <body>
    <p>
      Monitor directory for all <u><i>.pnm</i></u>&#160;files
    </p>
  </body>
</html></richcontent>
<edge STYLE="bezier" WIDTH="thin"/>
<font NAME="SansSerif" SIZE="16"/>
<node COLOR="#990000" CREATED="1308538019340" ID="ID_981601007" MODIFIED="1309951868203" TEXT="list all files on a time base">
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="14"/>
</node>
<node COLOR="#990000" CREATED="1308538027309" ID="ID_993900308" MODIFIED="1309951868203" TEXT="run convert command to generate thumbnail">
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="14"/>
</node>
<node COLOR="#990000" CREATED="1308538047169" ID="ID_600150659" MODIFIED="1309951868203" TEXT="show thumbnail with datetime">
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="14"/>
</node>
</node>
<node COLOR="#00b439" CREATED="1308538061169" ID="ID_1980766023" MODIFIED="1318320744172" TEXT="Select one/more thumbnails">
<edge STYLE="bezier" WIDTH="thin"/>
<font NAME="SansSerif" SIZE="16"/>
</node>
<node COLOR="#00b439" CREATED="1308538079107" ID="ID_1099363513" MODIFIED="1318320808237" TEXT="Output setting">
<edge STYLE="bezier" WIDTH="thin"/>
<font NAME="SansSerif" SIZE="16"/>
<node COLOR="#990000" CREATED="1308538101982" ID="ID_1515909995" MODIFIED="1318320792874" TEXT="format">
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="14"/>
<node COLOR="#111111" CREATED="1308538105639" ID="ID_384821104" MODIFIED="1309951868203" TEXT="PDF">
<edge STYLE="bezier" WIDTH="1"/>
<icon BUILTIN="button_ok"/>
<node COLOR="#111111" CREATED="1308538290955" ID="ID_1755287919" MODIFIED="1309951868203" TEXT="single page">
<edge STYLE="bezier" WIDTH="1"/>
</node>
<node COLOR="#111111" CREATED="1308538297377" ID="ID_315628101" MODIFIED="1309951868203" TEXT="multi page">
<edge STYLE="bezier" WIDTH="1"/>
</node>
</node>
<node COLOR="#111111" CREATED="1308538107561" ID="ID_923954285" MODIFIED="1309951868203" TEXT="JPEG">
<edge STYLE="bezier" WIDTH="1"/>
</node>
<node COLOR="#111111" CREATED="1308538120483" ID="ID_1939806245" MODIFIED="1309951868203" TEXT="PNG">
<edge STYLE="bezier" WIDTH="1"/>
</node>
</node>
<node COLOR="#990000" CREATED="1308538162984" ID="ID_262856839" MODIFIED="1309951868203" TEXT="colour">
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="14"/>
<node COLOR="#111111" CREATED="1308538165890" ID="ID_35299065" MODIFIED="1309951868203" TEXT="black/white">
<edge STYLE="bezier" WIDTH="1"/>
</node>
<node COLOR="#111111" CREATED="1308538179609" ID="ID_66023367" MODIFIED="1309951868203" TEXT="gray">
<edge STYLE="bezier" WIDTH="1"/>
</node>
<node COLOR="#111111" CREATED="1308538181187" ID="ID_1700763545" MODIFIED="1309951868203" TEXT="colour">
<edge STYLE="bezier" WIDTH="1"/>
<icon BUILTIN="button_ok"/>
</node>
</node>
<node COLOR="#990000" CREATED="1308538256423" ID="ID_1281929109" MODIFIED="1309951868203" TEXT="Compress">
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="14"/>
<node COLOR="#111111" CREATED="1308538264876" ID="ID_1566149464" MODIFIED="1309951868203" TEXT="quality: 80">
<edge STYLE="bezier" WIDTH="1"/>
</node>
<node COLOR="#111111" CREATED="1318320618973" ID="ID_1208646603" MODIFIED="1318320744175" TEXT="size:"/>
</node>
</node>
<node COLOR="#00b439" CREATED="1308538363159" ID="ID_362544968" MODIFIED="1318320744176" TEXT="Convert and save in output folder">
<edge STYLE="bezier" WIDTH="thin"/>
<font NAME="SansSerif" SIZE="16"/>
</node>
<node COLOR="#00b439" CREATED="1308538387629" ID="ID_1671186140" MODIFIED="1318320744176" TEXT="Export">
<edge STYLE="bezier" WIDTH="thin"/>
<font NAME="SansSerif" SIZE="16"/>
<node COLOR="#990000" CREATED="1318320289102" ID="ID_1775769299" MODIFIED="1318320744177" TEXT="1. List of selected doc">
<font NAME="SansSerif" SIZE="14"/>
<node COLOR="#111111" CREATED="1318320326124" ID="ID_542553131" MODIFIED="1318320744178" TEXT="thumb preview"/>
<node COLOR="#111111" CREATED="1318320333972" ID="ID_1941709797" MODIFIED="1318320744178" TEXT="sort/adjust sequence"/>
</node>
<node COLOR="#990000" CREATED="1318320394216" ID="ID_1826538318" MODIFIED="1318320808235" TEXT="2. Export Options">
<arrowlink DESTINATION="ID_1099363513" ENDARROW="Default" ENDINCLINATION="215;-43;" ID="Arrow_ID_191221214" STARTARROW="None" STARTINCLINATION="215;-43;"/>
<font NAME="SansSerif" SIZE="14"/>
<node COLOR="#111111" CREATED="1318320491304" ID="ID_622778149" MODIFIED="1318320792873" TEXT="Format"/>
<node COLOR="#111111" CREATED="1318320536038" ID="ID_16062628" MODIFIED="1318320744181" TEXT="Compress">
<node COLOR="#111111" CREATED="1318320540817" ID="ID_890610222" MODIFIED="1318320744182" TEXT="Reduce size"/>
<node COLOR="#111111" CREATED="1318320564297" ID="ID_1957384268" MODIFIED="1318320744182" TEXT=""/>
</node>
</node>
</node>
</node>
<node COLOR="#0033ff" CREATED="1308546486479" HGAP="53" ID="ID_684261503" MODIFIED="1318320744183" POSITION="left" TEXT="Architecture" VSHIFT="-73">
<edge STYLE="sharp_bezier" WIDTH="8"/>
<font NAME="SansSerif" SIZE="18"/>
<node COLOR="#00b439" CREATED="1308548613059" ID="ID_268675611" MODIFIED="1318320744184" TEXT="WebService">
<edge STYLE="bezier" WIDTH="thin"/>
<font NAME="SansSerif" SIZE="16"/>
<node COLOR="#990000" CREATED="1308548629809" ID="ID_315490920" MODIFIED="1309951868203" TEXT="JSON output">
<edge STYLE="bezier" WIDTH="1"/>
<font NAME="SansSerif" SIZE="14"/>
</node>
</node>
<node COLOR="#00b439" CREATED="1308912013180" ID="ID_595104309" MODIFIED="1318320744185" TEXT="Layout">
<edge STYLE="bezier" WIDTH="thin"/>
<font NAME="SansSerif" SIZE="16"/>
</node>
</node>
</node>
</map>
