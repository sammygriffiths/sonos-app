// The only global variable
var GriffSonos = {};

GriffSonos.functions = {};

GriffSonos.run = function(){
    $(document).ready(function(){
        GriffSonos.functions();
    });

    $(document).ajaxStart(function(){
        GriffSonos.Ajax.start();
    });

    $(document).ajaxStop(function(){
        GriffSonos.Ajax.stop();
    });

    $(document).ajaxSuccess(function(){
        GriffSonos.Ajax.success();
    });

    $(document).ajaxError(function(){
        GriffSonos.Ajax.error();
    });
};

GriffSonos.Ajax = {
    start: function(){
        var img = "/assets/img/spin.svg";
        $('body').prepend('<div class="ajax-loader"><img src="'+img+'" /></div>');
        $('.ajax-loader').hide().fadeIn();
    },

    stop: function(){
        setTimeout(function(){
            $('.ajax-loader').fadeOut(400, function(){
                $(this).remove();
            });
        }, 1000);
    },

    success: function(){
        $('.ajax-loader img').remove();
        $('.ajax-loader').append('<span class="glyphicon glyphicon-ok text-success"></span>');
    },

    error: function(){
        $('.ajax-loader img').remove();
        $('.ajax-loader').append('<span class="glyphicon glyphicon-remove text-danger"></span>');
    }
}

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
        $.get("/queue/add/", {type: type, id: id});
    },

    bindUIActions: function(){
        var self = this;
        $('.clear-queue').click(function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url);
        });

        $('.reset-most-recent').click(function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url);
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

