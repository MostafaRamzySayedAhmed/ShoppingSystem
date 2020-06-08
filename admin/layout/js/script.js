$(document).ready(function() {
	
	'use strict';
    
    // Triggering The "Nice Scroll" Library
    
    $('html').niceScroll({
        
        cursorcolor: '#1abc9c',
        
        cursorwidth: '10px',
        
        cursorborder: '1px solid #1abc9c',
        
        cursorborderradius: 0
        
    });
	
	// Hiding The Placeholder On Focusing & Showing It On Bluring
	
	$('[placeholder]').focus(function() {
		
		$(this).attr('data-text', $(this).attr('placeholder'));
		
		$(this).attr('placeholder', '');
		
	}).blur(function() {
		
		$(this).attr('placeholder', $(this).attr('data-text'));
		
	});
	
	// Turning The Pasword Type Attribute Into Text On Mouse Moving & Turning It Back To Password On    Mouse Leaving
	
	$(".show-pass").hover(function() {
		
    $(".password-add").attr("type", "text");
		
    }, function(){
		
    $(".password-add").attr("type", "password");
		
	});
	
	// Confirmation Message On Deleting Button
	
	$('.member-delete').click(function() {
		
		return confirm("Are You Sure You Want To Delete This Member ?");
		
	});
	
	$('.category-delete').click(function() {
		
		return confirm("Are You Sure You Want To Delete This Category ?");
		
	});
	
	$('.subcategory-delete').click(function() {
		
		return confirm("Are You Sure You Want To Delete This Sub-Category ?");
		
	});
	
	$('.item-delete').click(function() {
		
		return confirm("Are You Sure You Want To Delete This Item ?");
		
	});
	
	$('.comment-delete').click(function() {
		
		return confirm("Are You Sure You Want To Delete This Comment ?");
		
	});
	
	// Categories Viewing Options
	
	$('.category h3').click(function () {

		$(this).next('.full-view').fadeToggle(200);

	});

	$('.option span').click(function () {

		$(this).addClass('active');
		$(this).siblings('span').removeClass('active');

		if ($(this).data('view') === 'full') {

			$('.category .full-view').fadeIn(200);

		} else {

			$('.category .full-view').fadeOut(200);

		}

	});
	
	// Dashboard Viewing Options

	$('.toggle-info').click(function () {

		$(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(200);

		if ($(this).hasClass('selected')) {

			$(this).html('<i class="fa fa-minus fa-lg"></i>');

		} else {

			$(this).html('<i class="fa fa-plus fa-lg"></i>');

		}

	});
	
	// Showing & Hiding 'Edit & Delete' Buttons For Sub-Categories
	
	$(".show").hover(function() {
		
    	$(this).find('.confirm').fadeIn(400);
		
    }, function(){
		
        $(this).find('.confirm').fadeOut(400);
		
	});
	
});