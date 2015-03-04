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

    Form.wysiwyg($('.field-wysiwyg'));

    Form.date($('.field-date'));

    Form.time($('.field-time'));

    Form.phone($('.field-phone'));

    Form.currency($('.field-currency'));

    $('body').on('click', '.minimize', function() {
        $(this).fadeOut(function(){
            if($(this).text() == '-') {
                $(this).addClass('active').text('+');
            } else {
                $(this).removeClass('active').text('-');
            }
            $(this).fadeIn();
        })
        $(this).parent().siblings().slideToggle();
    });

    $('body').on('click', '.analytics-charts .maximize', function() {
        $(this).fadeOut(function(){
            if($(this).text() == '+') {
                $(this).addClass('active').text('-');
            } else {
                $(this).removeClass('active').text('+');
            }
            $(this).fadeIn();
        });

        $('.analytics-page-views').slideToggle();
    });

    $('.bars').on('click', function() {
        $('.menu-list').slideToggle();
    });

    $('.menu-list li').on('click', function() {
        if($(window).width() <= 768) {
            $(this).find('ul').slideToggle();
        }
    });

});