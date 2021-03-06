<?php
DEFINE('BASEURL','http://www.btrtoday.com/btrtoday/');
?><!DOCTYPE html>	
<html>
	<head>
		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	   <link href="//fonts.googleapis.com/css?family=Lato:400|Questrial:400" rel="stylesheet" type="text/css">
	   <link rel="stylesheet" href="<?php echo BASEURL;?>css/normalize.css">
	   <link rel="stylesheet" href="<?php echo BASEURL;?>css/main.css">		

	   <script src="<?php echo BASEURL;?>js/vendor/modernizr-2.6.2.min.js"></script>
		<style>
			#info-progress {
				width:620px;
				padding-left:5px;
				float:left;
			}

			#progress-strip {
				width:434px;
				height:8px;
				border:1px #cfcfcf solid;
				margin-top:7px;
				margin-left:9px;
				background-color: #999;
				position:relative;
				float:left;
			}

			#progress-strip .load-progress {
				position:absolute; top:1px; left:1px;
				width:0;
				height:6px;
				background-color: #767676;
			}

			#progress-strip .play-progress {
				position:absolute; top:0; left:0;
				width:0;
				height:6px;
				background-color: #484848;
				transition: background-color .25s ease-in;
			}

			#progress-strip div.play-progress.buffering {
				background-color:#99bb99;
			}

			#buffering {
				position:absolute; top:20px; left:50px;
				color:#99cc99;
				font-size:14px;
				display:none;
			}

			#time-container {
				float:left;
				margin: 4px 0 0 8px;
				font-size:14px;
			}

			#audcontrols {
				clear:both;
			}

			#audcontrols div {
				cursor:pointer;
			}

			#audcontrols .highlight{
				color:#339933;
			}

			#audio-player{
				background-color: #f0f0f0;
				position:relative;
			}

			#host-image {
				background-color: #000000;
				width:300px;
				height:168px;
				float:left;
			}

			#ep-info {
				margin-top: 13px;
				margin-left:5px;
				padding-bottom:11px;
			}

			#ep-info div.info {
				padding-top:2px;
			}

			#transport {
				float:left;
				width:60px;
				margin-left: 15px;
				padding-left:0;
			}

			#play-pause {
				cursor:pointer;
				width:20px; height:25px; float:left;
				background: url('images/sprite_audio_play_pause.png') 0 0;
			}

			#play-pause.pause {
				background: url('images/sprite_audio_play_pause.png') 0 -25px;
			}

			#transport .transport-sm {
				float:left;
				width:15px;
				height:17px;
				margin-top:4px;
			}

			#track-prev {
				background:url('images/sprite_audio_back_forward.png') 0 0;
				margin-left:4px;
				cursor:pointer;
			}

			#track-next {
				background:url('images/sprite_audio_back_forward.png') -20px 0;
				margin-left: 5px;
				cursor:pointer;
			}

			#program-controls {
				clear:both; 
				margin-top:12px;
				margin-left: 15px;
				float:left;
			}

			#program-controls div, #program-controls a {
				display:block;
				padding-left:14px;
				height:14px;
				float:left;
				margin-right:6px;
				background:url('images/sprite_controls.png') 0 0 no-repeat;
				cursor:pointer;
			}

			#program-controls div span, #program-controls a span {
				transition: all 0.25s;
				display:inline-block;
				text-decoration:none;
				overflow:hidden;
				width:0;
				padding:0;
				font-size:14px;
				line-height:14px;
				color:#66cc33;
			}

			#program-controls div:hover span, #program-controls a:hover span {
				width:auto;
				padding-left:5px;
			}

			#program-controls div#list-social:hover span a {
				padding-left:0;
			}

			#list-social a {
				text-decoration:none;
				display:block;
				width:16px; height:16px;
				background:url('images/sprite_social.png') 0 0 no-repeat;
			}

			#list-social a.google {
				background-position: -21px, 0;
			}

			#list-social a.twitter { 
				background-position: -42px, 0;
			}

			#list-social a.linkedin {
				background-position: -63px, 0;
			}

			#list-social a.tumblr {
				background-position: -84px, 0;
			}

			#list-social a.mail {
				background-position: -105px, 0;
			}

			div#continuous-play {
				background-position: 0 -20px;
			}

			div#continuous-play.highlight{
				background-position: 0 -100px;
			}

			a#list-download {
				background-position: 0 -40px;
			}

			div#list-subscribe {
				background-position: 0 -60px;
			}

			div#list-social {
				background-position: 0 -80px;
			}

			div#pop-out {
				background-position: 0 -120px;
			}

			#subscribe-container {
				width:300px; height:123px;
				padding:15px;
				display:none;
				background-color:#cacaca;
				position:absolute;
				top:20px;
				right:20px;
				z-index:1;
				box-shadow: -6px 3px 5px #888;
			}

			#subscribe-container .close {
				position:absolute;
				top:12px; right:11px;
				cursor:pointer;
			}

			#subscribe-container .title {
				font-weight:bold;
			}

			#subscribe-container .subscribe {
				margin-top:10px;
				display:block;
				float:left;
				text-decoration:none;
				line-height:31px;
				background-color:#666;
				font-weight:normal;
				color:#fff;
				padding-left:10px; padding-right: 10px;
			}

			#subscribe-container p {
				padding-top:10px;
				clear:both;
				font-size:14px;
			}

			#subscribe-container .subscribe-paste {
				margin-top:10px;
				border:1px #000 solid;
				background-color:#fff;
				font-size: 14px;
				padding:1px;
				padding-left:3px;
			}
		</style>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
		<script>
		$(document).ready(function(){
			var utils={
				toSeconds:function(t) { //convert playlist time to seconds
					var a = t.split(':');
					var ln= a.length;
					var s=0;
					for(i=0; i<ln; i++){
						s+= (+a[ln-1-i])*Math.pow(60, i);
					}
					return s;
				},

				secondsFormat:function(t){ //format seconds for display
					var sec_num = parseInt(t, 10); 
				   	var minutes = Math.floor(sec_num  / 60);
				    var seconds = sec_num - (minutes * 60);

				  
				    if (minutes < 10) {minutes = "0"+minutes;}
				    if (seconds < 10) {seconds = "0"+seconds;}
				    var time    = minutes+':'+seconds;
				    return time;
				},

				findPlace: function(d, currTime) { //find place in playlist
					
					var place=0;

					for(pli=0;pli<d.playlist.length;pli++){
						if(currTime < utils.toSeconds(d.playlist[pli].time)){
							place=pli-1;
							break;
						} else place = d.playlist.length-1;

					}
					return place;
				},

				getParameterByName: function(name){ //return Querystring params by name
				  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
				  var regexS = "[\\?&]"+name+"=([^&#]*)";
				  var regex = new RegExp( regexS );
				  var results = regex.exec( window.location.href );
				  if( results == null )
				    return ""; else return decodeURIComponent(results[1].replace(/\+/g, " "));
				}
			}
			
			var progressWidth, loadWidth;

			var playTimeOffset=false;

			var designWidthFactor=432/434;
			
			var player=$('#breakthrough');
			
			function controlAudioPlayer(d) {
				var requestRunning=false;
				var trackOn=0;

				$('#host-image').css("background", "#666666 url(" + d.player_image + ") center no-repeat");
                $("#ep-info .title a").text(d.title);
                $("#ep-info .info .premdate").text(d.premiere_date);
                $("#ep-info .info .series-link").attr("href",d.baseurl + "listen/" + d.series_slug);
                $("#ep-info .info .genre").attr("href",d.baseurl + "listen/" + d.genre_slug);
                $("#ep-info .info .genre").text(d.genre);
				
				var fbShare= encodeURI('http://www.facebook.com/sharer.php?u=' + d.shareurl + '&t=' + d.title + '&ret=login&display=popup');

				var googleShare=encodeURI('https://plus.google.com/share?url=' + d.shareurl);

				var twitterShare=encodeURI('http://twitter.com/home?status='+ d.title + '+' + d.shareurl);

				var lnShare=encodeURI('http://www.linkedin.com/shareArticle?mini=true&url='+ d.shareurl +'&title='+ d.title + '&source=' + 'Music');

				var tumblrShare=encodeURI('http://www.tumblr.com/share?v=3&u=' + d.shareurl + '&t=' + d.title);

				var mailShare=encodeURI('mailto:?subject=Listen to this show on Breakthru Radio!&body=' + d.shareurl);

				$('#list-social a.facebook').attr('href', fbShare);
				$('#list-social a.google').attr('href', googleShare);
				$('#list-social a.twitter').attr('href', twitterShare);
				$('#list-social a.linkedin').attr('href', lnShare);
				$('#list-social a.tumblr').attr('href', tumblrShare);
				$('#list-social a.mail').attr('href', mailShare);
				
				player.attr('src',d.path);
				player.trigger('load');
				$('#track-next').animate({opacity: 1.0}, 250);

				//bindings

				player.bind('loadedmetadata', function(){
					$('#time-container .total').text(utils.secondsFormat(player.prop('duration')));
					
				})

				//deep link offset and url autoplay
				player.bind('canplay', function(){
					console.log("echo");
					if(utils.getParameterByName('t') && !playTimeOffset) {
				  		player.prop('currentTime', (utils.getParameterByName('t')));
				  		playTimeOffset=true;
				  	}
				  	if(window.location.href.indexOf('?playshow')!=-1 || window.location.href.indexOf('&playshow')!=-1) player.trigger('play'); 
				})

				player.bind('play', function(){
					$('#play-pause').addClass('pause');
					$('#track-prev').animate({opacity: 1}, 250);
					$('#track-next').animate({opacity: 1}, 250);
					
				});

				player.bind('pause', function(){
					$('#play-pause').removeClass('pause');
				});

				player.bind('waiting', function(){
					$('.play-progress').addClass('buffering');
					$('#buffering').fadeIn(250);
				})

				player.bind('playing', function(){
					$('.play-progress').removeClass('buffering');
					$('#buffering').stop().fadeOut(50);
					$('#track-next').bind('click');

				})

				//progress bar and time display
				player.on('timeupdate', function() {
					loadWidth=this.buffered.end(0)/this.duration * $('#progress-strip').width()*designWidthFactor;
			  		$('.load-progress').width(loadWidth);

			  		progressWidth=this.currentTime/this.duration * $('#progress-strip').width()*designWidthFactor;
			  		$('.play-progress').width(progressWidth);
			  		
			  		$('#time-container .current').text(utils.secondsFormat(this.currentTime));

			  		if($(this).prop('currentTime')==$(this).prop('duration')) $('#track-next').animate({opacity: 0.33}, 250);

			  		if(this.currentTime==this.duration && $('#continuous-play').hasClass('highlight')) { 
			  			if(requestRunning) return;
			  			player.trigger('pause');
						player.prop("currentTime",0);
						$('.play-progress').width(0);
						requestRunning=true;
			  			playList(d.next.blog_id, d.next.post_id);
			  		}
				});

				//transport controls
				$('#play-pause').unbind().click(function(){
					if(player.prop('paused')) {
						player.trigger('play');
						$(this).addClass('pause');
					} else {
						player.trigger('pause');
						$(this).removeClass('pause');
					}
				});
			
				$('#pause-audio').click(function(){
					player.trigger('pause');
				});

				$('#track-prev').unbind().click(function(){
					$('#track-next').animate({opacity: 1}, 250);

					var trackOn = utils.findPlace(d, player.prop('currentTime'));
					if(trackOn>0) {
						trackOn--;
						player.prop('currentTime', utils.toSeconds(d.playlist[trackOn].time ));
					} else if(trackOn==0) {
						player.prop('currentTime', 0);
						if(player.prop('paused')) $('#track-prev').click(false).animate({opacity: 0.33}, 250);

					}
					else return;
					
				});
				
				$('#track-next').unbind().click(function(){
					if(!$('.play-progress').hasClass('buffering')){
						$('#track-prev').animate({opacity: 1}, 250);
						if(player.prop('currentTime')==player.prop('duration')) return;
						trackOn = utils.findPlace(d, player.prop('currentTime'));

						if(trackOn<(d.playlist.length-2)) {
							trackOn++;
							player.prop('currentTime', utils.toSeconds(d.playlist[trackOn].time ));
						} 
						else if(trackOn==(d.playlist.length-2)){
							trackOn++
							player.prop('currentTime', player.prop('duration'));
							$('#track-next').click(false).animate({opacity: 0.33}, 250);
						}
						else return;						
					}
				});	

				//program controls
				$('#continuous-play').unbind().click(function(){
					$(this).toggleClass('highlight');					
				});
			
				$('#list-next').unbind().click(function() {
					if(requestRunning) return;
					player.trigger('pause');
					player.prop("currentTime",0);
					$('.play-progress').width(0);
					requestRunning=true;
					var nextBlogId=d.next.blog_id;
					var nextPostId=d.next.post_id;
					playList(nextBlogId, nextPostId);
					return false;
				});


				$('#list-download').attr('href', d.path);

				$('#list-subscribe').unbind().click(function(){
					$('#subscribe-container').show(250);
				});

				$('#subscribe-container .close').unbind().click(function(){
					$('#subscribe-container').hide(250);
				})

				$('#subscribe-container a').attr('href', 'itpc://breakthruradio.com/xml/podcast.php?dj_id=' + d.blog_id);
				$('#subscribe-container .subscribe-paste').text('http://breakthruradio.com/xml/podcast.php?dj_id=' + d.blog_id);
				
				$('#pop-out').unbind().click(function(){
					player.trigger('pause');
					url = location.protocol + '//' + location.host + location.pathname +
					      "?blog_id=" + utils.getParameterByName('blog_id') +
						  "&post_id=" + utils.getParameterByName('post_id') +
						  "&t=" + player.prop('currentTime') +
						  "&playshow"
					win = window.open(url,'player','location=no,menubar=no,titlebar=no,width=940,height=168,top=150,left=150');
				});
			}

        	function playList (blogId, postId) {
        		$.ajax({
	                url: 'http://www.breakthruradio.com/xml/playShow-json.php?blog_id=' + blogId + '&post_id=' + postId,
	                dataType: 'json',
	                success: function( data ) {
	                	controlAudioPlayer(data);
	            	},
	            	complete: function() {
			            requestRunning = false;
			        }
	        	});
        	}

        	playList($("body").attr('data-blog-id'),$("body").attr('data-post-id')); //replace with call from lower page
		});
		</script>

	</head>
	<body class="btr-listen btr-playlist" data-baseurl='<?php echo BASEURL;?>' data-blog-id="<?php echo $_GET['blog_id'];?>" data-post-id="<?php echo $_GET['post_id'];?>">
		<div class="content playlist-page" data-date="" data-offset="">
			<div id="audio-player" class="clearfix">
				<div id="subscribe-container" class="clearfix">
					<div class="close">X</div>
					<div class="title">SUBSCRIBE</div>
					<a href="javascript://" class="subscribe">Subscribe using iTunes</a>
					<p>Or, copy and paste this URL into a news reader:</p>
					<div class="subscribe-paste">test</div>
				</div>

				<div id="host-image"></div>

				<audio id="breakthrough">
					<source src="" type="audio/mpeg">
						Your browser does not support the audio element.
				</audio> 
				
				<div id="info-progress" class="clearfix">
					
					<div id="ep-info" class="text-box">
						<div class="title">Episode // <a href="javascript:void(0)"></a></div>
						<div class="info">Premiere Date: <span class="premdate">J</span>&nbsp;|&nbsp;<a class="series-link" href="javascript:void(0)" target="_top">Series Info</a>&nbsp;//&nbsp;Genre: <a class="genre" href="javascript:void(0)" target="_top"></a>&nbsp;|&nbsp;Sponsor: <a href="javascript:void(0)">Nikon</a></div>
					</div>

					<div id="transport" class="clearfix">
						<div id="play-pause"></div>
						<div id="track-prev" class="transport-sm"></div>
						<div id="track-next" class="transport-sm"></div>

					</div>

					<div id="progress-strip">
						<div id="buffering">buffering...</div>
						<div class="load-progress">
							<div class="play-progress"></div>
						</div>
					</div>

					 <div id="time-container">
						<span class="current">00:00</span>&nbsp;/&nbsp;<span class="total">00:00</span>
					</div> 

					<div id="program-controls" class="clearfix">
						 <div id="list-next"><span>Next&nbsp;Show</span></div> 
						 <div id="continuous-play"><span>Continuous&nbsp;Play</span></div>
						 <a id="list-download" href="javascript:void(0);" download><span>Download</span></a>
						 <div id="list-subscribe"><span>Subscribe</span></div>
						 <div id="list-social"><span>
						 	<a href="javascript://" class="facebook" target="_blank"></a>
						 	<a href="javascript://" class="google" target="_blank"></a>
						 	<a href="javascript://" class="twitter" target="_blank"></a>
						 	<a href="javascript://" class="linkedin" target="_blank"></a>
						 	<a href="javascript://" class="tumblr" target="_blank"></a>
						 	<a href="javascript://" class="mail" target="_blank"></a>

						 </span></div>
						 <div id="pop-out"></div>
					</div>
				</div>
			</div>
<!--
			<div id="sponsor-image" style="margin-top:22px;">
		        <a href="http://www.diesel.com/home.php" target="_blank"><img src="<?php echo BASEURL;?>img/fpo-advertisement-940.png"></a>
		    </div>
-->
		</div>

		<script src="<?php echo BASEURL;?>js/plugins.js"></script>
        <script src="<?php echo BASEURL;?>js/main.js"></script>

	</body>
</html>