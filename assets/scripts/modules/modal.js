/**
 *
 * 	Modal
 *
 */

;(function($){

	var Modal = function( trigger ){

		this.trigger = trigger;

		this.modal = $('#modal');

		this.closers = $('[data-modal-close]');

		this.type = trigger.attr("data-modal-type");


		if( this.type == "image"){
            this.imgUrl = trigger.find('img').attr('src');
            this.imgAlt = trigger.find('img').attr('alt');

		}else if(this.type == "video"){
            this.vidUrl = trigger.attr("data-modal-vid-url");

		}else if(this.type == "bio") {

            this.imgUrl = trigger.attr('data-modal-lg-img');
            this.imgAlt = trigger.find('img').attr('alt');
            this.headLine = trigger.find('h3').text();
            this.subHead = trigger.find('p.heading').text();
            this.bio = trigger.find('div.content__bio').html();
        }else if(this.type == "freeTrial") {
            this.freeTrial = trigger.attr("data-free-trial");

		}else{
            console.log("Please Add data-modal-type Attribute to your modal trigger");

		}
		this.bindEvents();

	};


	Modal.prototype.bindEvents = function() {

		var _this = this,
			escKeycode = 27;

		this.trigger.on( 'click', $.proxy( this.openModal, this ) );

		// Close modal on "X", sneezeguard click, or Esc
		this.closers.on( 'click', $.proxy( this.closeModal, this ) );

		$(document).on('keydown', function( event ){
			if ( event.keyCode === escKeycode ) {
				$.proxy( _this.closeModal(), _this );
			}
		});

	};

	Modal.prototype.openModal = function(e) {

		e.preventDefault();

		var currentModal = this.modal;

		if(this.type == "video"){
           $('#modal__content').html('<div class="modal__inner"><div class="flex-video">  <iframe width="640" height="360" src="'+this.vidUrl+'" frameborder="0" allowfullscreen></iframe> </div></div> ').promise().done(function(){
               currentModal.addClass('is-visible');
		   });

		}else if (this.type == "image"){
			var imageLg = this.imgUrl.replace(/-\d+[Xx]\d+/,'');

            $('#modal__content').html('<div class="modal__inner"><img class="image" src="'+imageLg+'" alt="'+this.imgAlt+'"></div>').promise().done(function(){

                currentModal.addClass('is-visible');
            });

        }else if (this.type == "bio"){


            $('#modal__content').html('<div class="modal__inner modal__inner-tall"><div class="wrapper wrapper--main wrapper--full bio"><div class="grid with--bg-white island-55 with--text-left"><div class="grid__item width--lap-5-of-12"><img class="image" src="'+this.imgUrl+'" alt="'+this.imgAlt+'"></div><div class="grid__item width--lap-6-of-12"><h3 class="heading heading--3">'+this.headLine+'</h3><p class="heading heading--6 island-30">'+this.subHead+'</p><div class="with--text-small user-content">'+this.bio+'</div></div></div></div></div>').promise().done(function(){

                currentModal.addClass('is-visible');
                $('body').addClass('modal-open');
            });
        }else if (this.type == "freeTrial"){
			var link0analytics = "";
			var link1analytics = "";
			var target0 = php_vars.free_trial_settings.modals[0].link[0].target === true ? 'target="_blank"' : '';

			if(php_vars.free_trial_settings.modals[0].link[0].link_analytics.length >= 1){
				$.each(php_vars.free_trial_settings.modals[0].link[0].link_analytics, function(ind,val){
						link0analytics = link0analytics += ' data-' + 	val.value.replace(/\s+/g, '-').toLowerCase() + '"=' + val.name + '"';
				});
			}
			var ftModal = '<div class="grid__item width--hand-5-of-12 width--lap-4-of-12"><div class="gateway__animate gateway__animate-3"><div class="card"><div class="card__head"><h2 class="with--text-strong">' + php_vars.free_trial_settings.modals[0].title + '</h2></div><div class="card__body with--text-center"><div class="stack-10"><p class="with--text-large">' + php_vars.free_trial_settings.modals[0].employee_range + '</p></div><div class="stack-30"><p class="with--text-small">' + php_vars.free_trial_settings.modals[0].description + '</p></div><a class="button" ' + link1analytics + ' href="' + php_vars.free_trial_settings.modals[0].link[0].link_destination + '" ' + target0 + '>' + php_vars.free_trial_settings.modals[0].link[0].link_text + '</a></div></div></div></div>';
			if(php_vars.free_trial_settings.modals.length > 1){

				var target1 = php_vars.free_trial_settings.modals[1].link[0].target === true ? 'target="_blank"' : '';
				if(php_vars.free_trial_settings.modals[1].link[0].link_analytics.length >= 1){
					$.each(php_vars.free_trial_settings.modals[1].link[0].link_analytics, function(ind,val){
							link1analytics = link1analytics += ' data-' + 	val.value.replace(/\s+/g, '-').toLowerCase() + '"=' + val.name + '"';
					});
				}
				ftModal += '<div class="grid__item width--hand-5-of-12 width--lap-4-of-12"><div class="gateway__animate gateway__animate-3"><div class="card"><div class="card__head with--bg-dark-blue"><h2 class="with--text-strong">' + php_vars.free_trial_settings.modals[1].title + '</h2></div><div class="card__body with--text-center"><div class="stack-10"><p class="with--text-large">' + php_vars.free_trial_settings.modals[1].employee_range + '</p></div><div class="stack-30"><p class="with--text-small">' + php_vars.free_trial_settings.modals[1].description + '</p></div><a class="button" ' + link1analytics + ' href="' + php_vars.free_trial_settings.modals[1].link[0].link_destination + '"' + target1 + '>' + php_vars.free_trial_settings.modals[1].link[0].link_text + '</a></div></div></div></div>';
			}
			ftModal += '</div></div>';
            $('#modal__content').html('<div class="modal__inner"><div class="wrapper wrapper--main"><div class="grid grid--centered grid--spaced">'+ftModal+'</div></div></div>').promise().done(function(){
            	currentModal.addClass('is-visible');
							if(window.innerWidth < 780){
								$('.modal__sneezeguard').css('background-color', '#e9eef1');
							}
          });
        }
	};


	Modal.prototype.closeModal = function() {
        var currentModal = this.modal;
        $('#modal__content').html('').promise().done(function(){
            currentModal.removeClass('is-visible');
            $('body').removeClass('modal-open');
						if($('.modal__sneezeguard').css('background-color') == 'rgb(233, 238, 241)'){
							$('.modal__sneezeguard').css('background-color', 'rgba(0, 0, 0, 0.5)');
						}
        });

	};


	/**
	 * Instantiate the Modal object on document ready
	 */
	$(function(){
		var triggers = $('[data-modal-trigger]');


		triggers.each( function() {

			new Modal( $(this) );

		});
	});
}(jQuery));
