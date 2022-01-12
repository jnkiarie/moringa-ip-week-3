<?php

	// load in mailchimp library
	include('./MailChimp.php');
	
	// namespace defined in MailChimp.php
	use \DrewM\MailChimp\MailChimp;
	
	// connect to mailchimp
	$MailChimp = new MailChimp('a25a4c3d70e6ce0fd2b309d920330bcf-us20'); // put your API key here
	$list = 'aa7c42d636'; // put your list ID here
	$email = $_GET['EMAIL']; // Get email address from form
	$id = md5(strtolower($email)); // Encrypt the email address
	// setup the merge fields
	$mergeFields = array(
        'FNAME' => $_GET['FNAME'],
        'MONITOR' => $_GET['MONITOR'],
		// *** YOUR FIELDS GO HERE ***
		);

	// remove empty merge fields
	$mergeFields = array_filter($mergeFields);

	$result = $MailChimp->put("lists/$list/members/$id", array(
									'email_address'     => $email,
									'status'            => 'subscribed',
									'merge_fields'      => $mergeFields,
									'update_existing'   => true, // YES, update old subscribers!
							));
	echo json_encode($result);