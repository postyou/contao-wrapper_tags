wrapper_tags 
===============================
An extension for Contao Open Source CMS
 
Provides wrapper content elements that allow advance wrapping functionalities, colorizing and **validation** of the resulting html structure. 

* Find in [Contao extension catalog](https://contao.org/en/extension-list/view/wrapper_tags.10010009.en.html "Contao extension catalog")

## System requirements
- Contao 3.2.x - 3.5.x
- PHP 5.6.x - 7.x

## Usage

- open many divs (or other html tags) in one wrapper element, all just by clicking
- close those divs using one or many wrapper elements
- colorize resulting structure
- get precise validation info of resulting structure 

## Example screenshots

### Colorizing
![Showcase](docs/showcase.jpg?raw=true "Show case")

### 3 elements with the same indent

![Same indent](docs/same-indent.jpg?raw=true "Same indent")

### Settings

![Settings](docs/tl_settings.jpg?raw=true "Settings")

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
