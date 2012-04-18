<?php

class Chat extends CI_Controller {

	function Chat()
	{
		parent::__construct();	
		
		$this->load->model('chat/chat_model');	
	}
	
	function test($chat_id)
	{
		var_dump($this->chat_model->get_chat_messages($chat_id)->result());
		echo "salut";
	}
	
	
	
	function index()
	{
		/* send in chat id and user id */

		$this->view_data['chat_id'] = 1;
		
		// check they are logged in
		if (! $this->session->userdata('logged_in')) {
			//redirect('user/login');
		}
		
		$this->view_data['user_id'] = $this->session->userdata('user_id');
		
		$this->session->set_userdata('last_chat_message_id_' . $this->view_data['chat_id'], 0);
		
		//$this->load->view('chat/view_main', $this->view_data);	
	}
	
	
	function ajax_add_chat_message()
	{
		/* Things that need to be POST'ed to this function
		 * 
		 * chat_id
		 * user_id
		 * chat_message_content
		 * 		 * 
		 */
		
		$chat_id = $this->input->post('chat_id');
		$user_id = $this->input->post('user_id');
		$chat_message_content = $this->input->post('chat_message_content', TRUE);
		
		$this->chat_model->add_chat_message($chat_id, $user_id, $chat_message_content);
		
		// grab and return all messages
		echo $this->_get_chat_messages($chat_id);
	}
	
	function ajax_get_chat_messages()
	{
		$chat_id = $this->input->post('chat_id');
		$chat_id = 1;
		echo $this->_get_chat_messages($chat_id);
	}
	
	function _get_chat_messages($chat_id)
	{
		
		$last_chat_message_id = (int)$this->session->userdata('last_chat_message_id_' . $chat_id); 
		
		$chat_messages = $this->chat_model->get_chat_messages($chat_id, $last_chat_message_id);	
		
		$last_chat_message_id = 0;
		
		if ($chat_messages->num_rows() > 0)
		{
			// store the last chat message id
			$last_chat_message_id = $chat_messages->row($chat_messages->num_rows() - 1)->chat_message_id;
			
			$this->session->set_userdata('last_chat_message_id_' . $chat_id, $last_chat_message_id);
			
			// we have some chat let's return it
			
			$chat_messages_html = '<ul>';
			
			foreach ($chat_messages->result() as $chat_message)
			{
				$li_class = ($this->session->userdata('user_id') == $chat_message->user_id) ? 'class="by_current_user"' : '';
				
				$chat_messages_html .= '<div class="form-actions">' .$chat_message->name .'<h5><li ' . $li_class . '>' . '</span><p class="message_content">' . $chat_message->chat_message_content . '<br>'.'<span class="chat_message_header">Le ' . $chat_message->chat_message_timestamp .'</p></li></h5></div>';
				
				//$chat_messages_html .= '<li ' . $li_class . '>' . '<span class="chat_message_header">' . $chat_message->chat_message_timestamp . ' by ' . $chat_message->name . '</span><p class="message_content">' .  $chat_message->chat_message_content . '</p></li>';
			}
			
			$chat_messages_html .= '</ul>';
			
			$result = array('status' => 'ok', 'content' => $chat_messages_html);
			
			return json_encode($result);
			exit();
		}
		else
		{
			// we have no chat yet
			$result = array('status' => 'ok', 'content' => '');
			
			return json_encode($result);
			exit();
		}
	}
	
}