<?php

$arr = array('11', '12', 'cii', '001', '2', '1998', '7', '89', 'iia', 'fii');
// removing numeric
$stringArray = array_map(function ($elem) {
    return preg_replace('/[0-9]/', "", $elem);
}, $arr);
// make array of only strin
$stringArray = array_values(array_filter($stringArray));

// make substring of string array
$substrings = [];
foreach ($stringArray as $val) {
    for ($i = 1; $i <= strlen($val); $i++) {
        $substrings[$val][] = substr($val, 0, $i);
    }
}

// merge every char
$s = [];
foreach ($substrings as $val) {
    $s = array_merge($s, $val);
}

// remove duplication
$s = array_unique($s);
// sort alphabet
sort($s);

$result = [];
foreach ($substrings as $key => $val) {
    $result[$key] = array_combine($val, $val);
}

// add all substrings to each element's value
foreach ($result as &$val) {
    foreach ($s as $sub) {
        if (strpos($key, $sub) !== false) {
            $val[$sub] = $sub;
        }
    }
}

// output every possible substring combination
print_r($result);
