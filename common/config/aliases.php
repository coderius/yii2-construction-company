<?php
//@app: Your application root directory (either frontend or backend or console depending on where you access it from)
//@vendor: Your vendor directory on your root app install directory
//@runtime: Your application files runtime/cache storage folder
//@web: Your application base url path
//@webroot: Your application web root
//@tests: Your console tests directory
//@common: Alias for your common root folder on your root app install directory
//@frontend: Alias for your frontend root folder on your root app install directory
//@backend: Alias for your backend root folder on your root app install directory
//@console: Alias for your console root folder on your root app install directory

return [
    '@bower' => '@vendor/bower-asset',
    '@npm'   => '@vendor/npm-asset',

    '@web-url-themes' => $baseUrl.'/themes', //для веб
    '@web-path-themes' => '@frontend/web/themes', //для файловой системы

    //Themes sourses
    '@frontend-webroot-themes' => '@frontend/web/themes',
    '@frontend-web-themes' => $baseUrl . '/themes',

    '@backend-webroot-adminlte' => '@backend/web/AdminLTE-master',
    '@backend-web-adminlte' => $baseUrl . '/backend/web/AdminLTE-master',
];    