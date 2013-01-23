<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sane-Web</title>
    <link rel="stylesheet" href="<?php echo site_url("assets/css/default/sane.css");?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo site_url("assets/css/ui-lightness/jquery-ui-1.8.21.custom.css");?>" type="text/css" media="screen">
    <script src='<?php echo site_url("assets/js/jquery-1.7.2.min.js");?>'></script>
    <script src='<?php echo site_url("assets/js/jquery-ui-1.8.21.custom.min.js");?>'></script>
    <script src='<?php echo site_url("assets/js/jquery.saneweb.js");?>'></script>
</head>

<body>

<div id="top">
    <ul>
    <li id="logo">Sane-web</li>
    <li>
        <button id='btn_export'>Export</button>
    </li>
    <li>
        <button id='btn_scanner_setting'>Scaner Setting</button>
    </li>
    <li class="right" id="status">
        Scanner Status: Running
    </li>
</div>

<div id="saneweb_container" class="saneweb_container"></div>

<script language="javascript">
var APPURL = "<?php echo site_url('/');?>";

$(document).ready(function(){
    $('#saneweb_container').saneweb();
});
</script>

</body>
</html>
