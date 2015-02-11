var Laravel = {
    initialize: function() {
        this.methodLinks = $('a[data-method]');
 
        this.registerEvents();
    },
 
    registerEvents: function() {
        this.methodLinks.on('click', this.handleMethod);
    },
 
    handleMethod: function(e) {
        var link = $(this);
        var httpMethod = link.data('method').toUpperCase();
        var form;
 
        if ( $.inArray(httpMethod, ['PUT', 'DELETE']) === - 1 ) {
            return;
        }
 
        if ( link.data('confirm') ) {
            if ( ! Laravel.verifyConfirm(link) ) {
                return false;
            }
        }
 
        form = Laravel.createForm(link);
        form.submit();
 
        e.preventDefault();
    },
 
    verifyConfirm: function(link) {
        return confirm(link.data('confirm'));
    },
 
    createForm: function(link) {
        var form = $('<form>', {
            'method': 'POST',
            'action': link.attr('href')
        });

        var token = $('<input>', {
            'type': 'hidden',
            'name': '_token',
            'value': $('meta[name="_token"]').attr('content')
        });

        var hiddenInput = $('<input>', {
            'name': '_method',
            'type': 'hidden',
            'value': link.data('method')
        });

        return form.append(token, hiddenInput).appendTo('body');
    }
};


var Form = (function(){

    var _public = {};
    var _private = {};

    _private.ajaxSettings = {
        beforeSubmit: function (arr, $form, options) {
            if(_private.callback.default !== false) {
                $form.find("input, select, textarea")
                     .removeClass('form-error');

                $form.find("input[type='submit']").prop('disabled', true);

                $form.find('.form-status')
                     .show()
                     .removeClass('form-error')
                     .removeClass('form-success')
                     .addClass('form-sending')
                     .html('');

                $form.find('.form-message')
                     .html('');
            }
 
            if(_private.callback.on == 'beforeSubmit') {
                _private.callback.callback({
                    arr: arr,
                    $form: $form,
                    options: options,
                });
            }
        },
        success: function (result, status, xhr, $form) {
            if(_private.callback.default !== false) {
                $form.find('.form-status')
                     .removeClass('form-sending')
                     .addClass('form-success');

                setTimeout(function() {
                    $('.form-success').slideUp('slow', function() {
                        $(this).html('').removeClass('form-success');
                    });
                }, 5000);

                if($form.hasClass('form-clear')){
                    $form.trigger('reset');
                }

                $form.find("input[type='submit']").prop('disabled', false);
            }

            if(_private.callback.on == 'success') {
                _private.callback.callback({
                    result: result, 
                    status: status, 
                    xhr: xhr, 
                    $form: $form,
                });
            }
        },
        error: function (result, status, xhr, $form) {
            if(_private.callback.default !== false) {
                $form.find('.form-status')
                     .removeClass('form-sending')
                     .addClass('form-error');

                if (result.responseJSON.errors) {
                    $.each(result.responseJSON.errors, function (key, value) {
                        var element = $form.find("input[name='" + key + "'], textarea[name='" + key + "'], select[name='" + key + "']");
                        console.log(key);
                        element.addClass('form-error')
                               .siblings('.form-message')
                               .addClass('error')
                               .text(value);
                    });
                } 

                if (result.responseJSON.errorMessage) {
                    $form.find('.form-status')
                         .removeClass('form-error')
                         .text(result.responseJSON.errorMessage);
                }

                $form.find("input[type='submit']").prop('disabled', false);
            }

            if(_private.callback.on == 'error') {
                _private.callback.callback({
                    result: result, 
                    status: status, 
                    xhr: xhr, 
                    $form: $form,
                });
            }
        }
    }

    _public.submit = function(form, callback){

        _private.callback = callback;
        form.ajaxSubmit(_private.ajaxSettings);

        return false;

    }

    _public.observer = function() {
        $(document).ajaxComplete(function(event, xhr) {
            if(xhr.responseText === 'undefined') {
                return false;
            }

            var response = JSON.parse(xhr.responseText);

            if(response.redirect && response.timeout) {
                setTimeout(function() {
                    window.location = response.redirect;
                }, response.timeout);
            } else if(response.redirect) {
                window.location = response.redirect;
            }

        });
    }

    _public.csrf = function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content'),
            },
            cache: true,
        });

    }

    return _public;

}());


$(document).ready(function() {

    Laravel.initialize();

    Form.csrf();

    Form.observer();

    $('body').on('submit', 'form.ajax-form', function () {

        return Form.submit($(this), {
            callback: function(args){

            },
            on: 'success',
        });

    });

});