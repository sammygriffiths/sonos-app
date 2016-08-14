// The only global variable
var GriffSonos = {};

GriffSonos.functions = {};

GriffSonos.run = function(){
    $(document).ready(function(){
        GriffSonos.functions();
    });
};

GriffSonos.Queue = {
    init: function(){
        this.bindUIActions();
    },

    clearQueue: function(url){
        $.get("/queue/clear/", function(data) {
            if (data.success) {
                alert('Cleared Queue');
            }
        });
    },

    resetMostRecent: function(url){
        $.get("/queue/resetmostrecent/", function(data) {
            if (data.success) {
                alert('Reset record of most recently added track');
            }
        });
    },

    addToQueue: function(type, id) {
        $.get("/queue/add/", {type: type, id: id}).done(function(data) {
            if (data.success) {
                alert('Added song');
            }
        });
    },

    bindUIActions: function(){
        var self = this;
        $('.clear-queue').click(function(e){
            e.preventDefault();
            self.clearQueue();
        });

        $('.reset-most-recent').click(function(e){
            e.preventDefault();
            self.resetMostRecent();
        });

        $('.add-to-queue').click(function(e){
            e.preventDefault();
            var type = $(this).data('type');
            var id   = $(this).data('id');
            self.addToQueue(type, id);
        });
    }
};

GriffSonos.functions = function(){
    GriffSonos.Queue.init();
};


GriffSonos.run();

