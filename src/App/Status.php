<?php

namespace Reaktor\App;

 class Status
 {
     /**
      * Pat to Status File
      * @var string
      */
     protected $path = '/var/lib/dpkg/status';

     /**
      * Class Data
      * @var array
      */
     protected $data = [ 'packages' => [] ];

     public function __construct()
     {
         $this->fetchPackages();
         $this->sortPackages();
         // $this->savePackages();
     }

     /**
      * Fetch Packages
      * @return void
      */
     protected function fetchPackages()
     {
         $raw_content = trim(file_get_contents($this->path), "\n\n");

         $raw_packages = explode("\n\n", $raw_content);

         foreach ($raw_packages as $raw_package) {
             $tmp_raw_package = explode("\n", $raw_package);
   
             $package = [];

             $property = 'package';

             foreach ($tmp_raw_package as $line) {
                 $pos  = strpos($line, ':');

                 if (! ctype_space($line[0]) && $pos !== false) {
                     $property = str_replace('-', '_', strtolower(substr($line, 0, $pos)));

                     $value = substr($line, $pos+2);

                     $package[$property] = $value;
                 } else {
                     $package[$property] .= "\n" . $line;
                 }
             }

             $this->data['packages'][] = (new Package($package));
         }
     }

     /**
      * Sort packages by name
      * @return void
      */
     protected function sortPackages()
     {
         usort($this->data['packages'], function ($a, $b) {
             return strcmp($a->name, $b->name);
         });
     }

     /**
      * Cache Packges in Json Files
      * @return void
      */
     public function savePackages()
     {
         $firstchar = 'a';
         $lastchar = 'z';
         $tmp = [];

         foreach ($this->data['packages'] as $key => $package) {
             if (($firstchar !== $package->name['0']) || ($lastchar === $package->name['0'] && $key === array_key_last($this->data['packages']))) {
                 file_put_contents("../.cache/$firstchar.json", json_encode($tmp));
                 $firstchar = $package->name['0'];
                 $tmp = [];
             } else {
                 $tmp[] = $package;
             }
         }
         
         //config file
         $config = ['number' => sizeof($this->data['packages']), 'time' => date("Y-m-d H:i:s") ];
         file_put_contents("../.cache/config.json", json_encode($config));
     }

     public function __get($key)
     {
         if (isset($this->data[$key])) {
             return $this->data[$key];
         } else {
             throw new Exception("$key not Found");
         }
     }
 }
