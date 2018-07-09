/**
 * Creating by comsamarche
 * Author: Christine GUINAUDEAU
 * Site: comsamarche.com , christineguinaudeau.fr
 * ---------------------
 * ROUTEUR des JS
 * ----------------------
 * Last update:  2018/02/08
 * Components: Requirejs (http://requirejs.org/)
 * Projet: Wordpress maud Chenut-briotet - Podologue - Dijon
 */


"use strict";

requirejs.config({
	baseUrl: '/wp-content/themes/maudtheme/assets/js/lib',
	paths: {
		Barba: 'barba'
		, barbaTransition: '../main/class-barba-transition'
		, acteTabs: '../main/class-acte-tabs'
	}
	, packages: [
			{
				name: 'TweenMax',
				location: 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/',
				main: 'TweenMax.min.js'
			}
		]
	, findNestedDependencies: true
});

(function () {


	/**
	* - INITIALISATION HOME
	* - Animation de transition
	* - ActeTabs : les onglets
	*/
	define(['acteTabs', 'barbaTransition'], function (ActeTabs, BarbaTransition) {

		var barbaTransition = new BarbaTransition();
		barbaTransition.init();

		var acteTabs = new ActeTabs();
		acteTabs.init();

	});


})()
