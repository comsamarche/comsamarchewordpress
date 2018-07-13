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
				var regexp = "/wp-admin/";

				if (newUrl.match(regexp) !== null) {
					Barba.Pjax.goTo(newUrl)
					return false;
				}
			},


			this.render = function () {

				var _this = this;

				if (!(document.getElementById(this.el.id) && document.getElementsByClassName(this.el.class)))
					return console.log('not BarbaTransition');

				Barba.Pjax.Dom.wrapperId = this.el.id;
				Barba.Pjax.Dom.containerClass = this.el.class;
				Barba.Pjax.start();

				var ChangeContent = Barba.Dispatcher.on('newPageReady', function (currentStatus, oldStatus, container, newPageRawHTML) {

					_this.datas = {
						body: newPageRawHTML.match(_this.regex.body)[1],
						head: newPageRawHTML.match(_this.regex.head)[1],
						titre: newPageRawHTML.match(_this.regex.titre)[1],
						footer: newPageRawHTML.match(_this.regex.footer)[1],
					//	menu: newPageRawHTML.match(_this.regex.menu)[1]
					}
					var bodyClass = _this.datas.body.replace('class="', '')
													.replace('"', '');
					document.querySelector('body').removeAttribute('class');
					document.querySelector('body').setAttribute('class', bodyClass);
					var acteTabs = new ActeTabs();
					if( document.querySelector('.acte_wrap') ) acteTabs.init();
				});


			},

			this.init = function () {

				var _this = this;

				this.Homepage.animMenu = this.animMenu;
				this.Page.animMenu = this.animMenu;

				this.Homepage.init();
				this.Page.init();

				Barba.Dispatcher.on('linkClicked', function (HTMLElement, MouseEvent) {
					var idPage = HTMLElement.parentNode.id;
					document.querySelectorAll('#site-navigation li').forEach(function (el) {
						if (el.classList.contains('current-menu-item')) el.classList.remove('current-menu-item');
						if (el.id === idPage) el.classList.add('current-menu-item');
					});
				});

				this.render();

			},


			this.Homepage = Barba.BaseView.extend({
				namespace: 'homepage',
				idPage: 'undefined',
				onEnter: function () {
				// The new Container is ready and attached to the DOM.
					if (!this.container.parentNode.classList.contains('site-content')) this.container.parentNode.classList.add('site-content');
					var el = this.container.querySelector('#presentation');
					TweenMax.fromTo(el, .8, { ease: Back.easeOut.config(3.7), css: { x: '-100vw' } }, { ease: Back.easeOut.config(3.7), css: { x: '0' } });
				},
				onEnterCompleted: function () {
					var _this = this;
					// The Transition has just finished.
				},
				onLeave: function () {
					// A new Transition toward a new page has just started.
					console.log('onLeave Home', this);
				},
				onLeaveCompleted: function () {
					// The Container has just been removed from the DOM.
					console.log('onLeaveCompleted Home', this);
				},
			}),
			this.Page = Barba.BaseView.extend({
				namespace: 'page',
				idPage: 'undefined',
				onEnter: function () {

					var _this = this;
					// The new Container is ready and attached to the DOM.
					if (this.container.parentNode.classList.contains('site-content')) this.container.parentNode.classList.remove('site-content');
					var elmnt = document.querySelector('body'),
						y = elmnt.scrollTop;

				},
				onEnterCompleted: function () {
					// The Transition has just finished.
					var _this = this;

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
