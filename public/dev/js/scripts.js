$(document).ready(function() {

    Laravel.initialize();

    Form.csrf();

    Form.observer();

    $('body').on('submit', 'form.ajax-form', function () {

        return Form.submit($(this));

    });

});