<?php
/*
Vote It Up Version 1.0.7 and above
This file is used for skinning purposes.
To install the voting widget with the updated skin, you'll need to use DisplayVotes(get_the_ID())

Forceful usage of themes: DisplayVotes(get_the_ID(), [name of theme]);

Pre-installed themes:
-Ticker
-Snap (Ticker)
-Bar
*/

function GetPathInfo($path, $level = 0) {
$r = array();
if ($handle = opendir($path)) {
    while (false !== ($file = readdir($handle))) {
	if ($file != '.' && $file != '..') {
        $r[count($r)] = $file;
	}
    }
}

return $r;
}

function AvailableSkins() {
$skins = '';
$filepath = str_replace("\\", "/", dirname(__FILE__))."/skins";

$skins = GetPathInfo($filepath);
return $skins;
}

function IsChecked($name) {
if (get_option('voteiu_skin') == $name) {
echo 'checked';
}
if ($name == '') {
if (get_option('voteiu_skin') == 'none' | get_option('voteiu_skin') == '') {
echo 'checked';
}
}
}

function SkinsConfig() {
$skins = AvailableSkins();
if (count($skins) > 0) {
?>

