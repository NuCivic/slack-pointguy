<?php

$token = 'XEDLdo7T3QqUgsbZW8UInqUh';
$spreadsheet_url = 'https://docs.google.com/spreadsheet/pub?key=15Z0F9Ee6uRH4-vD1v-FuXvMB-6laF4F_m5Gsr7fhsDM&single=true&gid=0&output=csv';

/**
 * Load list of employees
 * @param  String $url Google Sheet URL
 * @return Array       Sheet data as an associative array
 */
function load_payroll($url) {
  if(!ini_set('default_socket_timeout', 15)) echo '<!-- unable to change socket timeout -->';
  if (($handle = fopen($url, 'r')) !== FALSE) {
    $headers = fgetcsv($handle, 0, ',');
    while (($data = fgetcsv($handle, 0, ',')) !== FALSE) {
      $spreadsheet[] = array_combine($headers, $data);
    }
    fclose($handle);
    return $spreadsheet;
  }
  else {
    throw new Exception('Problem reading csv', 1);
  }
}

/**
 * Search a go to guy by looking into all the
 * columns in the sheet. In this way we can divide
 * the employee skills by areas like skills, projects, etc.
 *
 * Returns the first matched employee
 * 
 * @param  [type] $needle  Term to look in the payroll
 * @param  [type] $payroll A list of all the employees
 * @return [type]          An employee
 */
function search_gotoguy($needle, $payroll) {
  foreach ($payroll as $employee) {
    foreach ($employee as $header => $value) {
      $tags = explode(',', $value);
      foreach ($tags as $tag) {
        $tag = strtolower($tag);
        $needle = strtolower($needle);
        if($tag == $needle) return $employee;
      }
    }
  }
}