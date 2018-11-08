/*
* jQuery Modal Layer- 0.9
* Copyright (c) 2013 nickname stryper http://gotoplay.tistory.com/
* Dual licensed under the MIT and GPL licenses:
* http://www.opensource.org/licenses/mit-license.php
* http://www.gnu.org/licenses/gpl.html
*/
(function($){
	$.fn.modalLayer = function(){
		var $modals = this;
		var $focus ='a[href], area[href], input:not([disabled]), input:not([readonly]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, *[tabindex], *[contenteditable]';
		var $radioCheck = "input[type='checkbox'], input[type='radio']";
		$modals.click(function(e){
			e.preventDefault();
			var $this = $(this);
			var $select_id = $($(this).attr('href'));
			var $sel_id_focus = $select_id.find($focus);
			var $focus_num = $select_id.find($focus).length;
			var $closBtn = $select_id.find('.closeModalLayer');
			var $checkLabel = $select_id.find($radioCheck);
			var clickAnchor = $this.attr('href');
			var hrefFocus = this;
			var $leftP = ( $(window).scrollLeft() + ($(window).width() - $select_id.width()) / 2 );
			var $topP = ( $(window).scrollTop() + ($(window).height() - $select_id.height()) / 2 );
			$('body').append('<div class="overlay" tabindex="-1"></div>');
			$select_id.css({ 'top':$topP ,'left':$leftP });
			$select_id.attr('tabindex', '0').attr({'aria-hidden':'false','aria-live':'polit'}).fadeIn(100).focus();
			$select_id.on('blur', function(){ $(this).removeAttr('tabindex'); });
			$('div.overlay').fadeIn(300);
			setTimeout(function() {	$('div.overlay').css("height",$(document).height()); }, 10);
			$(window).on("resize", function () { $('div.overlay').css("height",$(document).height()); }).resize();
			$('#wrap').attr('aria-hidden','true');
			$(clickAnchor).siblings().find($focus).attr('tabindex','-1');
			$($select_id).find($focus).last().on("keydown", function(e){
				if (e.which == 9) {
					if(e.shiftKey) {
						$($select_id).find($focus).eq($focus_num - 1).focus();
						e.stopPropagation();
					} else {
						$($select_id).find($focus).eq(0).focus();
						e.preventDefault();
					};
				};
			});
			$($select_id).find($focus).first().on("keydown", function(e){
				if(e.keyCode == 9) {
					if(e.shiftKey) {
						$($select_id).find($focus).eq($focus_num - 1).focus();
						e.preventDefault();
					};
				};
			});
			$($select_id).on("keydown", function(e){
				if ( e.which == 27 ) {
					$.fn.hide_modal ();
				};
				if( $(this).is(":focus") ){
					if(e.keyCode == 9) {
						if(e.shiftKey) {
							$($select_id).find($focus).eq($focus_num - 1).focus();
							e.preventDefault();
						};
					};
				};
			});
			$($checkLabel).on("click", function(){  $(this).focus();  });
			$closBtn.on("click", {msg:clickAnchor,msg2:hrefFocus},function(e){
				$.fn.hide_modal (e.data.msg,e.data.msg2 );
			});
		});
		$.fn.hide_modal = function (info, hrefFocus){
			$(info).attr('aria-hidden','true').fadeOut(300);
			$('#wrap').removeAttr('aria-hidden');
			$(info).siblings().find($focus).removeAttr('tabindex');
			$('div.overlay').fadeOut(100);
			setTimeout(function() { $('div.overlay').remove(); }, 400);
			$(info).find($radioCheck).prop('checked', false);
			$(info).find("input[type='text']").val('');
			setTimeout(function() { $(hrefFocus).focus(); }, 100);
		};
	};
})(jQuery);