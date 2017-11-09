<?php 
// Chargé dans config/app.php -> require(app_path('helpers.php'));
function truncate($string, $length)
{
	$truncated = substr($string, 0, strpos(wordwrap($string, $length), "\n"));
    return (strlen($string) > $length) ? $truncated . '...' : $string;
}

function minimum_version($num) 
{
    return (version_compare(env('VERSION'), $num) > -1) ? true : false;
}

//Compare two sets of versions, where major/minor/etc. releases are separated by dots. 
//Returns 0 if both are equal, 1 if A > B, and -1 if B < A. 
function version_compare2($a, $b) 
{ 
    $a = explode(".", rtrim($a, ".0")); //Split version into pieces and remove trailing .0 
    $b = explode(".", rtrim($b, ".0")); //Split version into pieces and remove trailing .0 
    foreach ($a as $depth => $aVal) 
    { //Iterate over each piece of A 
        if (isset($b[$depth])) 
        { //If B matches A to this depth, compare the values 
            if ($aVal > $b[$depth]) return 1; //Return A > B 
            else if ($aVal < $b[$depth]) return -1; //Return B > A 
            //An equal result is inconclusive at this point 
        } 
        else 
        { //If B does not match A to this depth, then A comes after B in sort order 
            return 1; //so return A > B 
        } 
    } 
    //At this point, we know that to the depth that A and B extend to, they are equivalent. 
    //Either the loop ended because A is shorter than B, or both are equal. 
    return (count($a) < count($b)) ? -1 : 0; 
} 
