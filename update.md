<h3> UPDATE: </h3>
1. friends we have seen a bug in the guide and ambina now we have solved it, you know our old version is not security that bug for example  "https://example.com/?load=../Application/.env" was able to the person client to read your .env but now it is secure 

2. We have simplified the way we used to write the Router which was 
```php
$this->set("BOTH","/","Home::Index");
```
and now we have made it like this
```php
Router::set("BOTH","/","Home::Index");
```
and simplified the backend classes in the `Controllers/*` side and it must be started from

```php
public function __construct($activity) {
    parent::__construct($activity);
}
```
but is now deprecated and unnecessary