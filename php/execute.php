<?php

require('../inc/config.inc.php');


$tmp_filename = sha1(microtime(true).mt_rand(0,10000000));

$code_filename = TEMP_DIRECTORY.'/'.$tmp_filename.'.c';
$output_filename = TEMP_DIRECTORY.'/'.$tmp_filename.'.js';

unlink($code_filename);

/* Write Into Code */
$fp = fopen($code_filename, "w");
fwrite($fp, $_POST['code'], strlen($_POST['code']) + 1);
fclose($fp);

/* Hopefully not too unsafe */
ob_start();
    $status = system(COMPILER_C.' -o '.$output_filename.' '.$code_filename. ' 2>&1');
$g = ob_get_contents();
ob_end_clean();

$contents = file_get_contents($output_filename);

unlink($code_filename);
unlink($output_filename); 

echo $contents;

?>
