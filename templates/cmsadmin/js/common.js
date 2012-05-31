$(document).ready(function() {
    
    var link;
    
    $('div.help-modal:ui-dialog').dialog('destroy');
    
    $('div.help-modal').dialog({
        modal: true,
        autoOpen: false,
        draggable: false,
        resizeable: false,
        closeText: 'Close help',
        dialogClass: 'modal',
        width: 600,
        maxWidth: 600,
        maxHeight: 400,
        show: 'fade',
        hide: 'fade',
        buttons: {
            "OK": function() {
                $(this).dialog('close');
            }
        }
    });
    
    $('.activate-help-modal').click(function() {
        $('div.help-modal').dialog('open');
        return false;
    });
    
    $('div.delete-alert-dialog:ui-dialog').dialog('destroy');
    
    $('div.delete-alert-dialog').dialog({
        modal: true,
        autoOpen: false,
        draggable: false,
        resizeable: false,
        dialogClass: 'modal',
        show: 'fade',
        hide: 'fade',
        buttons : {
            "Yes": function() {
                $(this).dialog('close');
                window.open(link, '_self');
            },
            "No": function() {
                $(this).dialog('close');
            }
        }
    });
    
    $('a.delete-alert').click(function() {
        link = $(this).attr('href');
        $('div.delete-alert-dialog').dialog('open');
        return false;
    });
    
    $('div.settings-modal:ui-dialog').dialog('destroy');
    
    $('div.settings-modal').dialog({
        modal: true,
        autoOpen: false,
        draggable: false,
        resizeable: false,
        dialogClass: 'modal',
        width: 359,
        maxHeight: 400,
        show: 'fade',
        hide: 'fade',
        buttons: {
            "Save": function() {
                if($('form.settings-form').submit()) {
                    alert('Form submits');
                }
                $(this).dialog('close');
            },
            "Cancel": function() {
                $(this).dialog('close');
            }
        },
        create: function() {
	        $(this).closest('.ui-dialog').find('.ui-button:last');
        }
    });
    
    $('a.activate-settings-modal').click(function() {
        $('div.settings-modal').dialog('open');
        return false;
    });
    
    $('div.accordion').accordion({
	    autoHeight: false
    });
    
    $('div.buttonset').buttonset();
    
    $('a.form-button').button();
    
    $('#nav a.seperator').click(function() {
    	return false;
    });
    
    dropdown_animation();
    
});

function dropdown_animation() {
    $("ul#nav li.dropdown ul").hide();
    $("ul#nav li.dropdown").hover(function() {
        $(this).find("ul").effect("slide", { direction: "up" }, 400	);
    },
    function() {
        $(this).find("ul").hide();
    });
}