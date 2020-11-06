<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template Starter.</h1>
    <br>
</p>

Steps to install project:
=========================

* Clone repository from github
* Run in console from root directory ```composer update```
* Run in console from root directory ```php init```
* Create db and add config to connect to in common/config/main-local.php
* Run in console from root directory ```yii migrate``` (create tables `user` and `migration`)
* Run in console from root directory ```yii migrate --migrationPath=@yii/rbac/migrations/``` (create four rbac tables)
* Run in console from root directory ```run yii rbac/init``` (see console/controllers/RbacController.php)

What included in kit.
-------------------------

1. Create options to use pretty Url`s.
2. Create rbac controller and base roles. Use rbac db manager in this case.
3. Add links from frontend to backend and conversely.
4. Create theming in view options.
5. Add in frontend/config/main options to include favicon in view.
