/*!
 * Copyright (C) 2017 Zmyslni
 *
 * @author  Ostrowski Maciej <http://contao-developer.pl>
 * @author  Ostrowski Maciej <maciek@zmyslni.pl>
 * @license LGPL-3.0+
 */

(function () {
    var wrapperTags = {

        init: function () {
            $$('.tl_content.clear-indent').each(function (el) {
                var splitOn2 = el.get('class').split('clear-indent'),
                    // 'indent index_x' precede 'clear-indent' class
                    splitOn4 = splitOn2[0].split('indent');

                // concatenate 1, 2 and 4th part, remove 3rd
                el.set('class', splitOn4[0] + ' clear-indent ' + splitOn2[1]);
            });
        },
    }

    window.addEvent('domready', function () {
        wrapperTags.init();
    });

})();
