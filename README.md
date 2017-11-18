wrapper_tags extension for Contao Open Source CMS 
===============================

Provides 2 content elements "Opening tags" and "Closing tags" used to wrap other content elements super easily. It **validates correctness** of the built html structure. 

* Find in [Contao extension catalog](https://contao.org/en/extension-list/view/wrapper_tags.10000019.en.html "Contao extension catalog")

## System requirements
- Contao 3.2.x - 3.5.x
- PHP 5.6.x - 7.x

## How to use it

### Use content element "Opening tags" to open any number of html tags you need.
 
![Opening tags](docs/backend-opening-tags.png?raw=true "Opening tags")

### Then close all of these opened html tags using "Closing tags" content element.

![Closing tags](docs/backend-closing-tags.png?raw=true "Closing tags")

### This is an example of a built, correct structure.

![Structure ok](docs/backend-ok.png?raw=true "Structure ok")

Html structure result looks like:

```html
<article id="id-1" class="class-1">
  <div class="class-2">
    <span id="id-3">
      <h1 class="ce_headline" style="margin-bottom:100px;">
        Hello, this is first element wrapped by html tags
      </h1>
      <div class="red">
        <h1 class="ce_headline" style="margin-bottom:100px;">
          This is second element wrapped by html tags
        </h1>
      </div>
    </span>
  </div>
</article>
```
 
### This is an example of a structure with error.

![Structure with error](docs/backend-error.png?raw=true "Structure with error")

## Copyright
This project has been created and is maintained by [Maciej](http://contao-developer.pl).
