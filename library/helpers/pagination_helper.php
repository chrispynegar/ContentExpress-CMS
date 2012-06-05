<?php

class Pagination {
	
	public $current_page;
	public $per_page;
	public $total_count;
	
	public function __construct($page = 1, $per_page = 3, $total_count = 0) {
		$this->current_page = (int)$page;
		$this->per_page = (int)$per_page;
		$this->total_count = (int)$total_count;
	}
	
	public function offset() {
		return ($this->current_page - 1) * $this->per_page;
	}
	
	public function total_pages() {
		return ceil($this->total_count / $this->per_page);
	}
	
	public function previous_page() {
		return $this->current_page - 1;
	}
	
	public function next_page() {
		return $this->current_page + 1;
	}
	
	public function has_previous_page() {
		return $this->previous_page() >= 1 ? true : false;
	}
	
	public function has_next_page() {
		return $this->next_page() <= $this->total_pages() ? true : false;
	}
	
	public function display($file, $page) {
		echo '<div class="pagination-wrap">';
		if($this->total_pages() > 1) {
			echo '<ul class="pagination">';
			if($this->has_previous_page()) {
				echo '<li><a href="./'.$file.'?page=';
				echo $this->previous_page();
				echo '">&laquo;</a></li>';
			}
			for($i = 1; $i <= $this->total_pages(); $i++) {
				if($i == $page) {
					echo '<li><a href="./'.$file.'?page='.$i.'" class="active disable-link">'.$i.'</a></li>';
				} else {
					echo '<li><a href="./'.$file.'?page='.$i.'">'.$i.'</a></li>';
				}
			}
			if($this->has_next_page()) {
				echo '<li><a href="./'.$file.'?page=';
				echo $this->next_page();
				echo '">&raquo;</a></li>';
			}
			echo '</ul>';
		}
		echo '</div>';
	}
	
}

?>