<?php
/**
 * Extends the PaginatorHelper
 */
App::import('Helper', 'Paginator');
 
class ExPaginatorHelper extends PaginatorHelper {
 
	/**
	 * Adds and 'asc' or 'desc' class to the sort links
	 * @see /cake/libs/view/helpers/PaginatorHelper#sort($title, $key, $options)
	 */
	function sort($key = null, $title = null, $options = array()) {
 
		// get current sort key & direction
		$sortKey = $this->sortKey();
		$sortDir = $this->sortDir();
 
		// add $sortDir class if current column is sort column
		if ($sortKey == $key && $key !== null) {
 
			$options['class'] = $sortDir;
 
		}
		
		$options['direction'] = 'desc';
		
		$options['escape'] = false;
		$options['class'] .= " text-reset";
		if (strpos($options['class'], "asc") !== false 
			|| strpos($options['class'], "desc") !== false) {
			if ($sortDir == 'desc') {
				$title .= '<i class="icon-arrow-down" style="font-size:12px;margin:0 0 0 3px;"></i>'; //show down arrow
			} else {
				$title .= '<i class="icon-arrow-up" style="font-size:12px;margin:0 0 0 3px;"></i>'; //show up arrow
			}
		}
 
		return parent::sort($key, $title, $options);
 
	}
 
}
?>
