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
    if (isset($xajax) && is_object($xajax)) {
        $xajax->printJavascript(w2PgetConfig('base_url') . '/lib/xajax');
    }
    $AppUI->loadHeaderJS();
    ?>
    <script type="text/javascript" src="lib/jquery/jquery.pjax.js"></script>
    <script type="text/javascript">
    $(function(){
        $('a[href!="#"]:not([href^="mailto:"]):not([href^="javascript:"]):not([onclick])').pjax('#mainWorkArea', {
            timeout: 1000,
            success: function() {
                $('#mainWorkArea').addClass('loaded');
                if (document.recalc) document.recalc();
                xajax.config.requestURI = document.location.href;
                $('body').scrollTop(0);
            }
        });
        $('a[href!="#"]:not([href^="mailto:"]):not([href^="javascript:"]):not([onclick])').live('click', function() {
            $('#mainWorkArea').removeClass('loaded');
            $('#tiptip_holder').hide();
        });
        $('#headerNav a').click(function() {
            $('#headerNav a').removeClass('module');
            $(this).addClass('module');
        });
        // xajax' own URL detection fails for SSL, this is the most portable alternative
        xajax.config.requestURI = document.location.href;
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
        <?php $AppUI->getModuleJS($m, $a, true); ?>
<?php } ?>
        <div class="mod_<?= $m ?> a_<?= $a ?>">
