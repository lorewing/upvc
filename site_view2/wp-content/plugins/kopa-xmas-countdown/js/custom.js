'use strict';

jQuery(document).ready(function() {
    if(jQuery('.kopa-widget-christmas').length > 0){
	setInterval(mc__update, 1000);

	//create instance
    jQuery('.kopa-chart-hours').easyPieChart({
        animate: 2000,
        scaleColor: false,
        barColor: '#01bbd4',
        trackColor: '#4d6368',
        lineWidth: 7,
        trackWidth: 7,
    });

    jQuery('.kopa-chart-minutes').easyPieChart({
        animate: 2000,
        scaleColor: false,
        barColor: '#ff5521',
        trackColor: '#4d6368',
        lineWidth: 7,
        trackWidth: 7,
    });

    jQuery('.kopa-chart-seconds').easyPieChart({
        animate: 2000,
        scaleColor: false,
        barColor: '#e6ce7b',
        trackColor: '#4d6368',
        lineWidth: 7,
        trackWidth: 7,
    });

    jQuery('.kopa-widget-christmas').on('click', '.kopa-close',function(event) {
        event.preventDefault();
        jQuery('.kopa-custom-chirstmas').slideUp(1000);
    });
    
}
    
});
var xmas_countdown_status = kxc_front_variable.status;
function mc__update() {
	// var timer = countdown(
	//     null,
	//     new Date("December 24, 2015 00:00:00"),
	    
	//     countdown.HOURS|countdown.MINUTES|countdown.SECONDS
	// );
    var timer;
   
    if(xmas_countdown_status != 0){
    timer = mc_countdown(kxc_front_variable.countdown.xmas);
    } else {
    timer = mc_countdown(kxc_front_variable.countdown.newyear);
    }
	// jQuery('#mc_hours').text(timer.hours);
	// jQuery('#mc_minutes').text(timer.minutes);
	// jQuery('#mc_seconds').text(timer.seconds);


 //   	var chart_seconds = timer.seconds / 60 *100;
 //   	var chart_minutes = timer.minutes / 60 *100;
 //   	var chart_hours = timer.hours / 60 *100;
 //    jQuery('.kopa-chart-seconds').data('easyPieChart').update(chart_seconds);
 //    jQuery('.kopa-chart-minutes').data('easyPieChart').update(chart_minutes);
 //    jQuery('.kopa-chart-hours').data('easyPieChart').update(chart_hours);

    if(timer.seconds == 0 && timer.minutes == 0 && timer.hours == 0 && xmas_countdown_status !=0 ){
       // jQuery('.kopa-countdown-content').remove();
        jQuery.ajax({
            type: 'POST',
            url: kxc_front_variable.ajax.url,
            data: {
                wpnonce: jQuery('#kopa_xmas_banner_nonce').val(),
                action: 'kopa_xmas_status',
                status: 'disable'
            },
            success: function(data){
                xmas_countdown_status = 0;
                timer = mc_countdown(kxc_front_variable.countdown.newyear);
            }
        });
    }
}

function mc_countdown(date){
    var timer = countdown(
        null,
        new Date(date),
        
        countdown.HOURS|countdown.MINUTES|countdown.SECONDS
    );
    jQuery('#mc_hours').text(timer.hours);
    jQuery('#mc_minutes').text(timer.minutes);
    jQuery('#mc_seconds').text(timer.seconds);


    var chart_seconds = timer.seconds / 60 *100;
    var chart_minutes = timer.minutes / 60 *100;
    var chart_hours = timer.hours / 60 *100;
    jQuery('.kopa-chart-seconds').data('easyPieChart').update(chart_seconds);
    jQuery('.kopa-chart-minutes').data('easyPieChart').update(chart_minutes);
    jQuery('.kopa-chart-hours').data('easyPieChart').update(chart_hours);

    return timer;
}