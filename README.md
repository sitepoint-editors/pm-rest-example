## Silex-Guzzle RemoteProxy
### Simplify request to different Api`s with interfaced proxies

#Prerequisits
* composer installed
* php >=5.4 installed

#Installation
* checkout project
* ```composer install```

#Usage

##Serverpart
```php -S localhost:9001 -t```

###Urls
* localhost:9001/books
* localhost:9001/books/1
* localhost:9001/books/1/author

##Clientpart
```php -S localhost:9000 -t```

###Urls 
localhost:9000/test-proxy

