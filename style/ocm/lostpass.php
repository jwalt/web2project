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

    <body onload="document.lostpassform.checkusername.focus();" class="lostpass">
        <?php include ('overrides.php'); ?>
        <!--please leave action argument empty -->
        <form method="post" name="lostpassform" accept-charset="utf-8">
            <input type="hidden" name="lostpass" value="1" />
            <input type="hidden" name="redirect" value="<?php echo isset($redirect) ? $redirect : ''; ?>" />
            <table class="std login">
                <tr>
                    <th colspan="2"><?php echo $w2Pconfig['company_name']; ?></th>
                </tr>
                <tr>
                    <td><?php echo $AppUI->_('Username'); ?>:</td>
                    <td><input type="text" size="25" maxlength="255" name="checkusername" class="text" /></td>
                </tr>
                <tr>
                    <td><?php echo $AppUI->_('EMail'); ?>:</td>
                    <td><input type="email" size="25" maxlength="255" name="checkemail" class="text" /></td>
                </tr>
                <tr>
                    <td><a href="http://www.web2project.net/"><img src="./style/web2project/w2p_icon.ico" width="32" height="24" border="0" alt="web2Project logo" /></a></td>
                    <td><input type="submit" name="sendpass" value="<?php echo $AppUI->_('send password'); ?>" class="button" /></td>
                </tr>
            </table>
        </form>
	<?php if ($msg = $AppUI->getMsg()) { ?>
		<div class="error"><?php echo $msg; ?></div>
	<?php } ?>
	<div class="version">Version <?php echo $AppUI->getVersion(); ?></div>
    </body>
</html>