<?php
	//SESSION KEYS DEFINED IN LOGIN FILE
	echo "
		<script>
		  let message_id;
		  let user_type = '" . $_SESSION['USER_TYPE'] . "';
		  if (user_type == 'student'){
			message_id = " . $_SESSION['ID'] . ";
		  }
		</script>
	";
?>