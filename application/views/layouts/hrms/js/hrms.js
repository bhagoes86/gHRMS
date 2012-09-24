$.noConflict();
jQuery(document).ready(function($) {
	$(".alert").animate({top: "0px"}, 1000 ).show('fast').fadeIn(200).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);

	/*-------------------
	* validasi form
	-------------------*/
	// validasi form agama
	$('#agama-form').validate({
	    rules: {
	      agama: {
	        minlength: 2,
	        required: true
	      }
	    },
	    highlight: function(label) {
	    	$(label).closest('.control-group').addClass('error');
	    },
	    success: function(label) {
	    	label
	    		.text('OK!').addClass('valid')
	    		.closest('.control-group').addClass('success');
	    }
	  });

	window.now = new hrms();

	$('input[name="tanggal_lahir"].datepicker').datepicker({format: 'yyyy-mm-dd', startDate: window.now.date})
			   	.on('changeDate', function(ev){
				    $(this).datepicker('hide');
				});
});

hrms = function(){
	this.hour;
	this.minute;
	this.amp;
	this.date;
	
	var time = new Date();
	var date = time.getDate();
	var month = time.getMonth() + 1;
	var year = time.getFullYear();
	var hr = time.getHours();
	var min = time.getMinutes();
	var sec = time.getSeconds();
	var ampm = "PM";
	if (hr < 12){
		ampm = "AM";
	}
	if (hr > 12){
		hr -= 12;
	}
	if (hr < 10){
		hr = "0" + hr;
	}
	if (min < 10){
		min = "0" + min;
	}
	if (sec < 10){
		sec = "0" + sec;
	}
	if(date < 10){
		date = "0" + date;
	}
	if(month < 10){
		month = "0" + month;
	}
	
	this.hour = hr;
	this.minute = min;
	this.amp = ampm;
	this.date = date+'/'+month+'/'+year;
 }

