<?php
/**
转换字节大小函数
传入 $size
返回 $arr[i]
 */
function transByte($size)
{
	$arr = array("Byte","KB","MB","GB","TB","EB");
	$i = 0;
	while($size >= 1024)
	{
		$size /= 1024;
		$i ++;
	}
	return round($size,2).$arr[$i];
}
/* $size=1023;
echo transByte($size); */

function createFile($fileName)
{
	$test="[\/,\*,\?,\|,<>]";
	if(! preg_match($test,basename($fileName)))
	{
		if (! file_exists($fileName))
		{
			if(touch($fileName))
				return "文件创建成功";
			else 
				return "文件创建失败";
		}
		else 
			return "文件已存在，请重命名之后创建";
	}
	else 
		return "文件名中存在非法字符:/,|,*,<>,?";
}

// function uploadFile($fileIntfo,$path,$allowExt=array("gif"))


?>