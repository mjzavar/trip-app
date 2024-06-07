## installation

Enter the project root directory via cmd and create the docker container by running these commands

```
docker-compose build
```

and then

```
docker-compose up -d
```

To migrate and seed the database , enter the app container  
```
docker exec -it trip-app bash
```

And run this command

```
php artisan db:build
```

open the app url in your browser and we are done 
```
http://localhost:8000
```

## directories 

Sourcecode directories for the backend


controllers : 

```
app/Http/Controllers
```

models :
```
app/Models
```

services/actions :
```
app/Services
```


routes :
```
routes/app.php
```


You can find the forntend app files in here 

```
/resources/js
```


