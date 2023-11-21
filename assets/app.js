/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

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

    document.querySelector('#Article_signal').addEventListener('click', function (Event) {

        let signal = this;

        [
            document.querySelector('.bandwidth.form-group'),
            document.querySelector('.duration.form-group'),
            document.querySelector('.width.form-group')
        ].forEach(function (item) {
            item.parentNode.style.display = signal.checked ? '' : 'none';
        });

    })

    document.querySelector('#Article_type input[name="Article[type]"]:checked').dispatchEvent(new Event('change'));
    document.querySelector('#Article_signal').dispatchEvent(new Event('click'));

});
