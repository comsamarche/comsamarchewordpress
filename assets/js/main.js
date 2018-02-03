"use strict";

(function(){

	var barbaActive = true;

	if (barbaActive){

			Barba.Pjax.Dom.wrapperId = "content"
			Barba.Pjax.Dom.containerClass = "content-area";
			Barba.Pjax.start();


			Barba.Pjax.getTransition = function () {
				return HideShowTransition;
			};

			var HideShowTransition = Barba.BaseTransition.extend({
				start: function () {

					var newUrl = Barba.Pjax.getCurrentUrl();
					var regexp = "/wp-admin/";
					if (newUrl.match(regexp)!== null){
						Barba.Pjax.goTo(newUrl)
						return false;
					}

					this.oldContainer.style.opacity = .6;
					this.newContainerLoading.then(this.finish.bind(this));

					// As soon the loading is finished and the old page is faded out, let's fade the new page
					Promise
						.all([this.newContainerLoading, this.fadeOut()])
						.then(this.fadeIn.bind(this));
				},

				finish: function () {
					document.body.scrollTop = 0;
					this.done();
				},

				fadeOut: function () {
					/**
					 * this.oldContainer is the HTMLElement of the old Container
					 */
					return this.fade( 0.1 );
				},

				fadeIn: function () {
					/**
					 * this.newContainer is the HTMLElement of the new Container
					 * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
					 * Please note, newContainer is available just after newContainerLoading is resolved!
					 */

					var _this = this;
					var $el = this.newContainer;

					this.oldContainer.style.display = "none";

					$el.style.visibility = 'visible';
					$el.style.opacity = 0;

					/**
					 * Hide navigation
					 */
					var openMenu = document.querySelector('.main-navigation.toggled');
					if (openMenu) openMenu.classList.remove('toggled');


					this.show(1, function () {
						/**
						 * Do not forget to call .done() as soon your transition is finished!
						 * .done() will automatically remove from the DOM the old Container
						 */

						_this.done();
					});
				},

				show :function( opa, callback) {
						var elem = this.newContainer;
						var id = setInterval(frame, 40);
						var i = 0;
						function frame() {
							if (i === opa) {
							clearInterval(id);
							return callback;
						} else {
							i = i + 0.1;
							i = (i > opa)?opa: i;
							elem.style.opacity = i;
						}
					}
				},

				fade: async function (opa) {
					var elem = this.oldContainer;
					var i = 1;
					var id = setInterval(frame, 10);
					function frame() {
						if (i === opa) {
							clearInterval(id);
						} else {
							i = i - 0.1;
							i = (i < opa) ? opa : i;
							elem.style.opacity = i;
						}
					}
				}


			});

	}


})()
