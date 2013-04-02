<?php
global $a, $AppUI;
$AppUI->loadFooterJS();
echo '<div class="messageContainer">'.$AppUI->getMsg().'</div>';
?>
<script type="text/javascript" charset="UTF-8">
$(document).ready(function() {
    $('textarea[name="message_body"]').sceditor({
        plugins: 'bbcode',
        emoticonsRoot: 'sceditor/',
        style: 'sceditor/ocm.css',
        locale: 'de',
        fonts: 'sans-serif,serif,monospace,Arial Black,Impact,Comic Sans MS',
        autoUpdate: true,
        toolbar: 'bold,italic,underline,strike,subscript,superscript|font,color,removeformat|cut,copy,paste,pastetext|bulletlist,orderedlist,code,quote|email,link,unlink,emoticon',//|source', TODO: size, h1-h6, align, quote cite=
        dropDownCss: { "z-index": 202 },
    });
});
</script>
</div>

<?php if (!$dialog) { ?>
<div id="navigationItems">
  <div id="quickSmartSearch">
	<?php if (canAccess('smartsearch')) { ?>
    <form name="frm_search" action="?m=smartsearch" method="post" accept-charset="utf-8">
      <input class="text" size="20" type="text" id="keyword" name="keyword" value="" />
      <input type="image" name="submit" src="<?= w2PfindImage('search.png') ?>" alt="Go!"/>
      <a href="#"><?= $AppUI->_('Global Search') ?>...</a>
    </form>
    <?php } ?>
  </div>
  
  <form name="frm_new" method="get" accept-charset="utf-8">
    <input type="hidden" name="a" value="addedit" />
	<?php if (isset($company_id)) { ?>
    <input type="hidden" name="company_id" value="<?= $company_id ?>" />
	<?php } ?>
    
    <?php if (isset($task_id)) { ?>
    <input type="hidden" name="task_parent" value="<?= $task_id ?>" />
    <?php } ?>
    
    <?php if (isset($file_id)) { ?>
    <input type="hidden" name="file_id" value="<?= $file_id ?>" />
    <?php } ?>
    
	<?php
	if ($AppUI->user_id > 0) {
        $newItem = array('' => '- New Item -');
	  
        $items = array('companies' => 'Company', 'projects' => 'Project',
                       'contacts' => 'Contact', 'calendar' => 'Events', 'files' => 'File',
                       'admin' => 'User');
        foreach ($items as $module => $name) {
            if (canAdd($module)) {
                $newItem[$module] = $name;
            }
        }
	  
        echo arraySelect($newItem, 'm', 'onchange="mod=this.options[this.selectedIndex].value;if (mod == \'admin\') this.form.a.value=\'addedituser\';if(mod) this.form.submit();"', '', true);
    }

    echo buildHeaderNavigation($AppUI, 'div', 'div', '', $m);
    ?>
  </form>

  <div id="userInfo">
    <?php if ($AppUI->user_id > 0) { ?>
    <div class="infotext">
	  <div class="username"><?= $AppUI->user_display_name ?></div>
      <div class="time"><?= $AppUI->getTZAwareTime() ?></div>
    </div>
    <div class="quicknav">
      <a class="button" href="?m=admin&amp;a=viewuser&amp;user_id=<?= $AppUI->user_id ?>"><?= $AppUI->_('My Info') ?></a>

      <?php if (false && canAccess('tasks')) { ?>
      <a class="button" href="?m=tasks&amp;a=todo"><?= $AppUI->_('My Tasks') ?></a>
      <?php } ?>
      
      <?php if (false && canAccess('calendar')) { $now = new w2p_Utilities_Date(); ?>
      <a class="button" href="?m=calendar&amp;a=day_view&amp;date=<?= $now->format(FMT_TIMESTAMP_DATE); ?>"><?= $AppUI->_('Today') ?></a>
      <?php } ?>
      
      <a class="button" href="?logout=-1"><?= $AppUI->_('Logout') ?></a>
    </div>
    <?php } else { ?>
    <div class="infotext">
	  <div class="username"><?= $outsider ?></div>
    </div>
    <?php } ?>
  </div>
</div>
<?php } ?>
