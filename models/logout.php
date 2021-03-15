<?php 
	session_start();
	if (session_destroy()) {
		?> 
			<script >
				localStorage.removeItem('online_status') 
				localStorage.removeItem('status') 
			</script>  
		<?php
	}
?>