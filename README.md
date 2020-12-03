# rating-bundle
1. installation
```
composer require kematjaya/rating-bundle
```
2. add to config/bundles.php
```
...
Kematjaya\RatingBundle\RatingBundle::class => ['all' => true]
...
```
3. using in template
```
rating(5)
// or
rating(8, 10)
```
4. add font-awesome css
```
<link rel="stylesheet" type="text/css" href="{{ asset('bundles/rating/fontawesome/css/fontawesome.min.css') }}"/>
```
