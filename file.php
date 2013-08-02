<?php

	//path to directory to scan
$directory = "galeria/";
$fp = fopen('data.txt', 'w');
 
//get all files in specified directory
$files = glob($directory . "*");
 
//print each file name
foreach($files as $file)
{
	//check to see if the file is a folder/directory
 	if(is_dir($file))
 	{
  		fwrite($fp, $file."\n");
 	}
}

fclose($fp);

?>