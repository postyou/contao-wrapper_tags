wrapper_tags 
===============================
An extension for [Contao Open Source CMS](https://contao.org/en/)
 
Provides content elements for building any html structure without a need for using the templates.

## System requirements
- Contao 3.2.x - 3.5.x, 4.4+
- PHP 5.6.2 - 7.x

Not tested with PHP &lt; 5.6.2 but probably works with few earlier versions.


## Installation

```bash
  $ composer require zmyslny/contao-wrapper_tags
```
Using [Contao extension catalog](https://contao.org/en/extension-list/view/wrapper_tags.10020019.en.html "Contao extension catalog")


## Building HTML structure

All just by clicking.

### Use `Opening tags` content element to open any HTML tag with any desire attribute.

![Opening tags](docs/wrapper_tags-opening.png "Opening tags")

### The `Opening tags` element allows to add multiple tags at once.

![Opening tags](docs/wrapper_tags-opening_multi.png "Opening tags")

### Use `Closing tags` content element to close HTML tags.

![Closing tags](docs/wrapper_tags-closing.png "Closing tags")

### You will be notified of any possible error in the structure you have built.

![Show case with error](docs/error.png "Show case with error")

### The elements behave as the smart wrapping Contao elements.

![Show case with Bootstrap](docs/show-case.png "Show case with Bootstrap")

### The indents and colors are preserved even in paging.
![Paging](docs/paging.png "Paging")

### Settings
![Settings](docs/tl_settings.png "Settings")

## Copyright
Created and maintained by [Maciej](http://contao-developer.pl).
