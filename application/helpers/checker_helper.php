<?php

function authorized_user() {
	$ci =& get_instance();
	$user_session = $ci->session->userdata('user_id');
	if($user_session)
	{
		redirect('dashboard');
	}
}

function unauthorized_user() {
	$ci =& get_instance();
	$user_session = $ci->session->userdata('user_id');
	if(!$user_session)
	{
		redirect('auth');
	}
}