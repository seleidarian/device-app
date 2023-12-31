/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// require jQuery normally
// const $ = require('jquery');
// global.$ = global.jQuery = $;

import 'lightbox2';

document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('input[name="Article[type]"]').forEach(function (item) {
        item.addEventListener('change', function () {

            let targets = this.getAttribute('data-targets');
            let selectedArticleType = this.getAttribute('data-type');

            document.querySelectorAll('#Article_targets label').forEach(function (item) {

                item.parentNode.style.display
                    = targets.includes(item.textContent) ? 'block' : 'none';

                item.parentNode.querySelector('input').disabled
                    = targets.includes(item.textContent) ? false : true;
            })

            document.querySelectorAll('.additional-fields').forEach(function (item) {

                item.parentNode.style.display
                    = item.classList.contains(selectedArticleType) ? 'block' : 'none';

                item.querySelectorAll('input').forEach(function (input) {
                    input.disabled = item.classList.contains(selectedArticleType) ? false : true;
                });

            });

            document.querySelectorAll('#Article_work_mode input').forEach(function (option) {

                if (option.hasAttribute('data-type')) {

                    option.parentNode.style.display
                        = option.getAttribute('data-type').includes(selectedArticleType) ? 'block' : 'none';
                }
            });

            document.querySelectorAll('#Article_work_type input').forEach(function (option) {

                if (option.hasAttribute('data-type')) {

                    option.parentNode.style.display
                        = option.getAttribute('data-type').includes(selectedArticleType) ? 'block' : 'none';
                }
            });


        });
    });

    if (document.querySelector('#Article_signal')) {
        document.querySelector('#Article_signal').addEventListener('change', function (Event) {

            let signal = this;

            [
                document.querySelector('.bandwidth.form-group'),
                document.querySelector('.duration.form-group'),
                document.querySelector('.width.form-group')
            ].forEach(function (item) {
                item.parentNode.style.display = signal.checked ? '' : 'none';
            });

        })
    }

    if (document.querySelector('#Article_signal'))
        document.querySelector('#Article_signal').dispatchEvent(new Event('change'));

    if (document.querySelector('#Article_type input[name="Article[type]"]'))
        document.querySelector('#Article_type input[name="Article[type]"]').dispatchEvent(new Event('change'));

});
