<?php
	function getSession($value){
		if ($value === 'no') return "not eligible";
		else if($value === "yes") return "eligible";
		else return "not eligible";
	}
?>