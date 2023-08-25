wrapper_tags 
===============================
An extension for [Contao Open Source CMS](https://contao.org/en/)
 
Provides content elements for building any html structure in an article without a need for using templates.

## System requirements
- Contao 3.2.x - 3.5.x, 4.4+
- PHP 5.6 - 7.x 

Not tested with Contao 4.0 - 4.3 but probably works with them.
Not tested with PHP &lt; 5.6 but probably works with few earlier versions.

## Dependencies

- [MultiColumnWizard](https://github.com/menatwork/MultiColumnWizard "MultiColumnWizard")

## Installation

Using composer (for 3.5 and 4.4+):

```bash
  $ composer require postyou/contao-wrapper_tags
```

## Usage

All just by clicking.

Use `Opening tags` element to add multiple tags at once.
----------

Every tag can have any desire attribute. The insert tags are allowed to form the attributes' names & values.

![Opening tags](docs/wrapper_tags-opening_multi.jpg "Opening tags")

In the article list view:

![Opening tags list view](docs/wrapper_tags-opening-list.jpg "Opening tags list view")

The code result in the front end:

```html
<div class="big-font" id="container-1" data-person="chef-12" page-5="profile">
<span class="red">
```

Use `Closing tags` content element to close HTML tags.
----------------------------------------------------------

![Closing tags](docs/wrapper_tags-closing.jpg "Closing tags")

In the article list view:

![Closing tags list view](docs/wrapper_tags-closing-list.jpg "Closing tags list view")

The code result in the front end:

```html
</div>
</span>
```

Use `Complete tags` content element to add complete HTML tags.
------------------------------------------------------------------

![Complete tags](docs/wrapper_tags-complete.jpg "Complete tags")

In the article list view:

![Complete tags list view](docs/wrapper_tags-complete-list.jpg "Complete tags list view")

The code result in the front end:

```html
<div id="ajax-data"></div>
<img src="files/website/1.jpg">
```

You will be notified of any possible error in the structure you have built.
-------------------------------------------------------------------------------

![Show case with error](docs/error.jpg "Show case with error")

The elements behave as the wrapper elements.
------------------------------------------------

They are indented and specially colored at deeper levels.

![Show case](docs/show-case.jpg "Show case")

The code result in the front end:

```html
<div id="container-1" data-person="chef-12" page-5="profile" class="big-font">
    <div class="red">
        <h1 class="ce_headline">Hello</h1>
        <div id="ajax-data"></div>
        <img src="files/website/1.jpg">
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

The indents and colors are preserved even in the paging mode.
----------------------------------------------------------------
![Paging](docs/paging.jpg "Paging")

Settings
------------
![Settings](docs/tl_settings.jpg "Settings")

## Copyright
Created by [Mike](http://contao-developer.pl). Maintained and further development by [Postyou](https://www.postyou.de)
