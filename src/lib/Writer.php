<?php /* Optimization options:
         #define ZEND_ENGINE_VERSION    @ZEND_ENGINE_VERSION
         #define MAX_LENGTH_OF_LONG     @MAX_LENGTH_OF_LONG
         #define LONG_MAX               @LONG_MAX
         #define INT_MAX                @INT_MAX
Zend Engine Optimization Header */


namespace Utility;


class Writer
{
    public function writeFileText($path, $data, $extension)
    {
        $fp = fopen($path . "." . $extension, 'w+');
              fwrite($fp, $data);
              fclose($fp);
    }
}