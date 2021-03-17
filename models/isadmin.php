<?php
	function getSession($value){
		if ($value === 'no') return "not eligible";
		else if($value === "yes") return "eleigible";
		else return "not eligible";
	}
?>