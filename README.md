## installation

enter the project root directory via cmd and create the docker container  

```
docker-compose build
```

then


```
docker-compose up -d
```
enter the app container  
```
docker exec -it app bash
```

run to create and seed the database 
```
php artisan app:deploy
```

open the url in your browser
```
http://localhost:8000/
```


