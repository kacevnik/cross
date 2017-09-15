$('.add_comment').click(function(){
	showCommentWindow('#add_comment_body');
	return false;
});

$('.close_comment_window').click(function() {
	closeCommentWindow();
	return false;
});

$('#comment_back_list').click(function(event) {
	if($(event.target).attr('id') == $(this).attr('id')){
		closeCommentWindow();
	}
});

$('input[name="send_comment"]').click(function() {
	var idUser  = $('input[name="id_user"]').val();
	var idCross = $('input[name="id_cross"]').val();
	var text    = $('textarea[name="text_comment"]').val();
	var email   = $('input[name="email_comment"]').val();
	var hash    = $('input[name="hash_cross"]').val();
	var name    = $('input[name="name"]').val();
	$('#spin_comment').show();
	$('input[name="send_comment"]').hide();
	$('#comment_result_message').html('');
	$.ajax({
		url: '../inc/add_comment.php',
		type: 'POST',
		data: {user: idUser, cross: idCross, text: text, email: email, name: name, hash: hash},
		success: function(result_com){
		    var res = $.parseJSON(result_com);
		    if(res.error == 1){
		    	$('#comment_result_message').html(res.message);
		    	$('#spin_comment').hide();
				$('input[name="send_comment"]').show();
		    }		    
		    if(res.error == 2){
		    	$('#add_comment_ok .show_message_ok').html(res.message);
		    	$('#spin_comment').hide();
				$('input[name="send_comment"]').show();
				$('#add_comment_body form').hide();
				$('#add_comment_ok').show();
		    }
		}
	});
	return false;
});

function closeCommentWindow(){
	$('html, body').removeClass('no_scroll');
	$('#comment_back_list').hide(100);
	$('textarea[name="text_comment"]').val('');
	$('input[name="email_comment"]').val('');
	$('#comment_result_message').html('');
	$('#add_comment_body form').show();
	$('#add_comment_ok').hide();
}

function showCommentWindow(win){
	$('html, body').addClass('no_scroll');
	$('#comment_back_list').height($(document).height()).show();
	$(win).css({top: $(window).scrollTop() + ($(window).height() - $(win).outerHeight(true)) / 2 - 40 + 'px', left: ($(window).width() - $(win).outerWidth(true)) / 2 + 'px'});
}