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

    <body onload="document.loginform.username.focus();">
        <div id="mainWorkArea" class="loaded">
            <div class="login">
                <div class="module-title">
                    <h1><?= $w2Pconfig['company_name'] ?></h1>
                </div>
	            <?php if ($msg = $AppUI->getMsg()) { ?>
		        <div class="error"><?= $msg ?></div>
	            <?php } ?>
                <form method="post" name="loginform" accept-charset="utf-8">
                    <input type="hidden" name="login" value="<?= time() ?>" />
                    <input type="hidden" name="redirect" value="<?= $redirect ?>" />
                    <table>
                        <tr>
                            <td><?= $AppUI->_('Username') ?>:</td>
                            <td><input type="text" size="25" maxlength="255" name="username" class="text" /></td>
                        </tr>
                        <tr>
                            <td><?= $AppUI->_('Password') ?>:</td>
                            <td><input type="password" size="25" maxlength="32" name="password" class="text" /></td>
                        </tr>
                        <tr>
                            <td><a href="http://www.web2project.net/"><img src="./style/web2project/w2p_icon.ico" width="32" height="24" border="0" alt="web2Project logo" /></a></td>
                            <td><input type="submit" name="login" value="<?= $AppUI->_('login') ?>" /></td>
                        </tr>
                    </table>
                    <ul>
                        <li><input type="submit" class="link" name="lostpass" value="<?= $AppUI->_('forgotPassword') ?>"></li>
                        <?php if (w2PgetConfig('activate_external_user_creation') == 'true') { ?>
                        <li><input type="submit" class="link" name="signup" value="<?= $AppUI->_('newAccountSignup') ?>" /></li>
                        <?php } ?>
                    </ul>
                </form>
            </div>
        </div>    
        <div class="cookiemsg"><?= $AppUI->_('You must have cookies enabled in your browser') ?></div>
	    <div class="version">Version <?= $AppUI->getVersion() ?></div>
    </body>
</html>
