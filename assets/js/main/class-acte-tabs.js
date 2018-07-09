/**
 * Creating by comsamarche
 * Author: Christine GUINAUDEAU
 * Site: comsamarche.com , christineguinaudeau.fr
 * ---------------------
 * TABS
 * ----------------------
 * Last update:  2018/02/08
 * Components: Requirejs (http://requirejs.org/)
 * Projet: Système d'onglets
 */


define(['require', 'TweenMax'], function (require, TweenMax) {
	"use strict";

		/**
		 * ONGLETS DE LA HOME
		 */
		function ActeTabs() {

			this.el = (document.querySelector('section.acte_wrap')) ? document.querySelector('.acte_wrap') : false,

			this.event = function(){
				var self = this;
				this.el.querySelectorAll('.nav_acte .btn').forEach(function(btn) {
					btn.addEventListener("click", self.changeSlide.bind(self), true);
				});

				this.el.querySelectorAll('.wrap .btn.btn--split .flaticon-download-arrow').forEach(function (btn) {
					btn.addEventListener("click", self.animContent.bind(self), false);
				});

				//window.addEventListener("hashchange", self.changeSlide, true);
			}

			this.changeSlide = function (e){
				e.preventDefault();
				var _this = this;

				// navigation
				var btn = e.target.closest("a.btn");

				// init anim
				document.querySelectorAll('.nav_acte a').forEach(function (el) {
					if (el.classList.contains('active')) el.classList.remove('active');
					if (el === btn) {
						el.classList.add('active');
					}
				});
				// content
				var wrap = btn.closest('section.acte_wrap');
				var blocClass = btn.getAttribute('data-active').replace('#', '');
				wrap.setAttribute('data-slide', blocClass);
				wrap.querySelectorAll('.wrap').forEach(function (el) {
					el.classList.add('in-progress');
				});
				wrap.querySelectorAll('.wrap').forEach(function(el){
					if (el.classList.contains('active')) el.classList.remove('active');
					if (el.classList.contains('wrap_' + blocClass)){
						el.classList.add('active');
					}
				});
				wrap.querySelectorAll('.wrap.in-progress').forEach(function (el) {
					el.classList.remove('in-progress');
				});

				_this.play();

			},

			this.animContent = function (e) {
				e.preventDefault();
				var wrap = e.target.closest(".wrap"),
					content = wrap.querySelectorAll('.text_content')[0],
					classes = wrap.classList;
					classes.toggle('open');

				if (wrap.classList.contains('open')){
					this.animation.animText.open(content);
				}
				else{
					this.animation.animText.close(content);
				}
				e.stopPropagation();
				return false;
			},

			this.animation = {

				 animButton : {
					  on: function (el) {
						  var elWidth = el.clientWidth;
						  TweenMax.to(el, .8, { ease: Back.easeOut.config(3.7), css: { x: 10, marginLeft: -10} });
					}
					, off: function (el) {
						TweenMax.to(el, .3, { ease: Back.easeOut.config(1.7), css: { x: 0, marginLeft: 0 }});
					}
				}
				, animWrap : {
					inProgress: function(el){
						TweenMax.to(el, 1, { ease: Back.easeOut.config(1.7), opacity: 0 });
					}
					, off: function (el) {
						TweenMax.to(el, 1, { css: { zIndex: 1 } } , 1);
					}
					, on: function (el) {
						TweenMax.to(el, 1, { css: { zIndex: 11, opacity: 1 }, ease: Power2.easeIn  })
					}
				}

				, animText : {
					  open: function (el) {
						  TweenMax.fromTo(el, .6, { css: { maxHeight: 0, opacity: 0 }, ease: Power2.easeIn }, { css: { maxHeight: 800, opacity: 1 }, ease: Power2.easeIn })
					}
					, close: function (el) {
						TweenMax.to(el, .4, { css: { maxHeight: 0 , opacity: .2 }, ease: Power2.easeOut })
					}
				}

			},

			this.play = function(){

				// Animation Button nav
				this.animation.animButton.off('.nav_acte .btn');
				this.animation.animButton.on('.nav_acte .btn.active');

				// Animation Wrap
				this.animation.animWrap.inProgress('.wrap > *');
				this.animation.animWrap.off('.wrap > *');
				this.animation.animWrap.on('.wrap.active > *');
			}

			this.render = function () {
				if (!this.el)
					return console.log('not acteTabs');

				console.log('ok acteTabs');
				this.play();
				this.event();
			}

			this.init = function () {
				return this.render();
			}
		};

		return ActeTabs;

	});
