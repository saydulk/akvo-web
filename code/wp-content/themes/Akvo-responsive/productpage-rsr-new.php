<?php
  /*
    Template Name: product-rsr-v3.1
  */
?>
<?php get_header(); ?>
<!--Start of Akvo.org RSR Product Page-->

<?php
	$tabs = array(
		'overview' => array(
			'title' => 'Overview',
			'tagline' => 'overview_tagline',
			'elements' => array(
				'overview_carousel' => 'rsr_carousel',
				'overview_columns' => 'rsr_overview_columns',
				'overview_buttons' => 'rsr_overview_buttons',
				'testimonials' => 'rsr_testimonials',
				'counter'=> 'rsr_overview_counter',
				'overview_get_in_touch' => 'rsr_get_in_touch'
			)
		),
		'features' => array(
			'title' => 'Features',
			'tagline' => 'feature_tagline',
			'elements' => array(
				'feature_banner' => 'rsr_banner',
				'feature_columns' => 'rsr_feature_columns',
				'tour' => 'rsr_tour'
				
			)
		),
		'pricing' => array(
			'title' => 'Pricing',
			'tagline' => 'pricing_tagline',
			'elements' => array(
				'pricing_banner' => 'rsr_banner',
				'pricing_git' => 'rsr_get_in_touch'
			)
		),
		'support' => array(
			'title' => 'Support',
			'tagline' => 'support_tagline',
			'elements' => array(
				'support_banner' => 'rsr_banner',
				'support_content' => 'rsr_content',
				'support_section' => 'rsr_support_section',
				'support_buttons' => 'rsr_support_buttons'
				
			)
		)
	);
	
	function slugify($text){ 
  		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
   		return strtolower($slug);
	}
	
	function rsr_content($el){
	?>
		<div class="sub-section">
			<div class="wrapper">
				<div class="text-center"><?php the_field($el);?></div>
			</div>
		</div>
		
	<?php
	}
	
	function rsr_overview_columns($el){
		_e("<div class='sub-section'>");
		_e("<div class='threeColumns wrapper'>");
		while(have_rows($el)): the_row();
			_e("<div>");
			_e("<h3>".get_sub_field('title')."</h3>");
			_e("<p>".get_sub_field('description')."</p>");
			_e("</div>");
		endwhile;
		_e("</div><div class='clearfix'></div>");
		_e("</div>");
	}
	
	function rsr_overview_buttons($el){
	?>
		<div class='sub-section'>
			<ul class='list-box'>
				<li class="box">
      				<a data-behaviour="show-video" href="#video" title="<?php the_field('video_link_text'); ?>" class="button"><?php the_field('video_link_text'); ?></a>
      			</li>
      			<li class="box">
      				<a href="<?php the_field('tour_link'); ?>" title="<?php the_field('tour_link_text'); ?>" class="button"><?php the_field('tour_link_text'); ?></a>
      			</li>
  			</ul>
  		</div>	
  		<div id="video" class="videoContainer wrapper">
			<div class="vimeoBlockedMessage">
        		<?php the_field('rsr_video_backup_message'); ?>
      		</div>
      		<iframe width="800" height="450" frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="<?php the_field('video_link'); ?>"></iframe>
    	</div>
  	<?php	
  	}
	
	function rsr_get_in_touch($el){
	?>
		<div class='sub-section text-center'>
			<h4><?php the_field($el."_text");?></h4><br>
			<a href="<?php the_field($el."_link");?>" class="button">Get in touch</a>
		</div>	
	<?php
	}
	
	function rsr_overview_counter($el){
		?>
		
		<?php 
			$url = 'http://rsr.akvo.org/api/v1/right_now_in_akvo/?format=json';
			$str = file_get_contents($url);
			
			$json = json_decode($str, true); 
		?>	
		<div class='sub-section'>
			<ul class='list-box'>
				<li class="box">
      				<h4>Organisations that trust us and are using Akvo RSR.</h4>
      				<div class="timeTicker">            
    					<p class="timeSegment clear" data-behaviour="time-ticker" data-value="<?php _e($json['number_of_organisations']);?>">
       						<span class="digit">1</span>
       						<span class="digit">2</span>
       						<span class="digit">5</span>
       						<span class="digit">8</span>
   						</p>
            		</div>
      			</li>
      			<li class="box">
      				<h4>Projects that our partners have uploaded to RSR.</h4>
      				<div class="timeTicker">            
    					<p class="timeSegment clear" data-behaviour="time-ticker" data-value="<?php _e($json['number_of_projects']);?>">
       						<span class="digit">1</span>
       						<span class="digit">2</span>
       						<span class="digit">5</span>
       						<span class="digit">8</span>
   						</p>
            		</div>
      			</li>
  			</ul>
  		</div>
  		<?php	
	}
	
	function rsr_feature_columns($el){
	?>
		<div class='sub-section'>
		<div class='threeColumns wrapper'>
		<?php while(have_rows($el)): the_row();?>
			<div>
			<h3><?php _e(get_sub_field('heading'));?></h3>
			<?php
				$boxes = get_sub_field('box');
				foreach($boxes as $box):
			?>
				<div class="box-col">
					<i class="fa fa-2x <?php _e($box['icon']);?>"></i>
					<h4><?php _e($box['title']);?></h4>
					<p><?php _e($box['description']);?></p>
				</div>	
			<?php endforeach;?>
			<p><?php _e(get_sub_field('description'));?></p>
			</div>
		<?php endwhile;?>
		</div>
		<div class='clearfix'></div>
		</div>
	<?php }
	
	function rsr_testimonials($el){
	?>
		<div class="sub-section">	
			<div class="threeColumns wrapper">
				<?php while(have_rows($el)): the_row();?>
				<div class="text-center">
					<img src="<?php the_sub_field('profile_picture');?>" />
					<h4><?php the_sub_field('title');?></h4>
					<p><?php the_sub_field('description');?></p>
					<hr>
					<p><small><?php the_sub_field('name');?><br><?php the_sub_field('job_title');?></small></p>
				</div>
				<?php endwhile;?>
			</div>
		</div>	
		<div class='clearfix'></div>
		<!--div class="sub-section big-box-wrapper">
			<div class="wrapper">
				<h3 class='text-center'>What our users say</h3>
				<ul class='list-box'>
				<?php while(have_rows($el)): the_row();?>
					<li class='box'>
						<img src="<?php the_sub_field('profile_picture');?>" />
						<h4><?php the_sub_field('title');?></h4>
						<p><?php the_sub_field('description');?></p>
						<hr>
						<p><small><?php the_sub_field('name');?><br><?php the_sub_field('job_title');?></small></p>
					</li>
				<?php endwhile;?>
				</ul>
			</div>
		</div-->	
	<?php	
	}
	
	function rsr_tour(){
		_e("<div class='sub-section'>");
		_e("<h3>Akvo RSR Tour</h3>");
		while(have_rows('tour')): the_row();?>
			<div class="screenshot">
				<h4><?php the_sub_field('title');?></h4>
				<p><?php the_sub_field('description');?></p>
				<img src="<?php the_sub_field('image');?>" />
			</div>
		<?php endwhile;
		_e("</div>");
	}
	
	function rsr_carousel($el){
		_e("<ul class='bxslider'>");
		while(have_rows($el)): the_row();?>
			<li>
            	<div class="borderTop"></div>
           		<div class="image" style="background-image:url(<?php _e(get_sub_field('image'));?>);">
           			<?php if(get_sub_field('image_text')):?>
           			<a href="<?php _e(get_sub_field('image_link'));?>">
           				<?php _e(get_sub_field('image_text'));?>
           			</a>
           			<?php endif;?>
           		</div>
            	<div class="borderBottom"></div>
            </li>
    	<?php endwhile;
		_e("</ul>");
	}
	
	function rsr_banner($el){
	?>
		<div class="banner" style="background-image:url('<?php the_field($el);?>');"></div>
	<?php	
	}
	
	function rsr_support_buttons($el){
		
	?>
		<div class='sub-section'>
			<ul class='list-box'>
				<?php while(have_rows($el)): the_row();?>
				<li class="box">
					<h4><?php the_sub_field('description');?></h4><br>
      				<a href="<?php the_sub_field('link');?>" title="<?php the_sub_field('text'); ?>" class="button"><?php the_sub_field('text'); ?></a>
      			</li>
      			<?php endwhile;?>
  			</ul>
  		</div>	
		
		
	<?php
		
	}
	
	function rsr_support_section($el){
	
	?>
		<!--div class="sub-section">
			<div class="wrapper">
				
				<ul>
					
					<li>
						
						<div class="left-col"></div>
						<div class="right-col"></div>
						
					</li>
					
					
				</ul>
				
				
				
			</div>
		</div-->
		
		
		<section id="nuggets" class="rsrNuggetsSection">
			<ul class="wrapper">
    		<?php if(have_rows($el)):?>
      			<?php while(have_rows($el)): the_row(); ?>
        		<li class="rsrNuggets floats-in sub-section">
          			<h3 class="nuggetTitle nuggetAside"><?php the_sub_field('title'); ?></h3>
          			<img src="<?php the_sub_field('image'); ?>" class="nuggetImage">
          			<p class="nuggetDescription nuggetAside"><?php the_sub_field('description'); ?></p>
        		</li>      
      			<?php endwhile; ?>
    		<?php endif; ?>
			
					
		</section>
  <?php
  	
	}

?>

<div id="content" class="floats-in productPage withSubMenu rsrProdPag">
	
	<!--div class="projectGateWay">
    	<p>Already an RSR user?</p>
    	<a href="http://rsr.akvo.org/sign_in" class="">Log in to Akvo RSR &rsaquo;</a>
  	</div-->

  	<hgroup>
    	<h1><?php the_field('rsr_name'); ?></h1>
    	<h2 id="tagline"></h2>
  	</hgroup>
	
	<section>
  		<ul class="rsr-tabs" data-behaviour="rsr-tabs">	
  			<?php foreach($tabs as $tab):?>
      		<li class="rsr-tab" data-tagline="<?php the_field($tab['tagline']);?>">
        		<a href="#<?php _e(slugify($tab['title'])); ?>"><?php _e($tab['title']);?></a>
        	</li>
        	<?php endforeach;?>	
    	</ul>
	</section>
  	
  	<?php foreach($tabs as $tab):?>
  	<section class="tab-content" id="<?php _e(slugify($tab['title'])); ?>">
  		<?php	
  			/* Displaying the inline elements within the tab */ 
  			$elements = $tab['elements'];
  			if($elements){ 
  				if(is_array($elements)){
  					foreach($elements as $key=>$el){
  						call_user_func($el, $key);
  					}
  				}
  			}
  			
  		?>
  		
	</section>
  	<?php endforeach;?>	
</div>  

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.bxslider.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


<?php get_footer(); ?>
<script type="text/javascript">
	
	
	$(document).ready(function() {
		/*
    	var expectedVideoId = '<?php the_field('video_id'); ?>';
    	var videoBlockMessageTimeout = 10000;

    	// Check that vimeo isn't blocked
    	$.ajax({
      		url: 'https://vimeo.com/api/v2/video/' + expectedVideoId + '.json',
      		context: document.body,
      		timeout: videoBlockMessageTimeout
    	}).done( function(response) {
      		var urlFromAPI= response[0].url;
			// Does the id returned by the api match the real id?
      		if (urlFromAPI.indexOf(expectedVideoId) < 0) {
        		vimeoIsBlocked();
     		 }
    	}).fail( function() {
      		vimeoIsBlocked();
    	});

    	function vimeoIsBlocked() {
      		$('.vimeoBlockedMessage').show();
    	}
		*/
    	
  	});


	(function($){
		
		
		$.fn.rsr_time_ticker = function(){
			return this.each(function(){
				var el = $(this);
				
				el.html('');
				
				console.log('time ticker');
				
				var str = "" + el.data('value') + "";
				
				
				for(var i=0; i<str.length; i++){
					var digit_val = str[i];
					console.log(digit_val);
					
					var digit = $(document.createElement('span'));
					digit.addClass('digit');
					digit.html(digit_val);
					
					digit.appendTo(el);					
					
				}
				
       		});
		};
		
		console.log('pre-tabs');	
			
    	$.fn.rsr_tabs = function(){
       		return this.each(function(){
       			console.log('tabs init');
       			var ul = $(this);
       			
       			ul.activate = function(list){
       				list.addClass('active');
       				$('#tagline').html(list.data('tagline'));
       				
       				var section_id = list.find('a[href]').attr('href');
       				
       				window.location.hash = section_id;
       				
       				$(section_id).show();	
       				
       				
       			};
       			
       			ul.find('li').each(function(){
       				
       				var li = $(this);
       				
       				var tab = $(li.find('a[href]').attr('href'));
       				
       				var ahref = li.find('a[href]');
       				
       				/* hide all the tabs */
       				tab.hide();
       				
       				ahref.click(function(ev){
       					ev.preventDefault();
       					ev.stopPropagation();
       					
       					
       					var old_li = ul.find('li.active');
       					var old_tab = $(old_li.find('a[href]').attr('href'));
       					
       					if(tab.attr('id') != old_tab.attr('id')){
       						old_tab.hide();
       						old_li.removeClass('active');
       						ul.activate(li);
       						
       					}
       					console.log('click');
       				});
       				
       			});
    			console.log('tabs');
    			
    			if(window.location.hash) {
    				var section_id = window.location.hash;
    				ul.activate(ul.find('[href~=' + section_id + ']').closest('li'));
  					console.log(section_id);
  					
  					
  					
				} else {
  					ul.activate(ul.find('li:first'));
  					
				}
    			
    			
    		});
    	};
    	
    	console.log('init');
		$('.bxslider').bxSlider({
  			onSliderLoad: function(){
  				console.log('slider:after-load');
    			
    			$('body').find('[data-behaviour~=rsr-tabs]').rsr_tabs();
    			
    			$('[data-behaviour~=show-video]').click( function(event) {
      				event.preventDefault();
      				$('.videoContainer').fadeIn(200);
    			});
    			
    			
    			$('[data-behaviour~=time-ticker]').rsr_time_ticker();
    			
  			}
		});
    	
    	
    	$('html, body').animate({
        	scrollTop: $("#mainbody").offset().top
    	}, 500);
  					
    	
    	
	}(jQuery));  
	
	

	
	
		
	
</script>