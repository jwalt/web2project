<?php
if (!defined('W2P_BASE_DIR')) {
	die('You should not access this file directly');
}

include 'overrides.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=<?php echo isset($locale_char_set) ? $locale_char_set : 'UTF-8'; ?>" />
        <title><?= @w2PgetConfig('page_title') ?> :: <?= $AppUI->_('Login') ?></title>
        <meta http-equiv="Pragma" content="no-cache" />
        <link rel="stylesheet" type="text/css" href="./style/<?= $uistyle ?>/main.css" media="all" charset="utf-8"/>
        <link rel="shortcut icon" href="./style/<?= $uistyle ?>/icon.png" type="image/png" />
    </head>

    <body onload="document.lostpassform.checkusername.focus();">
        <div id="mainWorkArea" class="loaded">
            <div class="login">
                <div class="module-title">
                    <h1><?= $w2Pconfig['company_name'] ?></h1>
                </div>
	            <?php if ($msg = $AppUI->getMsg()) { ?>
		        <div class="error"><?= $msg ?></div>
	            <?php } ?>
                <form method="post" name="lostpassform" accept-charset="utf-8">
                    <input type="hidden" name="redirect" value="<?= $redirect ?>" />
                    <table>
                        <tr>
                            <td><?= $AppUI->_('Username') ?>:</td>
                            <td><input type="text" size="25" maxlength="255" name="checkusername" /></td>
                        </tr>
                        <tr>
                            <td><?= $AppUI->_('EMail') ?>:</td>
                            <td><input type="email" size="25" maxlength="255" name="checkemail" /></td>
                        </tr>
                        <tr>
                            <td><input type="submit" name="back" value="<?= $AppUI->_('back') ?>" /></td>
                            <td>
                                <input type="submit" name="lostpass" value="<?= $AppUI->_('send password') ?>" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>    
	    <div class="version">Version <?= $AppUI->getVersion() ?></div>
    </body>
</html>