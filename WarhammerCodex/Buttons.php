$pinfo = pathinfo($_SERVER["SCRIPT_FILENAME"]);
$reqpath = dirname($_SERVER["REQUEST_URI"]);

if(preg_match("/(.*?)(\d+)\.php/",  $pinfo["basename"], $matches)) {
    $fnbase = $matches[1];
    $fndir = $pinfo["dirname"];
    $current = intval($matches[2]);
    $next = $current + 1;
    $prior = $current - 1;
    $next_file = $fndir . DIRECTORY_SEPARATOR . $fnbase . $next . ".php";
    $prior_file = $fndir . DIRECTORY_SEPARATOR . $fnbase . $prior . ".php";

    if(!file_exists($next_file)) $next_file = false;
    if(!file_exists($prior_file)) $prior_file = false;


    if($prior_file) {
        $link = $reqpath . DIRECTORY_SEPARATOR . basename($prior_file);

        echo "<a href=\"$link\">Prior</a>";
    }

    if($prior_file && $next_file) {
        echo " / ";
    }

    if($next_file) {
        $link = $reqpath . DIRECTORY_SEPARATOR . basename($next_file);

        echo "<a href=\"$link\">Next</a>";
    }
}