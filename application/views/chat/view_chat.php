<script type="text/javascript">

<?php

$chat_id =1; $user_id=20;

//$this->session->set_userdata('last_chat_message_id_' . $chat_id, 0);
?>

var chat_id = "<?php if($this->session->userdata('logged_in')) {echo $this->session->userdata('chat_id');} else {echo $chat_id;} ?>";
var user_id = "<?php if($this->session->userdata('logged_in')) {echo $this->session->userdata('user_id');} else {echo $user_id;} ?>";

</script>

<style type="text/css">

div#chat_viewport

{
	font-family:Verdana, Arial, sans-serif;
	padding:0px;

	
	min-height:300px;

	max-height:745px;

	overflow:auto;
	
	margin-bottom:0px;

	}

div#chat_viewport ul {
	font-size:0.8em;
	
	list-style-type:none;
	margin: 0px;
	padding-left:0px;
	
	
}


span.chat_message_header {
	font-size:0.7em;
	font-family:"MS Trebuchet", Arial, sans-serif;
	color:#547980;
}

p.message_content {

	margin-top:0px;
	margin-bottom:0px;
	padding-left:0px;
	margin-right:0px;
}

input#chat_message {
	margin-top:0px;

	font-size:0.9em;
	margin-right:0px;
}

input#submit_message {
	font-size:2em;

	vertical-align:top;
	margin-top:0px;
}

div#chat_input {
	margin-bottom:0px;
	}

div#chat_viewport ul li.by_current_user span.chat_message_header {
	color:#e9561b;
}
	
</style>

<div id="chat_input">

<form class="form-actions form-inline">

<?php
	if($this->session->userdata('logged_in'))
	{
		echo '<input  class="span7" id="chat_message" name="chat_message" value="" tabindex="1" placeholder="votre message"/>';
		echo '&nbsp;';
		echo '<a class="btn" id="submit_message" title ="Envoyer un message" href="#">Share</a>';
	}
	else
	{
		echo '<input class="disabled" id="disabledInput" type="text" placeholder="Loggez vous pour publier" disabled>';
	}
	
?>

</form>

	<div style="text-align:center;" class="label label-info">
	Parlons en Mahorais
	</div>
	
</div>

<div id="chat_viewport">

</div>
