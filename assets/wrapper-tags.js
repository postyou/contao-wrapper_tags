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
                var on2, on4;

                on2 = el.get('class').split('clear-indent');

                // 'indent index_x' precede 'clear-indent' class
                on4 = on2[0].split('indent');

                el.set('class', on4[0] + ' clear-indent ' + on2[1]);
            });
        },
    }

    window.addEvent('domready', function () {
        wrapperTags.init();
    });

})();
