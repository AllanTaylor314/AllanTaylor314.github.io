<?php
header('Content-Type: text/plain');
//modify these two lines: $dir is the full path to your website from root directory
$dir = '/storage/ssd3/235/1533235/public_html/';
//Your site url, including trailing forward slash
$url = 'https://allantaylor314.github.io/';
echo $url."\n"; // home directory
function map_dir($f_dir) {
    $filelist = scandir($f_dir);
    //Add regex to ignore in here VVVVVVVVVVV (files starting with '.', js and css files, and index files(these are included when their parent directory is outputted))
    $filelist = preg_grep('{(^\.|\.js|\.css|index\.+|INDEX\.+)}', $filelist, PREG_GREP_INVERT);
    $dirlist = preg_grep('{\.}', $filelist, PREG_GREP_INVERT);
    foreach ($filelist as $key => $name) {
        if (preg_match('/(?s)^((?!\.).)*$/', $name)) {
            $filelist[$key] = $name . '/';
        }
    }
    foreach ($filelist as $filekey => $filename) {
        echo $_GLOBALS['url'] . str_replace($_GLOBALS['dir'], '', $f_dir) .$filename."\n";
        if ($filename[strlen($filename)-1] == '/'){
            map_dir($f_dir . $filename);
        }
    }
}
map_dir($dir);
?>
