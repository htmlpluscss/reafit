<?php
	$from = "=?utf-8?B?" . base64_encode('ReaFitPro') . "?= ";
	$from .= "<info@reafit.ru>"; //от кого
	$subject = "=?utf-8?B?" . base64_encode('Обратный звонок') . "?= "; // Тема
	$text = htmlspecialchars($_GET['name']);
	$text .= '<br>'.htmlspecialchars($_GET['tel']);
	$text .= '<br>ip: <a href="http://ipgeobase.ru/?address=' . $_SERVER['REMOTE_ADDR'] . '">' . $_SERVER['REMOTE_ADDR'] . '</a>';

	send_mail($from, '79198889134@ya.ru', $subject, $text);

	function send_mail($from, $mail_to, $thema, $html)
	{
		$EOL = "\r\n";
		$boundary     = "--".md5(uniqid(time()));
		$headers    = "MIME-Version: 1.0;$EOL";
		$headers   .= "Content-Type: multipart/mixed; boundary=\"$boundary\"$EOL";
		$headers   .= "From: ".$from;
		$multipart  = "--$boundary$EOL";
		$multipart .= "Content-Type: text/html; charset=utf-8$EOL";
		$multipart .= "Content-Transfer-Encoding: base64$EOL";
		$multipart .= $EOL;
		$multipart .= chunk_split(base64_encode($html));
		$multipart .=  "$EOL--$boundary$EOL";
		mail($mail_to, $thema, $multipart, $headers);
	}