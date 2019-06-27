<?php

/*
Search Text at Site
    use :
--list="" [ File list site or another ]
--path="" [ put path u want like ajax file or another, or just put / ]
--kata="" [ Text u want search at site/web ]
php filename.php list=list.txt --path="/" --kata="search text"
*/
error_reporting(0);
set_time_limit(13);

$list = explode("--list=", $argv[1]);
$urlx = file_get_contents($list[1]);
$urly = explode("\r\n",$urlx);
$path = explode ("--path=",$argv[2]);
$kata = explode ("--kata=",$argv[3]);

foreach ($urly as $url){
$web =  $url.$path[1];
$cekkata = file_get_contents ($web);

if(preg_match_all("/$kata[1]/",$cekkata)){
    $hasil = $web."\n[+] Found Kata [ $kata[1] ]\n"; 
    echo $hasil;
    $fp = fopen("hasil.txt", 'a+');
						fwrite($fp, $hasil);
						fclose($fp);
}
else{
echo $web."\n[-] Can't Found Kata [ $kata[1] ]\n";
   } 
}


?>
