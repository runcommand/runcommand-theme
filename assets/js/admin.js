(function($){

	var runcommandAdmin = {

		/**
		 * Initialize admin JavaScript
		 */
		init: function() {

			this.setupMaxLengthCountdown();
			$('.fm-item').on('fm_added_element', $.proxy( this.setupMaxLengthCountdown, this ) );
			this.setupElementCounter( $("input#title") );
			this.setupElementCounter( $("textarea#excerpt") );
		},

		/**
		 * Set up max length countdown
		 */
		setupMaxLengthCountdown: function() {

			$('.fm-element[data-runcommand-max-length-countdown]').each( $.proxy( function(i,e){
				var el = $(e);
				if ( el.closest('.fm-item').hasClass('fmjs-proto') || el.hasClass('runcommand-max-length-countdown') ) {
					return;
				}
				this.setupElementCounter( el );
			}, this ) );

		},

		/**
		 * Set up a counter on an element
		 */
		setupElementCounter: function( el ) {

			if ( ! el.length ) {
				return;
			}

			var wrap = $('<div />');
			wrap.addClass('runcommand-counter-wrap');
			el.wrap( wrap );
			var span = $('<span />');
			span.addClass('runcommand-counter');
			el.before( span );
			el.addClass('runcommand-max-length-countdown');
			var setCounter = function() {
				var counter = el.val().length;
				if ( el.attr('maxlength' ) ) {
					counter = el.attr('maxlength') - counter;
				}
				span.text( counter );
				if ( el.attr('maxlength' ) && counter <= 10 ) {
					span.addClass('near-limit');
				} else {
					span.removeClass('near-limit');
				}
			}
			setCounter();
			el.on( 'keydown', this.debounce( setCounter ) );
		},

		/**
		 * Returns a function, that, as long as it continues to be invoked, will not
		 * be triggered. The function will be called after it stops being called for
		 * N milliseconds. If `immediate` is passed, trigger the function on the
		 * leading edge, instead of the trailing.
		 */
		debounce: function(func, wait, immediate) {
			var timeout;
			return function() {
				var context = this, args = arguments;
				var later = function() {
					timeout = null;
					if (!immediate) {
						func.apply(context, args);
					}
				};
				var callNow = immediate && !timeout;
				clearTimeout(timeout);
				timeout = setTimeout(later, wait);
				if ( callNow ) {
					func.apply(context, args);
				}
			};
		}

	};

	$(document).ready(function(){
		runcommandAdmin.init();
	});

}(jQuery))
