<?php

if (isset($_POST['otp']) && $_POST['otp'] && $_POST['username'])
{
	$otp = strtolower ($_POST['otp']);

	// $token_id would normally be retrived from db
	$token_id = md5 ("ccccccbthkit:hsugieta@gmail.com");

	echo "<html>\n";
	echo "<head><title>Yubico Results</title>\n";
	echo "<style>\n";
	echo "<!--\n";
	echo "body { font-family: courier; }\n";
	echo "//->\n";
	echo "</style>\n";
	echo "</head>\n";
	echo "<body>\n";

	if (md5 (substr ($otp, 0, 12).":".$_POST['username']) == $token_id)
	{
		require_once "Yubikey.php";

/******************************************************************************
		Add your id and key to the variables below.
		NOTE: The apiID is an integer and the signatureKey is a string.
*******************************************************************************/

		$apiID = 14099;
		$signatureKey = "/Efe/hZReEaUeAtEj8wobp5hNrQ=";
//		$apiID = 14101;
//		$signatureKey = "SfmKw786BVRJOo6eKUtsc7/w2QU=";

/*****************************************************************************/

		$token = new Yubikey($apiID, $signatureKey);

		$token->setCurlTimeout(20);
		$token->setTimestampTolerance(500);

		echo "<p>CURL Timeout: ".$token->getCurlTimeout()."</p>\n";
		echo "<p>Timestamp Tolerance: ".$token->getTimestampTolerance()."</p>\n";

		if ($token->verify($otp))
		{
			echo "<p>PASS</p>";
		}
		else
		{
			echo "<p>FAILED</p>";
		}

		echo "\n<p>Response: ".$token->getLastResponse()."</p>\n";
	}
	else
	{
		echo "<p>That isn't your Yubikey.</p>\n";
	}

	echo "<a href=\"".$_SERVER['PHP_SELF']."\">Start Over</a>\n";
	echo "</body>\n";
	echo "</html>";

	exit;
}

?><html>
<head>
<title>Yubico Test</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<p>Enter your Username: <input type="text" name="username" value="hsugieta@gmail.com" size="48" maxlength="48" /></p>
<p>Enter your Yubico key: <input type="text" name="otp" size="48" maxlength="48" />
<input type="submit" name="submit" value="Submit" /></p>
</form>
</body>
</html>
