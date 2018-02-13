wrapper_tags 
===============================
An extension for [Contao Open Source CMS](https://contao.org/en/)
 
Provides content elements for building any html structure in an article without a need for using templates.

## System requirements
- Contao 3.2.x - 3.5.x, 4.4+
- PHP 5.6 - 7.x 

Not tested with PHP &lt; 5.6 but probably works with few earlier versions.


## Installation

```bash
  $ composer require zmyslny/contao-wrapper_tags
```
Using [Contao extension catalog](https://contao.org/en/extension-list/view/wrapper_tags.20000009.en.html "Contao extension catalog")


## Building HTML structure

All just by clicking.

### Use `Opening tags` content element to open any HTML tag with any desire attribute.

![Opening tags](docs/wrapper_tags-opening.png "Opening tags")

It results as the following code:

```html
<div class="big-font" id="container-1" data-person="chef-12" page-5="profile">
```

### The `Opening tags` element allows to add multiple tags at once.

![Opening tags](docs/wrapper_tags-opening_multi.png "Opening tags")

As a code:

```html
<div class="big-font" id="container-1" data-person="chef-12" page-5="profile">
<span class="red">
```

### Use `Closing tags` content element to close HTML tags.

![Closing tags](docs/wrapper_tags-closing.png "Closing tags")

As a code:

```html
</div>
</span>
```

### You will be notified of any possible error in the structure you have built.

![Show case with error](docs/error.png "Show case with error")

### The elements behave as the smart wrapping Contao elements.

![Show case with Bootstrap](docs/show-case.png "Show case with Bootstrap")

As a code:

```html
<div id="container-1" data-person="chef-12" page-5="profile" class="big-font">
    <div class="red">
        <h1 class="ce_headline">Hello</h1>
        <article>
            <div>
                <span data-date="13/02/2018">
                    <h1 class="ce_headline">Very nice plugin</h1>
                </span>
            </div>
        </article>
    </div>
</div>
```

### The indents and colors are preserved even in paging.
![Paging](docs/paging.png "Paging")

### Settings
![Settings](docs/tl_settings.png "Settings")

## Copyright
Created and maintained by [Mike](http://contao-developer.pl).
