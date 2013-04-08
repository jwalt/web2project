<?php
if (!defined('W2P_BASE_DIR')) {
	die('You should not access this file directly');
}

include 'overrides.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo $w2Pconfig['page_title']; ?></title>
        <meta http-equiv="Content-Type" content="text/html;charset=<?php echo isset($locale_char_set) ? $locale_char_set : 'UTF-8'; ?>" />
        <title><?php echo $w2Pconfig['company_name']; ?> :: web2Project Login</title>
        <meta http-equiv="Pragma" content="no-cache" />
        <meta name="Version" content="<?php echo $AppUI->getVersion(); ?>" />
        <link rel="stylesheet" type="text/css" href="./style/common.css" media="all" charset="utf-8"/>
        <link rel="stylesheet" type="text/css" href="./style/<?php echo $uistyle; ?>/main.css" media="all" charset="utf-8"/>
        <style type="text/css" media="all">@import "./style/<?php echo $uistyle; ?>/main.css";</style>
        <link rel="shortcut icon" href="./style/<?php echo $uistyle; ?>/favicon.ico" type="image/ico" />
        <script type="text/javascript" src="<?= W2P_BASE_URL ?>/js/passwordstrength.js"></script>
        <script language="javascript">
        function submitIt(){
            var form = document.editFrm;
            if (form.user_username.value.length < <?= w2PgetConfig('username_min_len') ?>) {
                alert("<?= $AppUI->_('Username size is invalid, should be greater than', UI_OUTPUT_JS); ?>" + ' ' + <?= w2PgetConfig('username_min_len') ?>);
                form.user_username.focus();
            } else if (/[^a-zA-Z0-9._-]/.test(form.user_username.value)) {
                alert("<?= $AppUI->_('Username contains invalid characters.') ?>");
                form.user_username.focus();
            } else if (form.user_password.value.length < <?= w2PgetConfig('password_min_len') ?>) {
                alert("<?= $AppUI->_('Password size is invalid, should be greater than', UI_OUTPUT_JS); ?>" + ' ' + <?= w2PgetConfig('password_min_len') ?>);
                form.user_password.focus();
            } else if (form.user_password.value !=  form.password_check.value) {
                alert("<?= $AppUI->_('Password confirmation failed', UI_OUTPUT_JS) ?>");
                form.user_password.focus();
            } else if (form.contact_first_name.value.length <= 1) {
                alert("<?= $AppUI->_('First name is invalid', UI_OUTPUT_JS) ?>");
                form.contact_first_name.focus();
            } else if (form.contact_last_name.value.length <= 1) {
                alert("<?= $AppUI->_('Last name is invalid', UI_OUTPUT_JS) ?>");
                form.contact_last_name.focus();
            } else if (form.contact_email.value.length < 4) {
                alert("<?= $AppUI->_('Email is invalid', UI_OUTPUT_JS) ?>");
                form.contact_email.focus();
	        } else if (form.spam_check.value.length < 1) {
                alert("<?= $AppUI->_('Anti Spam Security is invalid', UI_OUTPUT_JS) ?>");
            } else {
                return true;
            }
            return false;
        }
        </script>
	</head>

	<body onload="document.editFrm.user_username.focus();">
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td width="508"><a href="http://www.web2project.net"><img border="0" alt="web2Project Home" src="./style/<?php echo $uistyle; ?>/images/w2p_logo.jpg"/></a></td>
                    <td style="background:url(./style/<?php echo $uistyle; ?>/images/logo_bkgd.jpg)">&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td width="100%" valign="top" align="left" style="background: transparent url(./style/<?php echo $uistyle; ?>/images/nav_shadow.jpg) repeat-x scroll 0%;">
                        <img width="1" height="13" border="0" src="./style/<?php echo $uistyle; ?>/images/nav_shadow.jpg" alt=""/>
                    </td>
                </tr>
            </tbody>
        </table>
        <br /><br /><br /><br />

	    <?php if ($msg = $AppUI->getMsg()) { ?>
		<div class="error"><?= $msg ?></div>
	    <?php } ?>

        <form name="editFrm" method="post" accept-charset="utf-8">
	        <input type="hidden" name="cid" value="<?= $cid ?>" />
            <table style="border-style:none;" cellspacing="0" class="std login">
                <tr>
                    <td colspan="2">
                        <?php echo styleRenderBoxTop(); ?>
                    </td>
                </tr>
                <tr>
                    <th colspan="2"><em><?= $AppUI->_("Register New Account") ?></em></th>
                </tr>

                <tr class="required">
                    <td><?= $AppUI->_('Login Name') ?>:</td>
                    <td><input type="text" name="user_username" id="user_username" maxlength="255" size="35" value="<?= $_POST['user_username'] ?>" /></td>
		        </tr>

		        <tr class="required">
                    <td><?= $AppUI->_('Password') ?>:</td>
                    <td><input type="password" name="user_password" maxlength="256" size="35" onKeyUp="checkPassword(this.value, document.getElementById('user_username').value);" /></td>
		        </tr>

		        <tr class="required">
                    <td><?= $AppUI->_('Confirm Password') ?>:</td>
                    <td><input type="password" name="password_check" maxlength="256" size="35" /></td>
		        </tr>

                <tr>
                    <td><?= $AppUI->_('Password Strength') ?></td>
                    <td><div id="progressBar"></div></td>
                </tr>

                <tr class="required">
                    <td><?= $AppUI->_('Name') ?>:</td>
                    <td>
                        <input type="text" name="contact_first_name" maxlength="25" value="<?= $_POST['contact_first_name'] ?>" size="15" />
                        <input type="text" name="contact_last_name" maxlength="25" value="<?= $_POST['contact_last_name'] ?>" size="16" />
                    </td>
                </tr>

                <tr class="required">
                    <td><?= $AppUI->_('Email') ?>:</td>
                    <td><input type="text" name="contact_email" maxlength="255" size="35" value="<?= $_POST['contact_email'] ?>" /></td>
                </tr>

                <tr>
                    <td><?= $AppUI->_('Phone') ?>:</td>
                    <td><input type="text" name="contact_phone" maxlength="50" size="35" value="<?= $_POST['contact_phone'] ?>" /></td>
                </tr>

                <tr>
                    <td><?= $AppUI->_('Address') ?> 1:</td>
                    <td><input type="text" name="contact_address1" maxlength="50" size="35" value="<?= $_POST['contact_address1'] ?>" /></td>
                </tr>

                <tr>
                    <td><?= $AppUI->_('Address') ?> 2:</td>
                    <td><input type="text" name="contact_address2" maxlength="50" size="35" value="<?= $_POST['contact_address2'] ?>" /></td>
                </tr>

                <tr>
                    <td><?= $AppUI->_('City') ?>:</td>
                    <td><input type="text" name="contact_city" maxlength="50" size="35" value="<?= $_POST['contact_city'] ?>" /></td>
                </tr>

                <tr>
                    <td><?= $AppUI->_('State') ?>:</td>
                    <td><input type="text" name="contact_state" maxlength="50" size="35" value="<?= $_POST['contact_state'] ?>" /></td>
                </tr>

                <tr>
                    <td><?= $AppUI->_('Zip Code') ?>:</td>
                    <td><input type="text" name="contact_zip" maxlength="50" size="35" value="<?= $_POST['contact_zip'] ?>" /></td>
                </tr>

		        <tr>
			        <td><?php echo $AppUI->_('Country') ?>:</td>
			        <td>
                        <?php
                        $countries = array('' => $AppUI->_('(Select a Country)')) +
                                                           w2PgetSysVal('GlobalCountries');
                        echo arraySelect($countries, 'contact_country', '', 0);
                        ?>
			        </td>
		        </tr>

		        <tr class="required">
			        <td>* <?= $AppUI->_('Anti Spam Security') ?>:</td>
			        <td>
                        <input type="text" id="spam" name="spam_check" maxlength="5" size="5" />
			            <img src="<?= W2P_BASE_URL ?>/lib/captcha/CaptchaImage.php?uid=54;<?= $uid ?>" />
                    </td>
		        </tr>

		        <tr class="required">
                    <td colspan="2"><?= $AppUI->_('Required Fields') ?></td>
		        </tr>

		        <tr>
		            <td><input type="submit" name="cancel" value="<?= $AppUI->_('cancel') ?>" /></td>
		            <td><input type="submit" name="signup" value="<?= $AppUI->_('sign me up!') ?>" onclick="return submitIt()" /></td>
		        </tr>
                <tr>
                    <td colspan="2">
                        <?php echo styleRenderBoxBottom(); ?>
                    </td>
                </tr>
	        </table>
        </form>
	    <div class="version">Version <?= $AppUI->getVersion() ?></div>
	</body>
</html>