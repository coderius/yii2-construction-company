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


    //Frontend Web
    '@frontend-web' => $baseUrl,

    '@web-url-themes' => $baseUrl.'/themes', //для веб
    '@web-path-themes' => '@frontend/web/themes', //для файловой системы

    //Themes sourses
    '@frontend-webroot-themes' => '@frontend/web/themes',
    '@frontend-web-themes' => $baseUrl . '/themes',

    '@backend-webroot-adminlte' => '@backend/web/AdminLTE-master',
    '@backend-web-adminlte' => $baseUrl . '/backend/web/AdminLTE-master',

    /////////////////////////////////////////////////////////////////////
    //                          Blog
    /////////////////////////////////////////////////////////////////////
    //Posts
    '@blogPostTextPicsPath' => '@frontend/web/blog-post-pics/text-pics',
    '@blogPostTextPicsWeb' => $baseUrl . '/blog-post-pics/text-pics',
    
    '@blogPostHeaderPicsPath' => '@frontend/web/blog-post-pics/header-pics',
    '@blogPostHeaderPicsWeb' => $baseUrl . '/blog-post-pics/header-pics',

    //Categories
    '@blogCatTextPicsPath' => '@frontend/web/blog-category-pics/text-pics',
    '@blogCatTextPicsWeb' => $baseUrl . '/blog-category-pics/text-pics',

    /////////////////////////////////////////////////////////////////////
    //                          Pages
    /////////////////////////////////////////////////////////////////////
    //Posts
    '@pageTextPicsPath' => '@frontend/web/page-pics/text-pics',
    '@pageTextPicsWeb' => $baseUrl . '/page-pics/text-pics',

    '@pageHeaderPicsPath' => '@frontend/web/page-pics/header-pics',
    '@pageHeaderPicsWeb' => $baseUrl . '/page-pics/header-pics',

    /////////////////////////////////////////////////////////////////////
    //                          User Profile
    /////////////////////////////////////////////////////////////////////
    //Posts
    '@userProfilePicsPath' => '@frontend/web/user-profile',
    '@userProfilePicsWeb' => $baseUrl . '/user-profile',

    /////////////////////////////////////////////////////////////////////
    //                          Portfoleo
    /////////////////////////////////////////////////////////////////////
    '@portfolioPicsPath' => '@frontend/web/portfolio',
    '@portfolioPicsWeb' => $baseUrl . '/portfolio',

];