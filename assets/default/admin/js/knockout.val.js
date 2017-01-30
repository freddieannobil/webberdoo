/**
 * Created by freddie on 06/02/2016.
 */

jQuery(document).ready(function($) {

    function ViewModel(){
        var self = this;


        //Advertiser
        self.import_feed = ko.observable('');
        self.import_feed.valiationMessage = ko.observable('');
        self.import_feed.hasError = ko.observable(true);
        self.import_feed.validationClass = ko.observable('');

        self.import_feed.subscribe(function(){
            var comparison = self.import_feed().length > 0;
            var message = comparison ? 'Good!' : 'Please make a selection';
            var cssClass = comparison ? 'success' : 'warning';

            self.import_feed.valiationMessage(message);
            self.import_feed.hasError(!comparison);
            self.import_feed.validationClass(cssClass);
        });




        //check if input fiels are Valid
        self.isValid = ko.computed(function(){

            var isValid = (
                !self.import_feed.hasError()
            );

            return isValid;

        });





    };

    ko.applyBindings(new ViewModel());

    //load spinnjer when sumit button is clicked
   /* $('#wdoo-form').submit(function(){
        $('#wdoo_loader').show();
    });*/

});


