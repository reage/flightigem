<?php 
ini_set('memory_limit','640M');
set_time_limit(600);

$words = 0;

listDir("");//Set location here
var_dump($words);
function showtextintags($text)
{
	$text = preg_replace("/(\<script)(.*?)(script>)/si", "", "$text");
	$text = preg_replace("/(\<style)(.*?)(style>)/si", "", "$text");
	$text = strip_tags($text);
	$text = str_replace("<!--", "&lt;!--", $text);
	$text = preg_replace("/(\<)(.*?)(--\>)/mi", "".nl2br("\\2")."", $text);

	return $text;

}
function listDir($dir)
{
	Global $words;
    if(is_dir($dir))
    {
        if($handle = opendir($dir))
        {
            while($file = readdir($handle))
            {
                if($file != '.' && $file != '..')
                {
                    if(is_dir($dir.DIRECTORY_SEPARATOR.$file))
                    {
                        listDir($dir.DIRECTORY_SEPARATOR.$file);
                    }else{
                        //$r = file_get_contents($dir.DIRECTORY_SEPARATOR.$file);
						//$words += (str_word_count(showtextintags($r)));
                        $fl = fopen( $dir.DIRECTORY_SEPARATOR.$file, 'r' );
                        $i = 0;
                        while( !feof( $fl ) )
                        {
                            fgets( $fl );
                            $i++;
                        }
                        fclose( $fl );
                        $words += $i - 72;
                    }
                }
            }
        }
        closedir($handle);
    }else{
        echo 'Fetal folder!';
    }
}
?>
