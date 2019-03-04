<?php 
	function alertMes($mes,$url)
	{
		echo "<script type='text/javascript'>alert('{$mes}');location.href='{$url}';</script>";
	}

	function checkFilename($name)
	{
		$test="/[\/,\?,\*,<>,\|]/";
		if(preg_match($test,$name))
		{
			return false;
		}
		else 
			return true;
	}
?>