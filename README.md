<h3>Version</h3>

framework version `4.3` and aso I was using php version `7.4.0` when writing

<h3>front page</h2>

The previous page is read from `Application/Controllers/Home.php ` which is backed  and `/Application/Views/index.php` which is the frontend 

All page names are managing in `Application/Controllers/Routes.php` and then for example I created a page called 'a/b/c'.  

```php
Router::set("BOTH","a/b/c","Home::Index");
```
On the front we see three items <br>
1. BOTH -> Here the status of the page is written such as GET, POST and BOTH<br>
	* where it is GET:- you can see the data of this page for all requests, except for POST <br>
    * when it is POST:- you can see this page only POST request<br>
    * when it is BOTH:- you can see only the requests<br>
2. a/b/c -> is name of the page, the  The client will not write the .php at the end because it is unnecessary <br><br>
3. Home::Index -> where home is run from the class in the `Application/Controllers/Home.php` folder and also Index is a function in the Home 
<br><br>
If I take it to the Home located at `Application/Controllers/Home.php`
We see it like this

```php
class Home extends Controller {

    function Index() {           
        $content = [
        	"title" => "Welcome To Mahdiware",
        ];
        $this->view("index", $content);
    }
}
```
Where I already told you about Routes.php Home::Index to create an Index, the name is not important, it must be the same name as Routes.php
then I created an array and called it $content and it was written like this 
```php
$this->view("index", $content);
```
where index is the file located at `Application/Views/index.php`


when you go you see 
```php
<?= $this->extend('layouts/layout') ?>
```
This one does mean All this page contains put the page "layouts/layout"
<br>
while the "layouts/layout" page must be in `Application/Views/`
<br><br>
 and see this code in `/Application/Views/index.php`
```php
<?= $this->section('content') ?>
```
and this code

```php
<?= $this->endSection() ?>
```

These two codes, section and endSection, are loaded on the page from the `Application/Views/layouts/layout.php` side of renderSection() which has already specified the section.
 For example I wrote a section named "content". 
```php
<?= $this->section('content') ?>
```
Then we write the next html code and then we close the section 
```php
<?= $this->endSection() ?>
```
After all the code we have written is saved for us, the next thing to do is go to `Application/Views/layouts/layout.php'` and type renderSection in it, it will be run from the two sections that we have opened and then We closed it and it will be loaded next here we have to give the same name to the previous one where we gave it to 'content' and we are going to give it to 'content' this is how we do it 

```php
<?= $this->renderSection('content') ?>
```