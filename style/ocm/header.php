<?php
require W2P_BASE_DIR . '/includes/ajax_functions.php';
if (!$_SERVER['HTTP_X_PJAX']) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=<?= isset($locale_char_set) ? $locale_char_set : 'UTF-8' ?>" />
    <title><?= @w2PgetConfig('page_title') ?> :: <?= $AppUI->_($m) ?> <?= $AppUI->_($a) ?></title>
    <meta name="Version" content="<?= $AppUI->getVersion() ?>" />
    <link rel="stylesheet" type="text/css" href="style/<?= $uistyle ?>/main.css" media="all" charset="utf-8"/>
    <link rel="shortcut icon" href="style/<?= $uistyle ?>/icon.png" type="image/png" />
    <?php
    $AppUI->loadHeaderJS();
    ?>
    <link rel="stylesheet" type="text/css" href="lib/sceditor/themes/w2p.css" media="all" charset="utf-8"/>
    <script type="text/javascript" src="lib/sceditor/jquery.sceditor.bbcode.min.js"></script>
    <script type="text/javascript" src="lib/sceditor/jquery.sceditor.w2p-helper.js"></script>
    <script type="text/javascript" src="lib/sceditor/languages/de.js"></script>
    <script type="text/javascript" src="lib/jquery/jquery.pjax.js"></script>
    <script type="text/javascript">
    $(function(){
        $('a[href!="#"]:not([href^="mailto:"])').pjax('#mainWorkArea', {
            timeout: 1000,
            success: function() {
                $('#mainWorkArea').addClass('loaded');
            }
        });
        $('a[href!="#"]:not([href^="mailto:"])').live('click', function() {
            $('#mainWorkArea').removeClass('loaded');
        });
        $('#headerNav a').click(function() {
            $('#headerNav a').removeClass('module');
            $(this).addClass('module');
        });
    });
    </script>
  </head>
  
  <body<?= $_GET['dialog']?' class="dialog"':'' ?>>
    <?php if (!$_GET['dialog']) { ?>
	<input type="checkbox" id="maximize" /><label for="maximize"></label>
    <?php } ?>
    <div id="mainWorkArea" class="loaded">
<?php } else { ?>
        <title><?= @w2PgetConfig('page_title') ?> :: <?= $AppUI->_($m) ?> <?= $AppUI->_($a) ?></title>
<?php }

if (isset($xajax) && is_object($xajax)) {
    $xajax->printJavascript(w2PgetConfig('base_url') . '/lib/xajax');
}

echo $AppUI->getMsg();
?>
        <div class="mod_<?= $_REQUEST['m'] ?> a_<?= $_REQUEST['a'] ?>">
