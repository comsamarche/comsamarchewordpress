/**
 * Creating by comsamarche
 * Author: Christine GUINAUDEAU
 * Site: comsamarche.com , christineguinaudeau.fr
 * ---------------------
 * PAGES TRANSITIONS
 * ----------------------
 * Last update:  2018/02/08
 * Components: Requirejs (http://requirejs.org/)
 *             Barba.js (http://barbajs.org/)
 * Projet: Smoothy transition between pages
 */


define(['require', 'Barba', 'TweenMax', 'acteTabs'], function (require, Barba, TweenMax , ActeTabs) {
	"use strict";

	/**
	 * TRANSITION ENTRE LES PAGES
	 */
	function BarbaTransition() {

			this.el = {
				id: "content",
				class: "content-area",
			},

			this.datas = {
				head: false,
				titre: false,
				footer: false
			},

			this.regex = {
				body: /<body (.*)>/,
				titre: /<!--TITRE-->((?:.|\n)*?)<!--FINTITRE-->/,
				menu: /<!--MENU-->((?:.|\n)*?)<!--FINMENU-->/,
				footer: /<!--FOOTER-->((?:.|\n)*?)<!--FINFOOTER-->/,
				head: /<head>((?:.|\n)*?)<\/head>/,
			},

			this.checkurl = function(){
				var newUrl = Barba.Pjax.getCurrentUrl();
				// console.log('newUrl', newUrl);
				var regexp = "/wp-admin/";

				// if (newUrl === "http://localhost:3000/") {
				// 	//console.log('home', Barba.Pjax.Cache);
				// 	//Barba.Pjax.Cache.reset();
				// }
				if (newUrl.match(regexp) !== null) {
					Barba.Pjax.goTo(newUrl)
					return false;
				}
			},


			this.render = function () {

				var _this = this;

				if (!(document.getElementById(this.el.id) && document.getElementsByClassName(this.el.class)))
					return console.log('not BarbaTransition');

				//console.log('BarbaTransition init', Barba);

				Barba.Pjax.Dom.wrapperId = this.el.id;
				Barba.Pjax.Dom.containerClass = this.el.class;
				Barba.Pjax.start();

				var ChangeContent = Barba.Dispatcher.on('newPageReady', function (currentStatus, oldStatus, container, newPageRawHTML) {

					_this.datas = {
						body: newPageRawHTML.match(_this.regex.body)[1],
						head: newPageRawHTML.match(_this.regex.head)[1],
						titre: newPageRawHTML.match(_this.regex.titre)[1],
						footer: newPageRawHTML.match(_this.regex.footer)[1],
						menu: newPageRawHTML.match(_this.regex.menu)[1]
					}
					var bodyClass = _this.datas.body.replace('class="', '')
													.replace('"', '');
					document.querySelector('body').removeAttribute('class');
					document.querySelector('body').setAttribute('class', bodyClass);
					document.querySelector('#primary-menu').innerHTML = _this.datas.menu;

					var acteTabs = new ActeTabs();
					if( document.querySelector('.acte_wrap') ) acteTabs.init();

				});

			},

			this.init = function () {

				var _this = this;
				this.render();

				Barba.Pjax.getTransition = function () {
					_this.checkurl();
					return _this.HideShowTransition;
				};

				this.Homepage.init();
				this.Page.init();
				// /**
				//  * Change Footer
				//  */
				// var Body = document.querySelector('body').innerHTML;
				// Body = Body.replace(this.regex.head, this.datas.head);
				// Body = Body.replace(this.regex.titre, this.datas.titre);
				// Body = Body.replace(this.regex.footer, this.datas.footer);

			},

			this.HideShowTransition = Barba.BaseTransition.extend({
				start: function () {

					this.fadeOut(this.oldContainer);
					//this.newContainerLoading.then(this.finish.bind(this));

					// As soon the loading is finished and the old page is faded out, let's fade the new page
					Promise
						.all([this.newContainerLoading])
						.then(this.fadeIn.bind(this))
						.then(this.finish.bind(this));
				},

				finish: function () {
					document.querySelector('body').scrollTop = 0;
					this.done();
				},

				fadeOut: function (el) {
					/**
					 * this.oldContainer is the HTMLElement of the old Container
					 */
					//document.querySelector('.loader:not(active)').classList.add('active');
					return TweenMax.to(el, 1, {opacity: 0});
				},

				fadeIn: function () {
					/**
					 * this.newContainer is the HTMLElement of the new Container
					 * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
					 * Please note, newContainer is available just after newContainerLoading is resolved!
					 */

					var _this = this;
					var $el = this.newContainer;

					//this.oldContainer.style.display = "none";

					// $el.style.visibility = 'visible';
					$el.style.opacity = 0;

					/**
					 * Hide navigation
					 */
					var openMenu = document.querySelector('.main-navigation.toggled');
					if (openMenu) openMenu.classList.remove('toggled');

					TweenMax.to($el, 2, { ease: Power4.easeOut, opacity: 1, onComplete: finish() });

					function finish(){
						console.log('finish');
						//document.querySelector('.loader.active').classList.remove('active');
					}

				}

			}),


			this.Homepage = Barba.BaseView.extend({
				namespace: 'homepage',
				onEnter: function () {
					// The new Container is ready and attached to the DOM.
					console.log('onEnter Home' , this);
					var el = this.container.querySelector('#presentation');
					TweenMax.fromTo(el, .8, { ease: Back.easeOut.config(3.7), css: { x: '-100vw' } }, { ease: Back.easeOut.config(3.7), css: { x: '0' } });
				},
				onEnterCompleted: function () {
					// The Transition has just finished.
					console.log('onEnterCompleted Home test');
				},
				onLeave: function () {
					// A new Transition toward a new page has just started.
					console.log('onLeave Home');
				},
				onLeaveCompleted: function () {
					// The Container has just been removed from the DOM.
					console.log('onLeaveCompleted Home');
				}
			}),
			this.Page = Barba.BaseView.extend({
				namespace: 'page',
				onEnter: function () {
					// The new Container is ready and attached to the DOM.
					var elmnt = document.querySelector('body');
					var y = elmnt.scrollTop;
					console.log('onEnter Page', y);
				},
				onEnterCompleted: function () {
					// The Transition has just finished.

					var img = this.container.querySelector('.entry-content.full-content img');
					if(img){
						TweenMax.from(img, .8, { ease: Back.easeOut.config(3.7), opacity: 0, css: { x: '-100vw' } });
					}

				},
				onLeave: function () {
					// A new Transition toward a new page has just started.
					console.log('onLeave Page');
				},
				onLeaveCompleted: function () {
					// The Container has just been removed from the DOM.
					console.log('onLeaveCompleted Page');
				}
			});

	};

	return BarbaTransition;

});
