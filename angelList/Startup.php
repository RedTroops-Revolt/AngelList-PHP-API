<?php

/**
 * Startup
 *
 * PHP 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the below copyright notice.
 *
 * @author     Robert Love <robert@pollenizer.com>
 * @copyright  Copyright 2012, Pollenizer Pty. Ltd. (http://pollenizer.com)
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * AngelList
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'AngelList.php';

/**
 * Startup
 *
 * AngelList API / Startups
 *
 * @link http://angel.co/api/spec/startups
 */
class Startup extends AngelList {

 /**
  * Name
  *
  * @var string
  */
 public $name = 'startups';

 /**
  * Startups Info
  *
  * Returns the startup info - all details.
  *
  * @param int $id
  * @return array $response
  * @link https://api.angel.co/1/startups/6702
  */
 public function get($id) {
  $url = $this->endpointUrl . '/' . $this->name . '/' . $id;
  return $this->getResponse($url);
 }

 /**
  * Startups
  *
  * Returns up to 50 startups at a time, given an array of ids.
  *
  * @param array $ids
  * @return array $response
  * @link http://angel.co/api/search
  */
 public function startupsWithRaising(array $parameters) {
  $query = http_build_query($parameters);

  $url = $this->endpointUrl . '/search?' . $query;
  $results = $this->getResponse($url);

  $startups = array();
  if (sizeof($results) > 0) {
   foreach ($results as $result) {
    $info = $this->get($result['id']);
    if (isset($info['fundraising'])) {
     $startups[] = $info;
    }
   }
  }
  return $startups;
 }

 /**
  * searchByFundraisingDetails
  *
  * Returns up to 50 startups at a time, given an array of ids.
  *
  * @param array $ids
  * @return array $response
  * @link http://angel.co/api/search
  */
 public function searchByFundraisingDetails($type, $number = 0, $number2 = 1, $params) {
  $query = http_build_query($params);

  $url = $this->endpointUrl . '/' . $this->name . '?' . $query;
  $results = $this->getResponse($url);

  $startups = array();
  if (sizeof($results['startups']) > 0) {
   foreach ($results['startups'] as $result) {
    $info = $this->get($result['id']);
    if (isset($info['fundraising']) && $info['fundraising'][$type] >= $number && $info['fundraising'][$type] < $number2) {
     $startups[] = $info;
    }
   }
  }
  return $startups;
 }

 /**
  * raising
  *
  * Returns up to 50 startups at a time, given an array of ids.
  *
  * @param array $ids
  * @return array $response
  * @link http://angel.co/api/spec/startups#GET%2Fstartups%2Fbatch
  */
 public function raising($page = 1, $per_page = 3) {
  $url = $this->endpointUrl . '/' . $this->name . '/?filter=raising&page=' . $page . '&per_page=' . $per_page;
  $results = $this->getResponse($url);
  return $results;
 }

}
