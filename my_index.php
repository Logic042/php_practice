<?php
require_once 'my_dirfunction.php';
require_once 'my_filefunction.php';
require_once 'common.php';
$path = "G:/PHP_test/My_fileManager/files"; // 需要管理的文件的路径
$info = readDirectory($path);
// print_r($info);
$path = $_REQUEST['path'] ? $_REQUEST['path'] : $path;
$act = $_REQUEST['act'];
$fileName = $_REQUEST['fileName'];
$folderName = $_REQUEST['folderName'];
if (! $info)
    echo "<script>alert('沒有文件或目录');location.href='my_index.php';</script>";
$redriect = "my_index.php?path={$path}";
if ($act == "创建文件") {
    echo $path, "--";
    echo $filename;
    $mes = createFile($path . '/' . $fileName);
    alertMes($mes, $redriect);
} elseif ($act == "创建文件夹") {
    $mes = createFolder($path . '/' . $folderName);
    alertMes($mes, $redriect);
} elseif ($act == "上传文件") {
    $fileInfo = $FILES['dstname'];
    $mes = uploadFile($fileInfo, $path);
    alertMes($mes, $redriect);
}

?>
<html>
<head>
<meta charset="utf-8">
<title>在线文件管理系统</title>
<link href="fileManager.css" rel="stylesheet" type="text/css">
<link href=Cikonss-master/cikonss.css rel="stylesheet" type="text/css">
<script text="text/javascript">
// 	function show(dis)
// 	{
// 		debugger;
// 		var name=document.getElementById(dis);
// 		name.style="display:show";
// 	}
	</script>
</head>
<body>
	<h1>
		文件在线管理系统
		<h1>
			<div class="f_main" style="height: 80px;">
				<ul>
					<li><a href="my_index.php" title="主目录"><span
							style="margin-left: 8px; margin-top: 0px; top: 4px;"
							class="top_images icon icon-small icon-square "><span
								class="icon-home"></span></span></a></li>
					<li><a href="#" onclick="show('createFile')" title="新建文件"><span
							style="margin-left: 8px; margin-top: 0px; top: 4px;"
							class="top_images icon icon-small icon-square"><span
								class="icon-file"></span></span></a></li>
					<li><a href="#" onclick="show('createFolder')" title="新建文件夹"><span
							style="margin-left: 8px; margin-top: 0px; top: 4px;"
							class="top_images icon icon-small icon-square"><span
								class="icon-folder"></span></span></a></li>
					<li><a href="#" onclick="show('uploadFile')" title="上传文件"><span
							style="margin-left: 8px; margin-top: 0px; top: 4px;"
							class="top_images icon icon-small icon-square"><span
								class="icon-upload"></span></span></a></li>
			<?php
$back = ($path == "files") ? $path : dirname($path);
?>
			<li><a href="#" title="返回上级目录"
						onclick="goBack('<?php echo $back;?>')"><span
							style="margin-left: 8px; margin-top: 0px; top: 4px;"
							class="top_images icon icon-small icon-square"><span
								class="icon-arrowLeft"></span></span></a></li>
				</ul>
			</div>
			<div class="f_main">
				<form action="my_index.php" method="post">
					<table border="0" style="margin-left: 48px;">
						<tr id="createFile" style="display: none;">
							<td>请输入创建文件的名称</td>
							<td><input type="text" name="fileName"> <input type="hidden"
								name="path" value="<?php echo "$path"; ?>"> <br />
							<br /> <input type="submit" name="act" value="创建文件"></td>
						</tr>
						<tr id="createFolder" style="display: none;">
							<td>请输入创建文件夹的名称</td>
							<td><input type="text" name="folderName"> <input type="hidden"
								name="path" value="<?php echo "$path"; ?>"> <br />
							<br /> <input type="submit" name="act" value="创建文件夹"></td>
						</tr>
						<tr id="uploadFile" style="display: none;">
							<td>请选择要上传的文件</td>
							<td><input type="file" name="myfile" /> <br />
							<br /> <input type="submit" name="act" value="上传文件"></td>
						</tr>
					</table>
				</form>
			</div>
			<table class="f_main" border="0" cellpadding="5" cellspacing="0"
				bgcolor="#F0F8FF">
				<tr border="1">
					<td>编号</td>
					<td>名称</td>
					<td>类型</td>
					<td>大小</td>
					<td>可读</td>
					<td>可写</td>
					<td>可执行</td>
					<td>创建时间</td>
					<td>修改时间</td>
					<td>访问时间</td>
					<td>操作</td>
				</tr>
				<!-- 读取文件 -->
		<?php
if ($info['file']) {
    $i = 0;
    foreach ($info['file'] as $value) {
        $fileName = $path . "/" . $value;
        ?>
		<tr>
					<td><?php echo $i+1;?></td>
					<td><?php echo $value=iconv('GB18030','utf-8//IGNORE',$value);?></td>
					<td><?php  $src=filetype($fileName);if ($src='file') echo"<img src='images/file_ico.png' title='file' class='show_images'>"?></td>
					<td><?php echo transByte(filesize($fileName));?></td>
					<td><?php if (is_readable($fileName)) echo "<img src='images/correct.png' title='Yes' class='show_images'>";else echo "<img src='images/error.png' title='No' class=show_images>";?></td>
					<td><?php if (is_writable($fileName)) echo "<img src='images/correct.png' title='Yes' class='show_images'>";else echo "<img src='images/error.png' title='No' class=show_images>";?></td>
					<td><?php if (is_executable($fileName)) echo "<img src='images/correct.png' title='Yes' class='show_images'>";else echo "<img src='images/error.png' title='No' class=show_images>";?></td>
					<td><?php echo date("Y-m-d H:i:s",filectime($fileName));?></td>
					<td><?php echo date("Y-m-d H:i:s",filectime($fileName));?></td>
					<td><?php echo date("Y-m-d H:i:s",filectime($fileName));?></td>
					<td>
			<?php
        $ext = strtlow(end(explode(".", $value)));
        $imageExt = array(
            "gif",
            "jpg",
            "jpeg",
            "png"
        );
        if (in_array($ext, $imagesExt)) {
            ?>
			<a href="#"
						onclick="showDetail('<?php echo $value;?>','<?php echo $dirName;?>')><img 
						class="show_images" src="images/show.png" title="查看"></a>
			<?php
        } else {
            ?>
			<a href="my_index.php?path=<?php echo $fileName;?>"><img
							class="show_images" alt="" src="images/show.png" title="查看"></a>
			<?php }?>
			<a href=""></a>
					</td>
				</tr>
		
		<?php
        $i ++;
    }
}
?>
		<!--读取目录 -->
		<?php
if ($info['dir']) {
    $i = $i == null ? 1 : $i;
    foreach ($info['dir'] as $value) {
        $dirName = $path . "/" . $value;
        
        ?> 
		<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $value=iconv('GB18030','utf-8//IGNORE',$value);?></td>
					<td><?php $src=filetype($dirName)=="file"?"file_ico.png":"folder_ico.png";?><img
						src="images/<?php echo $src;?>" title="folder" class="show_images"></td>
					<td><?php $sum=0; echo transByte(dirSize($dirName));?></td>
					<td><?php $src=is_readable($dirName)?"correct.png":"error.png"; ?><img
						src="images/<?php echo $src;?>" class="show_images"></td>
					<td><?php $src=is_writable($dirName)?"correct.png":"error.png"; ?><img
						src="images/<?php echo $src;?>" class="show_images"></td>
					<td><?php $src=is_executable($dirName)?"correct.png":"error.png"; ?><img
						src="images/<?php echo $src;?>" class="show_images"></td>
					<td><?php echo date("Y-m-d H:i:s",filectime($dirName));?></td>
					<td><?php echo date("Y-m-d H:i:s",filemtime($dirName));?></td>
					<td><?php echo date("Y-m-d H:i:s",fileatime($dirName));?></td>
				</tr>
		
		<?php 
			$i++;
			}
		}
		?>
	</table>
			<div class="show_t" id=show_ti></div>
			<!-- 	<script type="text/javascript" src="show_time.js"></script> -->
			<script type="text/javascript" src="commen.js"></script>

</body>
</html>