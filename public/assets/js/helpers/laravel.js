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