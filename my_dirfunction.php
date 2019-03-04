<?php

/**
遍历目录函数 
获取指定文件最外层目录
传入 $path
返回 $$arr
 */
function readDirectory($path)
{
	if (is_dir($path))
	{
		//$path = iconv('gb2312','utf-8//IGNORE',$path);
		$handle = opendir($path);
		while (($item = readdir($handle)) !== false)
		{
			if ($item != "."&&$item != "..")
			{
				if (is_file($path."/".$item))
				{
					//$item = iconv('GB18030','utf-8//IGNORE',$item); 
					$arr['file'][] = $item;
				}
				if (is_dir($path."/".$item))
				{
					//$item = iconv('GB18030','utf-8//IGNORE',$item); 
					$arr['dir'][] = $item;
				}
			}
		}	
	}
	else 
		echo "错误的路径或该路径不存在";	
	closedir( $handle );	
	return $arr;
}

function dirSize($path) 
{
	$sum=0;
	global  $sum;
	$handle=opendir($path);
	while(($item=readdir($handle))!==false)
	{
		if($item!="."&&$item!="..")
		{
			if(is_file($path."/".$item))
			{
				$sum+=filesize($path."/".$item);
			}
			if(is_dir($path."/".$item))
			{
				$func=__FUNCTION__;
				$func($path."/".$item);
			}
		}
	}
	closedir($handle);
	return $sum;
}

function createFolder($dirName)
{
	if(checkFilename(basename($dirName)))
	{
		if(!file_exists($dirName))
		{
			if(mkdir($dirName,0777,ture))
			{
				$mes="文件夹创建成功";
			}
			else
			{
				$mes="文件夹创建失败";
			}
		}
		else $mes="存在同名文件夹";
	}
	else $mes="非法文件夹名称";
	return $mes;
}


/* $a="files";
$arr=readDirectory($a);
print_r($arr); */
?>
