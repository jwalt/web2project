<?php
if (!defined('W2P_BASE_DIR')) {
	die('You should not access this file directly');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=<?php echo isset($locale_char_set) ? $locale_char_set : 'UTF-8'; ?>" />
        <title><?php echo @w2PgetConfig('page_title'); ?> :: Login</title>
        <meta http-equiv="Pragma" content="no-cache" />
        <meta name="Version" content="<?php echo $AppUI->getVersion(); ?>" />
        <link rel="stylesheet" type="text/css" href="./style/<?php echo $uistyle; ?>/main.css" media="all" charset="utf-8"/>
        <link rel="shortcut icon" href="./style/<?php echo $uistyle; ?>/icon.png" type="image/png" />
    </head>

    <body class="login" onload="document.loginform.username.focus();">
        <?php include ('overrides.php'); ?>
        <!--please leave action argument empty -->
        <form method="post" action="<?php echo $loginFromPage; ?>" name="loginform" accept-charset="utf-8">
            <table class="std login">
                <input type="hidden" name="login" value="<?php echo time(); ?>" />
                <input type="hidden" name="lostpass" value="0" />
                <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                <tr>
                    <th colspan="2"><?php echo $w2Pconfig['company_name']; ?></th>
                </tr>
                <tr>
                    <td><?php echo $AppUI->_('Username'); ?>:</td>
                    <td><input type="text" size="25" maxlength="255" name="username" class="text" /></td>
                </tr>
                <tr>
                    <td><?php echo $AppUI->_('Password'); ?>:</td>
                    <td><input type="password" size="25" maxlength="32" name="password" class="text" /></td>
                </tr>
                <tr>
                    <td><a href="http://www.web2project.net/"><img src="./style/web2project/w2p_icon.ico" width="32" height="24" border="0" alt="web2Project logo" /></a></td>
                    <td><input type="submit" name="login" value="<?php echo $AppUI->_('login'); ?>" class="button" /></td>
                </tr>
                <tr>
                    <td colspan="2"><a href="javascript: void(0);" onclick="f=document.loginform;f.lostpass.value=1;f.submit();"><?php echo $AppUI->_('forgotPassword'); ?></a></td>
                </tr>
                <?php if (w2PgetConfig('activate_external_user_creation') == 'true') { ?>
                    <tr>
                         <td colspan="2"><a href="javascript: void(0);" onclick="javascript:window.location='./newuser.php'"><?php echo $AppUI->_('newAccountSignup'); ?></a></td>
                    </tr>
                <?php } ?>
            </table>
        </form>
	<?php if ($msg = $AppUI->getMsg()) { ?>
		<div class="error"><?php echo $msg; ?></div>
	<?php } ?>
        <div class="cookiemsg"><?php echo $AppUI->_('You must have cookies enabled in your browser'); ?></div>
	<div class="version">Version <?php echo $AppUI->getVersion(); ?></div>
    </body>
</html>