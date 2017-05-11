(function($, window) {


    $.plugin('pmPassportForm', {

        defaults: {
            'url': null,
            'hideSelector': '.perso-check',
            'showSelector': '.perso-check-result'
        },

        /**
         * Default plugin initialisation function.
         * Registers an event listener on the change event.
         * When it's triggered, the parent form will be submitted.
         *
         * @public
         * @method init
         */
        init: function () {
            var me = this,
                opts = me.opts;

            // Applies HTML data attributes to the current options
            me.applyDataAttributes();

            me._on( me.$el.find('button.submit'), 'click', $.proxy(me.check, me));

        },

        check: function (event) {
            event.preventDefault();

            var me = this,
                opts = me.opts,
                $el = me.$el;

            $.loadingIndicator.open();


            $.ajax({
                'data': {
                    blockA: $el.find('[name="persoCheck[blockA]"]').val(),
                    blockB: $el.find('[name="persoCheck[blockB]"]').val(),
                    blockC: $el.find('[name="persoCheck[blockC]"]').val(),
                    blockD: $el.find('[name="persoCheck[blockD]"]').val()
                },
                'dataType': 'json',
                'type': 'POST',
                'url': opts.url,
                'success': function (result) {
                    $.loadingIndicator.close(function () {
                        if(result.success) {
                            $(opts.hideSelector).hide();
                            $(opts.showSelector).show();
                            $('button[type="submit"]').removeAttr('disabled');
                        } else {
                            $el.find('[name^="persoCheck"]').addClass('has--error');
                        }
                    });
                }
            });
        }
    });


    window.StateManager


        .addPlugin('*[data-documentcheck]', 'pmPassportForm');

})(jQuery, window);
