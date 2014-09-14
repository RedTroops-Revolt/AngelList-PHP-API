<?php

/**
 * vd
 * Short cut to var_dump
 * 
 * @param $array
 * 
 * @return var_dump
 */
function vd($array, $die = 0) {
 echo "<pre>";
 if ($die == 0) {
  die(var_dump($array));
 } else {
  echo(var_dump($array));
 }
}

function textLimit($string) {
 $string = strip_tags($string);
 if (strlen($string) > 200) {
  $stringCut = substr($string, 0, 200);
  $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... <a href="#">Read More</a>';
 }
 return $string;
}

function findInArray($array, $key, $val) {
 foreach ($array as $item)
  if (isset($item[$key]) && $item[$key] == $val)
   return true;
 return false;
}

function searchBy($type) {
 $types = array('markets', 'locations');

 return in_array($type, $types);
}
