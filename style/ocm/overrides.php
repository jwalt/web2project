<?php
##
##  This overrides the show function of the CTabBox_core function
##
class CTabBox extends w2p_Theme_TabBox {
	function show($extra = '', $js_tabs = false, $alignment = 'left', $opt_flat = true) {
		global $AppUI, $w2Pconfig, $currentTabId, $currentTabName, $m, $a;
		$this->loadExtras($m, $a);

		reset($this->tabs);
		$s = '';
		// tabbed / flat view options
		if ($AppUI->getPref('TABVIEW') == 0) {
			if ($opt_flat) {
				$s .= '<div class="tabviewchoice">';
				$s .= '<a class="button" href="' . $this->baseHRef . 'tab=0"><div>' . $AppUI->_('tabbed') . '</div></a>';
				$s .= '<a class="button" href="' . $this->baseHRef . 'tab=-1"><div>' . $AppUI->_('flat') . '</div></a>';
				$s .= '</div>';
				echo $s;
			}
		}
		
		if ($extra) {
			echo '<div class="tabextra">' . $extra . '</div>';
		}
		
		if ($this->active < 0 || $AppUI->getPref('TABVIEW') == 2) {
			// flat view, active = -1
			echo '<div class="tabflat">';
			foreach ($this->tabs as $k => $v) {
				echo '<div class="tabox"><h2 class="title">' . ($v[2] ? $v[1] : $AppUI->_($v[1])) . '</h2>';
				$currentTabId = $k;
				$currentTabName = $v[1];
				include $this->baseInc . $v[0] . '.php';
				echo '</div>';
			}
			echo '</div>';
		} else {
			// tabbed view
			$s = '<div class="tabbed">';
			$s .= '<div class="tabs">';

			if (count($this->tabs) - 1 < $this->active) {
				//Last selected tab is not available in this view. eg. Child tasks
				$this->active = 0;
			}
			foreach ($this->tabs as $k => $v) {
				$class = ($k == $this->active) ? 'tabon' : 'taboff';
				$s .= '<a id="toptab_' . $k . '" class="' . $class . '" href="';
				if ($this->javascript) {
					$s .= 'javascript:' . $this->javascript . '(' . $this->active . ', ' . $k . ')';
				} elseif ($js_tabs) {
					$s .= 'javascript:show_tab(' . $k . ')';
				} else {
					$s .= $this->baseHRef . 'tab=' . $k;
				}
				$s .= '">' . ($v[2] ? $v[1] : $AppUI->_($v[1])) . '</a>';
			}
			$s .= '</div>';

			$s .= '<div class="tabox">';
			echo $s;
			//Will be null if the previous selection tab is not available in the new window eg. Children tasks
			if (isset($this->tabs[$this->active][0]) && $this->tabs[$this->active][0] != '') {
				$currentTabId = $this->active;
				$currentTabName = $this->tabs[$this->active][1];
				if (!$js_tabs) {
					require $this->baseInc . $this->tabs[$this->active][0] . '.php';
				}
			}
			if ($js_tabs) {
				foreach ($this->tabs as $k => $v) {
					echo '<div class="tab" id="tab_' . $k . '">';
					$currentTabId = $k;
					$currentTabName = $v[1];
					require $this->baseInc . $v[0] . '.php';
					echo '</div>';
					echo '<script language="javascript" type="text/javascript">
						<!--
						show_tab(' . $this->active . ');
						//-->
						</script>';
				}
			}
			echo '</div></div>';
		}
	}
}

