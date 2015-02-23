var Form = (function(){

    var _public = {};
    var _private = {};

    _private.ajaxSettings = {
        beforeSubmit: function (arr, $form, options) {

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
 
            if(_private.callback.on == 'beforeSubmit') {
                _private.callback.callback({
                    arr: arr,
                    $form: $form,
                    options: options,
                });
            }

        },
        success: function (result, status, xhr, $form) {

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

            $form.find('.form-status')
                 .removeClass('form-sending')
                 .addClass('form-error');

            if (result.responseJSON.errors) {
                $.each(result.responseJSON.errors, function (key, value) {
                    if(key.search('.') !== -1) {
                        var key = key.split(".");
                        $.each(key, function(i, value) {
                            if(i == 0) {
                                key = value;
                            } else {
                                key+= "[" + value + "]";
                            }
                        });
                    }

                    var element = $form.find("input[name='" + key + "'], textarea[name='" + key + "'], select[name='" + key + "']");
                    
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

        _private.callback = callback || 'undefined';
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

    _public.slug = function(str, $to, separator) {

        separator  = separator  || '-';

        $to.val(getSlug(str, separator));

    }

    _public.floatLabel = function($inputs, event) {
        event = event || '';

        $inputs.each(function() {
            if($(this).val() !== '' || event == 'focus') {
                if($(this).attr('data-placeholder') == undefined) {
                    $(this).attr('data-placeholder', $(this).attr('placeholder'));
                }
                $(this).attr('placeholder', '');
                $(this).siblings('label').slideDown();
            } else {
                $(this).attr('placeholder', $(this).attr('data-placeholder'));
                $(this).siblings('label').slideUp();
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