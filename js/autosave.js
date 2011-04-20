/*(function($){
	$.log = function(message){
		$('#footer').append('<p>' + message + '</p>');
	};

	$(document).ready(function(){
		$.log("interval is set to 5 seconds");

		$('form').autosave({
			interval: 	5000,
			setup: 		function(e,o) {
				$.log('jquery.autosave setup: ' + e + ' - ' + o);
			},
			record: 	function(e,o) {
				$.log('jquery.autosave recording: ' + e + ' - ' + o);
			},
			before: 	function(e,o) { 
				$.log('jquery.autosave before saving: ' + e + ' - ' + o);
				return true; 
			},
			validate: 	function(e,o) {
				$.log('jquery.autosave checking validation: ' + e + ' - ' + o);
				return $.isFunction($.fn.validate) && !$(this).is('.ignore-validate') ? $(this).valid() : true; 
			},
			save: 		function(e,o) {
				$.log('jquery.autosave saving: ' + e + ' - ' + o);
			},
			shutdown: 	function(e,o) {
				$.log('jquery.autosave shutdown: ' + e + ' - ' + o);
			},
			dirty: 		function(e,o) {
				$.log('jquery.autosave dirty: ' + e + ' - ' + o);
			}
		});
				
		setInterval(function(){
			$.log('changing title field');
			$('input[name=title]').val('Autosaved');
		}, 30000);
	});
})(jQuery); */

/*
 * Submit new post 
 */
$('#submit_new_post').click( function() {
	var title = $('#title').val();
	var msg	  = $('#message').val();
	var t_id  = $('#thread_id').val();
	var u_id  = $('#user_id').val();
	var cat   = $('#category').val();
	//var wym   = jQuery.wymeditors({html});
	
	//alert(wym);
	
	if( t_id < 1 ) t_id = 0;
	
	//alert(title + "\n" + msg + "\n" + t_id + " - " + u_id + "\n" + cat);
	
	if( title.length > 0 && msg.length > 0 && u_id > 0 )
	{	
		$(this).text('Publishing...')
			.css({
			'background' : '#ccc url(css/img/circle-ajax-loader.gif) no-repeat 5% 50%',
			'color' : '#888'
		});
		
		$.ajax({
			type:	"POST",
			url:	"?page=submit_new_post",
			data:	"thread_id=" + t_id + "&title=" + title + "&message=" + msg + "&user_id=" + u_id + "&category=" + cat + "&ajax=enabled",
			dataType: "json",
			success:function(data, status, ajaxobject) {
			  //console.log(data + "\n" + status + "\n" + ajaxobject);
				//alert(data.retid);
				$('#submit_new_post').text('Published')
					.css({
					'background' : '#39f url(css/img/dialog-ok-apply.png) no-repeat 5% 50%',
					'color' : '#fff'
				});
				$('<div class="message">Post successfully submitted. Redirecting...</div>')
					.appendTo('#wrapper')
					.hide()
					.slideDown(400)
					.delay(3000)
					.slideUp(200, function() {
						window.location = '?page=view_thread&thread_id=' + data.retid;
					});
			}
		});
	}
	else
		$('<div class="error">Fill in all fields</div>')
			.appendTo('#wrapper')
			.hide()
			.slideDown(800)
			.delay(8000)
			.slideUp(800);
	
	return false;
});


/*
 * Autosave
 */
$('#message').focusin(function() {
	// works once after the timeout
	//window.setTimeout(function() { 

	// works at interval but if the textarea loses focus and then gets it back 
	// there are two intervals going on!
	window.setInterval(function() { 
		// Run autosave via ajax
		console.log("5 seconds passed");
	}, 5000);
});



$('#submit_edited_post').click( function() {
	var title = $('#title').val();
	var msg	  = $('#message').val();
	var t_id  = $('#thread_id').val();
	var p_id  = $('#post_id').val();
	
	if( title.length > 0 && msg.length > 0 && p_id > 0 && t_id > 0 )
	{
		$(this).text('Publishing...')
			.css({
			'background' : '#ccc url(css/img/circle-ajax-loader.gif) no-repeat 5% 50%',
			'color' : '#888'
		});
		
		$.ajax({
			type:	"POST",
			url:	"?page=submit_edited_post",
			data:	"thread_id=" + t_id + "&title=" + title + "&message=" + msg + "&post_id=" + p_id + "&ajax=enabled",
			dataType: "json",
			success:function(data, status, ajaxobject) {
			  console.log(data + "\n" + status + "\n" + ajaxobject);
				//alert(data.retid);
				$('#submit_edited_post').text('Published')
					.css({
					'background' : '#39f url(css/img/dialog-ok-apply.png) no-repeat 5% 50%',
					'color' : '#fff'
				});
				$('<div class="message">Post edited successfully. Redirecting...</div>')
					.appendTo('#wrapper')
					.hide()
					.slideDown(400)
					.delay(3000)
					.slideUp(200, function() {
						window.location = '?page=view_thread&thread_id=' + t_id + '#' + p_id;
					});
			}
		});
	}
	else
		$('<div class="error">Fill in all fields</div>')
			.appendTo('#wrapper')
			.hide()
			.slideDown(800)
			.delay(8000)
			.slideUp(800);
	
	return false;
	
});

$('#save_draft').click( function() {
	
});

$('#discard_draft').click( function() {
	history.back();
});

$('fieldset').ajaxStart(function() {
	//$(this).css('background', 'url(css/img/ajax-loader.gif) no-repeat 50% 10%');
	//$('<p id="ajax_msg" style="position: absolute; top: 100px; left: 400px; line-height: 40pt; width: 300px; border: 5px solid blue; z-index: 1000;">Saving...</p>').appendTo('body');
	/*$('#save_draft')
		.text('Saving...')
		.css({
			'background-color' : '#ccc',
			'color' : '#333'
		});*/
});

$('fieldset').ajaxStop(function() {
	//$('#ajax_msg').remove();
	/*$('#save_draft')
		.text('Saved')
		.css({
			'background-color' : '#3399ff',
			'color' : '#fff'
		});*/
});

$('#wrapper').ajaxError( function(e, xhr, settings, exception) {
	$(this).prepend('<div class="error">Some error occured<br/>Post could not be submitted</div>');
});