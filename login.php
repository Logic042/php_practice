
<html>
<head>
<title>登陆界面</title>
</head>
<body>
	<div>
		<form  method="post">
			<input type="text" name="userName"> <br>
			<input type="password"name="userPass"> <br>
			<input type="submit" name="submit">
		</form>
	</div>
	<div>
		<?php 
		  date_default_timezone_set('PRC');   //使时间标准定位中华人民共和国（北京）
		  $arr=getdate();
		  echo $arr['year']."-".$arr['mon']."-".$arr['mday']."<br>";
		  echo $arr['hours'].":".$arr['minutes'].":".$arr['seconds']."<br>";
		  echo $arr['weekday']."<br>";
		  echo $arr['yday']."<br>";
		  echo "<br>";
		  
		  //从文件中读取数据
		  
		      //读取整个文件
		      readfile('./files/123.php');    //使用raedfile()函数读取文件，不需要fopen/fclose，直接读取文件到输出缓冲，读出失败则返回false；
		      echo "<br><br>";
		  
		  
		      if($f_arr=file('./files/456.txt'))
		      {
		          foreach ($f_arr as $cont)
		              echo $cont."<br>";
		      }
		      /*使用file()函数读取文件，将文件读取到数组中，包括换行符，若读取失败则返回false*/
		      echo "<br><br>";
		  
		      $f_char=file_get_contents('./files/456.txt');
		      echo $f_char;
		      /*使用file_get_contents('',offset,maxlen)函数读取文件，可选择从offset读取到maxlen，适用于二进制对象，是将整个文件内容读入到一个字符串中的首选方式*/
		      echo "<br><br>";
		      
		      
		      //读取一行数据
		      $fopen=fopen('./files/456.txt','r');
		      while(!feof($fopen)){
		          echo fgetss($fopen);
		      }
		      fclose($fopen);
		      echo "<br><br>";
		      
		      
		      //读取一个字符
		      $fopen=fopen('./files/456.txt','r');//若第二个选项为rb表示以只读形式打开一个二进制文件
		      $chr1=fgetc($fopen);
		      echo $chr1."<br>";
		      while(($chr=fgetc($fopen))!==false){
		          echo $chr;
		      }
		      fclose($fopen);
		      echo "<br><br>";
		      /*fgetc()逐个字符顺序读取文件，遇到文件末尾或EOF返回false*/
		      
		      
		      //读取任意长度字符串
		      $filename='./files/test.txt';
		      $fopen=fopen($filename,'r');
		      echo fread($fopen,300).'<br>';
		      fclose($fopen);
		      
		      
           //将数据写入文件
                //fwrite() 和 file_pit_contents()
                $fopen=fopen($filename,'rw');
                echo "fwrite()所写入文件的内容";
                $str="1";
                fwrite($fopen,$str,200);
                fclose($fopen);
                $out_str=file_get_contents($filename);
                echo $out_str;
                
                
                file_put_contents($filename,$str,FILE_APPEND);
                echo "file_put_contents()所写入文件的内容"."<br>";
                $out_str=file_get_contents($filename);
                echo $out_str;
                /*file_put_contents(string filename,string date,flags)函数flags的选择有“FILE_USE_INCCLUDE_PATH(检查filename副本的内置路径)、FILE_APPEND(设置为在原文件后追加内容)、LOCK_EX(对文件进行上锁)”*/
                
                
                /*文件操作函数
                 * bool copy(string path1,string path2)  复制文件，将文件有path1复制至path2
                 * bool rename(string name1,string name2) 重命名文件，将文件名由name1更改为name2
                 * bool unlink(string filename) 删除文件
                 * int fileatime(string filename) 返回文件最后一次被访问的UNIX时间戳，可使用date('Y-m-d H:i:s',fileatime($filename))转换为标准时间
                 * int filemtime(string filename) 返回文件最后一次被修改的UNIX时间戳
                 * int filesize(string filename) 返回文件大小(bytes)
                 * string realpath(string filename) 返回文件的绝对路径
                 * array pathinfo(string filename,options) 返回一个数组，表示文件路径信息，options的可选项有PATHINFO_DIRNAME、PATHINFO_BASENAME、PATHINFO_EXTENSION，默认返回全部信息，可用foreach输出
                 * array stat(string filename) 返回一个数组，包括文件的相关信息，例如文件大小、最后修改时间等
                 * */
                echo date('Y-m-d H:i:s',filemtime("$filename"))."<br>";
                
                
                
          //目录操作
            //打开、关闭目录
            if(is_dir($filename)){              //is_dir()函数判断是否为一个合法目录,返回true或false
                if($m_dir=@opendir($filename))  //opendir()打开文件，在opendir()前加上@可用抑制错误信息输出，成功打开返回目录指针
                    echo $m_dir;
                else{ 
                    echo"错误的路径";
                    exit();
                }
                closedir($m_dir);               //注意不要将局部变量写到外面，会报错
            }
            
            
            //浏览目录
            $path="./files";
            if(is_dir($path)){
                $dir=scandir($path);
                foreach($dir as $value){
                    //mb_convert_encoding($value,"utf-8","big5");
                    //iconv("gb18030","utf-8",$value);
                    iconv('GB18030','utf-8//IGNORE',$value);
                    echo $value."<br>";
                }
            }
            else echo"错误的目录信息";
            
		      
            /*常用目录操作函数
             * bool mkdir(string pathname)  新建目录
             * bool rmdir(string dirname)  删除空目录
             * string getcwd()  取得当前工作的目录
             * bool chdir(string directory)  改变当前目录为directory
             * float disk_free_space(string dectory)  返回目录中的可用空间（byte）
             * float disk_total_space(string dectory)  返回目录的总空间大小
             * string readdir(resource handle) 返回目录中下一个文件的文件名，handle使用opendir打开
             * void rewinddir(resourse handle)  将指定目录重新指定到目录的开头
             * */
		      
		      
		      
		      
		?>
	</div>
</body>
</html>
<?php
    if(isset($_POST["submit"])&& $_POST['userName']==$_POST['userPass'])
    {
        echo $_POST['userName'];
        echo "登陆成功";
    }
?>