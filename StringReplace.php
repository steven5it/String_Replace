
<?php
//str_replace (needle, what to replace with, haystack to search on)
	//NOTE: when passing in array, will replace index at a time
	//use associative arrays and keys:
		//'text to replace' => 'replacement'
		//str_replace (array_keys($replacements), $replacements, $string);

//reads in a file, creates an array of replacement values
$path_to_file = "UPD1mortgagemodificationmaryland.wordpress.2013-06-04.txt"; //enter filename
//regular expressions start and end with same char
//patterns array to match patterns, replace is what to replace with
$patterns = array (
	'/<p\>/',
	'/<P\>/',
	'/<\/p>/',
	'/< \/p>/',
	'/<\/P>/',
	'/<wp:post_date\>(.*?)\<\/wp:post_date\>/', //(.*? => .* is anything and ? matches as few as pssible)
	'/<wp:post_date_gmt\>(.*?)<\/wp:post_date_gmt\>/',
	'/<pubDate\>(.*?)<\/pubDate\>/',
	'/<wp:post_id\>[0-9]+<\/wp:post_id\>/',
	'/<guid isPermaLink="false"\>(.*?)<\/guid\>/',
	'/<div(.*?)>/',
	'/<\/div>/'
	);

$replace = array (
	'',
	PHP_EOL,
	PHP_EOL,
	PHP_EOL,
	PHP_EOL,
	"<wp:post_date>0000-00-00 00:00:00</wp:post_date>",
	"<wp:post_date_gmt>0000-00-00 00:00:00</wp:post_date_gmt>",
	"<pubDate>Sun 00 Jan 0000 00:00:00 +0000</pubDate>",
	"<wp:post_id>0</wp:post_id>",
	"<guid isPermaLink=\"false\">http://www.mortgagemodificationmaryland.com/?page_id=0</guid>",
	'',
	PHP_EOL
	);

	//"" => "",
	//"#\<pubDate\>(.*?)\<\/pubDate\>#" => ""
//);
echo "Arrays created.<br> ";
if($path_to_file) {
	echo "File exists.<br> ";
	$file_contents = file_get_contents($path_to_file);
	//echo "Original file contents: <br>" . $file_contents . " <br>";
	$file_contents = preg_replace($patterns, $replace, $file_contents, -1, $count); //replace string
	//echo "Updated file contents: <br>" . $file_contents . "<br>";
	file_put_contents('UPD' . pathinfo($path_to_file, PATHINFO_FILENAME) . '.xml', $file_contents); //change filename of newly created file

	//$file_contents = preg_replace($pattern, $replacement, $file_contents, -1, $count); 
	//file_put_contents('updated.txt', $file_contents);
}
else {  echo "File does not exist."; }
echo 'The number of replaced sequences is ' . $count;



?>