$(document).ready(function(){
	
	'use strict';
	
	// Hiding The Placeholder On Focusing & Showing It On Bluring
	
	$('[placeholder]').focus(function(){
		
		$(this).attr('data-text', $(this).attr('placeholder'));
		
		$(this).attr('placeholder', '');
		
	}).blur(function(){
		
		$(this).attr('placeholder', $(this).attr('data-text'));
		
	});
	
	// Turning The Pasword Type Attribute Into Text On Mouse Moving & Turning It Back To Password On Mouse Leaving
	
	$(".show-pass").hover(function(){
		
    $(".password-add").attr("type", "text");
		
    }, function(){
		
    $(".password-add").attr("type", "password");
		
	});
	
	// Confirmation Message On Deleting Button
	
	$('.member-delete').click(function(){
		
		return confirm("Are You Sure You Want To Delete This Member?");
		
	});
	
	$('.category-delete').click(function(){
		
		return confirm("Are You Sure You Want To Delete This Category?");
		
	});

	// Switching Between Login & Signup Forms
	
	$('.login-page h1 span').click(function () {

		$(this).addClass('selected').siblings().removeClass('selected');

		$('.login-page form').hide();

		$('.' + $(this).data('class')).fadeIn(100);

	});
	
	// Making Live Preview Of The AD When Adding New One
	
	$('.profile-ads .live-item-name').keyup(function(){
		
		$('.live-preview .caption h3').text($(this).val());
		
	});
	
	$('.profile-ads .live-item-desc').keyup(function(){
		
		$('.live-preview .caption p').text($(this).val());
		
	});
	
	$('.profile-ads').ready(function(){
		
		$('.live-preview .price-tag').text("$");
		
	});
	
	$('.profile-ads .live-item-price').keyup(function(){
		
		$('.live-preview .price-tag').text($(this).val() + "$");
		
	});
	
});
