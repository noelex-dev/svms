```bash
php init
```

-select 'developer' 
-yes

```bash
composer install
```

create new DATABASE naming 'db_svms'
```bash
php yii migrate --migrationPath=@yii/rbac/migrations
php yii migrate
```

cd {project_directory}/frontend/web

```bash
php -S localhost:8080
```

or
cd {project_directory}

```bash
php yii serve --docroot=frontend/web --port=8080
```



