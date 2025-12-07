<?php

// remove symlink
if(file_exists('public/theme'))
{
    exec('rm -rf ' . '"'.getcwd() . '/public/theme"');
    mkdir('public/theme');
}

if(!file_exists('public/theme'))
{
    mkdir('public/theme');
}

// publishing module assets
if(app('theme'))
{
    $dir = 'themes/'.app('theme').'/assets';

    $res = '"'.getcwd() . '/'.$dir.'"';
    $dst = '"'.getcwd() . '/public/theme"';
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
    {
        $dst = '"'.getcwd() . '/public/theme/assets"';
        $cmd = 'mklink /J '.$dst.' '.$res;
    }
    else
    {
        $cmd = 'ln -s '.$res.' '.$dst;
    }
    exec($cmd);
    echo "Exec ".$cmd."\n";
}
die();