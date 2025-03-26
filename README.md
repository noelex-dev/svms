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
php yii migrate/fresh --migrationPath=@yii/rbac/migrations --interactive=0; php yii migrate --interactive=0
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



