$(document).ready(function() {

    Laravel.initialize();

    Form.csrf();

    Form.observer();

    $('body').on('submit', 'form.ajax-form', function () {

        return Form.submit($(this));

    });

    Form.floatLabel($('.form-float-label input, .form-float-label textarea'));

    $('.form-float-label input, .form-float-label textarea').on('focus keyup blur', function(event){
		Form.floatLabel($(this), event.type);
    });

    $('.dashboard .collections').on('click', '.collection-drop', function() {
        $(this).siblings('.collection-actions').fadeToggle();
    })

    $('body').on('click', '.minimize', function() {
        $(this).siblings('.activities').slideToggle();
    });

    $('.bars').on('click', function() {
        $('.menu-list').slideToggle();
    });

    $('.menu-list li').on('click', function() {
        $(this).find('ul').slideToggle();
    });

});