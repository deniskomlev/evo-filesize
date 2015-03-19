<?php
/**
 * FileSize snippet for MODX Evolution.
 *
 * Example usage: [[FileSize? &path=`assets/files/myfile.zip`]]
 *
 * The file path must be relative to webroot.
 */

$units = array(
    'gb' => array('size' => 1073741824, 'label' => 'GB'),
    'mb' => array('size' => 1048576,    'label' => 'MB'),
    'kb' => array('size' => 1024,       'label' => 'KB'),
    'b'  => array('size' => 0,          'label' => 'bytes')
);

$path = MODX_BASE_PATH . $path;
$size = is_file($path) ? filesize($path) : 0;
$unit = (isset($unit) && isset($units[$unit])) ? $unit : false;

if ($size > 0) {
    if ($unit === false) {
        // If the unit is not specified, detect it automatically.
        foreach ($units as $key => $properties) {
            if ($size >= $properties['size']) {
                $unit = $key;
                break;
            }
        }
    }
    if ($unit != 'b') {
        $size = $size / $units[$unit]['size'];
    }
}
else {
    if ($unit === false) {
        $unit = 'b';
    }
}

return round($size, 2) . ' ' . $units[$unit]['label'];
