<?php

require('../inc/config.inc.php');
require('../inc/functions.inc.php');

$tmp_directory = '/tmp/'.sha1(microtime(true).mt_rand(0,10000000));

mkdir($tmp_directory);
chdir($tmp_directory);

$tmp_filename = sha1(microtime(true).mt_rand(0,10000000));

switch($_POST['language']) {
    case 'cpp':
        $code_filename = TEMP_DIRECTORY.'/'.$tmp_filename.'.cpp';
        $output_filename = TEMP_DIRECTORY.'/'.$tmp_filename.'.js';
        $compiler_string = COMPILER_CPP;    
        break;
    case 'c': default:
        $code_filename = TEMP_DIRECTORY.'/'.$tmp_filename.'.c';
        $output_filename = TEMP_DIRECTORY.'/'.$tmp_filename.'.js';
        $compiler_string = COMPILER_C;
        break;
}

unlink($code_filename);

/* Write Into Code */
$fp = fopen($code_filename, "w");
fwrite($fp, $_POST['code'], strlen($_POST['code']) + 1);
fclose($fp);

/* Hopefully not too unsafe */
ob_start();
        
    $status = system(COMPILER_C.' '.$output_filename.' '.$code_filename. ' 2>&1');

$error_status = ob_get_contents();
ob_end_clean();

$contents = file_get_contents($output_filename);

unlink($code_filename);
unlink($output_filename);
rrmdir($tmp_directory);

chdir('/tmp'); 

echo $contents;

if(empty($contents))
    echo "$('#output').html(\"<pre style='color:red'>". str_replace("\n", "<br>", htmlentities($error_status, ENT_QUOTES)) ."</pre>\")";

?>
