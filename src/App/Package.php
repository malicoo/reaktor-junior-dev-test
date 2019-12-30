<?php

namespace Reaktor\App;

use Exception;
use JsonSerializable;

class Package implements JsonSerializable
{
    /**
     * Class Data Var.
     * @var array
     */
    protected $data =  [];

    public function __construct(array $package)
    {
        $this->extractInfo($package);
    }

    /**
     * Get required Information from Array
     * @param  Array $package
     * @return void
     */
    protected function extractInfo($package)
    {
        $this->data['name'] = $package['package'];
        
        if (isset($package['description'])) {
            $this->data['description'] = $package['description'];
        }

        if (isset($package['depends'])) {
            $this->extractDependencies($package['depends']);
        }

        if (isset($package['breaks'])) {
            $this->extractReverseDependencies($package['breaks']);
        }
        if (isset($package['breaks'])) {
            $this->extractReverseDependencies($package['breaks']);
        }

        if (isset($package['maintainer'])) {
            $this->extractMaintainer($package['maintainer']);
        }
    }

    /**
     * Get Maintainer Info
     * @param  str $str_maintainer
     * @return [void]
     */
    protected function extractMaintainer($str_maintainer)
    {
        // str_maintainer format 'Name <Email>
        
        $pos  = strpos($str_maintainer, '<');

        if ($pos !== false) {
            $this->data['maintainer']['name'] = trim(substr($str_maintainer, 0, $pos));

            $this->data['maintainer']['email']  = substr($str_maintainer, $pos+1, -1);
        } else {
            $this->data['maintainer']['name'];
        }
    }
    /**
     * Get Packages from a Package String
     * @param  String $str_packages
     * @return Array
     */
    protected function getPackages($str_packages)
    {
        // Format str_packages: package (> version), ...
        //
        $array_packages = explode(',', $str_packages);
        
        $packages = [];

        foreach ($array_packages as $package) {
            $pos  = strpos($package, '(');

            if ($pos !== false) {
                $packages[] = trim(substr($package, 0, $pos));
            } else {
                $packages[] =  trim($package);
            }
        }
        return $packages;
    }
    
    /**
     * Get Reverse Dependencies
     * @param  string $str_depends
     * @return void
     */
    protected function extractReverseDependencies($str_depends)
    {
        $this->data['reverse_depends'] = $this->getPackages($str_depends);
    }

    /**
     * Extract Dependecies
     * @param  String $str_depends
     * @return String
     */
    protected function extractDependencies($str_depends)
    {
        $this->data['depends'] = $this->getPackages($str_depends);
    }

    /**
     * To string format of Class
     * @return array
     */
    public function __toString()
    {
        return $this->data;
    }

    public function jsonSerialize()
    {
        return $this->data;
    }


    public function __get($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key ];
        } else {
            throw new Exception("$key not Found");
        }
    }
}
