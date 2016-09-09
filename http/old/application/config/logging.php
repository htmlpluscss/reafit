<?php

// configuration for the logging library

$config = array(
    'feedback' => array(
        'level' => 'INFO',
        'type' => 'file',
        'format' => "--- {date} ---\n{message}",
        'file_path' => ''
    ),
    'registration' => array(
        'level' => 'INFO',
        'type' => 'file',
        'format' => "--- {date} ---\n{message}",
        'file_path' => ''
    ),
    'recovery' => array(
        'level' => 'INFO',
        'type' => 'file',
        'format' => "--- {date} ---\n{message}",
        'file_path' => ''
    )
);