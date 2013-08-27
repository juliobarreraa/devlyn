<?php

return array(
    'sourcePath' => dirname(__FILE__) . '/../',
    'messagePath' => dirname(__FILE__) . '/',
    'translator' => 'Yii::t',
    'languages' => array('en-US', 'es-MX'),
    'fileTypes' => array('php'),
    'overwrite' => true,
    'exclude' => array(
        '.git',
        '.svn',
        '../../framework',
    ),
);

?>
