@extends('layouts.app')
@section('seodetails')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
@endsection

@section('title', 'হ্নীলা ইউনিয়ন পরিষদ')
@section('content')
  
  <main id="main">
    
      <section>
      	<div class="row">
        	<div class="col-lg-3 col-md-3 col-sm-12">            	
            		<div id="services">
                    @if($charmanmessage!="")
                    	<div class="box">                          	            	
                            <header class="section-header">
                              <h3>{{ $charmanmessage->designation }}</h3>
                            </header>
                            <center>
                                <img src="{{ asset('uploads/management/'.$charmanmessage->image ) }}" alt="{{ $charmanmessage->name }}" />
                                <h4>{{ $charmanmessage->name }}</h4>
                            </center>                        
                            <p>{!! strip_tags(str_limit($charmanmessage->details,170)) !!}</p>   
                            <a href="{{ route('management.details',$charmanmessage->id) }}">বিস্তারিত দেখুন</a>                     
                        </div>
                    @endif
                    @if(count($members) > 0)
                    	<div class="box">
                        <header class="section-header">
                          <h3>ইউপি সদস্যবৃন্দ</h3>
                        </header>
                    	<div class="lists">
                        	<ul>
                            	@foreach($members as $member)
                            		<li>
                                        <a href="{{ route('employee.details', $member->id) }}">
                                        	<div class="row" style="padding:0 10px">
                                                <div class="col-sm-3" style="margin:0; padding:0"><img src="{{ asset('uploads/employee/'.$member->image ) }}" alt="{{ $member->name }}" /></div>
                                                <div class="col-sm-9" style="margin:0; padding:0">
                                                    <div class="name">{{ $member->name }}</div>
                                                    <div class="designation">{{ $member->designation }}</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('members') }}">তালিকা দেখুন</a>
                        </div>
                    </div>
                    @endif
                    
                      <div class="box">
                    	<header class="section-header">
                           <h3>ক্যালেন্ডার</h3>
                        </header>
                        <div>@include('frontend.calander')</div> 
                            
                                                	
                    </div>
                    <div class="box" style="border-bottom-right-radius:0 !important; border-bottom-left-radius:0 !important;">
                    	<header class="section-header">
                           <h3>লোকেশন</h3>
                        </header>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d237582.48799368768!2d91.89988194370655!3d21.4988512680574!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30adb8fa1791ba93%3A0xda17ade5ac2001a8!2sCox&#39;s%20Bazar%20Sadar%20Upazila!5e0!3m2!1sen!2sbd!4v1635981451204!5m2!1sen!2sbd" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe> 
                            
                                                	
                    </div>
                </div>
                
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12" style="padding:0">
            	<section> 
                   <div style="float:left; width:100%; padding:0">              
                        <div class="amazingslider-wrapper" id="amazingslider-wrapper-1" style="display:block;position:relative;max-width:100%;margin:0px auto 80px; padding:0">
                            <div class="amazingslider" id="amazingslider-1" style="display:block;position:relative;margin:0 auto; padding:0">
                                <ul class="amazingslider-slides" style="display:none; padding:0">                        
                                    @foreach($banners as $banner)
                                        <li><img src="{{ asset('uploads/banner/'.$banner->image)}}" alt="{{ $banner->name }}"  title="{{ $banner->name }}" /></li>
                                    @endforeach
                                </ul>
                                <ul class="amazingslider-thumbnails" style="display:none;">
                                    @foreach($banners as $banner)
                                        <li><img src="{{ asset('uploads/banner/'.$banner->image)}}" alt="{{ $banner->name }}"  title="{{ $banner->name }}" /></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                   </div>
                </section>
            	<div id="services">
                    <div class="box">    
                    	<header class="section-header">
                          <h3> আমাদের সেবা সমূহ </h3>
                        </header>
                        <div class="grid">
                        	<ul>
                            	@foreach($usefulllinks as $links)
                                	@php
                                    	if($links->type =='url'){
                                    		$urls = $links->links;
                                        }
                                        else{
                                        	//$urls = route('secretary.profile',['linksid'=>$links->id]);
                                            $urls = route('holdinginfo',['linksid'=>$links->id]);
                                        }
                                    @endphp
                            		<li>
                                    <a href="{{ $urls }}">
                                        <img src="{{ asset('uploads/links/'.$links->image) }}" />
                                        <h4 class="name">{{ $links->name }}</h4>
                                    </a></li>
                                @endforeach
                            </ul>
                        </div>
                        
                        
                    </div>
                                        
                    @if(count($generalnotices) > 0)
                    	<div class="box">                    	
                        <header class="section-header">
                          <h3> নোটিশ বোর্ড</h3>
                        </header>
                        <div class="lists">
                        	<marquee scrollamount="3" scrolldelay="10" direction="up" loop="-1" height="100%" behavior="scroll" id="marque_common"
                            onmouseover="document.getElementById('marque_common').stop();" onmouseout="document.getElementById('marque_common').start();">
                        	<ul>
                            	@foreach($generalnotices as $notice)
                            		<li><a href="{{ route('notice.details', $notice->id) }}">{{ $notice->name }}</a></li>
                                @endforeach
                            </ul>
                            </marquee>
                        </div>
                    </div>
                    @endif
                    
                    <div class="box">    
                    	<header class="section-header">
                          <h3> ভিডিও গ্যালারী</h3>
                        </header>
                        <div class="row">
                            @if($videogalleries!="")
                                <?php $i=0; ?>
                                @foreach($videogalleries as $video)
                                <?php
									$i++;
									$videoImagePath = asset('uploads/video/'.$video->cover);			
									if($video->cover!=""){
										$coverImage = $videoImagePath;
									}
									else{
									  $coverImage = asset('assets/front/images/defaultlogo.png');	
									}
								?>
                                    <div class="col-sm-4" style="margin:0; padding:0 5px">
                                    <div style="margin:5px; float:left; width:100%; padding:0; height:100px;box-shadow:#ccc 0 0 2px 2px;">                                                 
                                       <a  class="youtube" href='https://www.youtube.com/embed/{{ $video->video_ref }}?rel=0&amp;wmode=transparent'>
                                            <img src="{{ $coverImage }}" style="width:100%; height:100%;"  title="{{ $video->video_title }}" alt="{{ $video->video_title }}"/>
                                       </a>    
                                     </div>
                					</div>
                                 @endforeach
                            @endif
                </div>
                        
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
            	<div id="services">
                     @if($ministrymessage!="")
                    	<div class="box">                    	
                        <header class="section-header">
                          <h3>{{ $ministrymessage->designation }}</h3>
                        </header>
                        <center>
                        	<img src="{{ asset('uploads/management/'.$ministrymessage->image ) }}" alt="{{ $ministrymessage->name }}" />
                            <h4>{{ $ministrymessage->name }}</h4>
                        </center>
                        
                        <p>{!! strip_tags(str_limit($ministrymessage->details,150)) !!}</p>   
                        <a href="{{ route('management.details',$ministrymessage->id) }}">বিস্তারিত দেখুন</a>                     
                    </div>
                    @endif
                    
                     @if(count($noticetype) > 0)
                     	@foreach($noticetype as $noticet)  
                        	
                            <div class="box">                    	
                            <header class="section-header">
                              <h3>{{ $noticet->name }}</h3>
                            </header>
                            <div class="lists" style="max-height:250px; overflow:auto">
                                <!--<marquee scrollamount="2" scrolldelay="2" direction="up" behavior="scroll" id="marque{{ $noticet->id }}"
                                onmouseover="document.getElementById('marque{{ $noticet->id }}').stop();" onmouseout="document.getElementById('marque{{ $noticet->id }}').start();">-->
                                <ul>
                                    @foreach($noticet->items  as $notice)
                                        <li><a href="{{ route('notice.details', $notice->id) }}">{{ $notice->name }}</a></li>
                                    @endforeach
                                </ul>
                                <!--</marquee>-->
                            </div>
                        </div>
                        @endforeach
                    @endif
                    
                    <div class="box">
                    	<header class="section-header">
                              <h3>জাতীয় সঙ্গীত</h3>
                            </header>
                            
                            
                            <div id="amazingaudioplayer-1" style="display:block;position:relative;width:100%;max-width:300px;height:300px;margin:0px auto 0px;">
                            <ul class="amazingaudioplayer-audios" style="display:none;">
                                <li data-artist="" data-title="music-glitch-squid-game-way-back-then-55389" data-album="" data-info="" data-image="{{ asset('assets/audioplayerengine/audios/flag.gif') }}" data-duration="55">
                                    <div class="amazingaudioplayer-source" data-src="{{ asset('assets/audioplayerengine/audios/Amar_Shonar_Bangla_instrumental.ogg') }}" 
                                    data-type="audio/mpeg" ></div>
                                </li>
                            </ul>
                            <div class="amazingaudioplayer-engine"><a href="http://amazingaudioplayer.com" title="jquery music player">html5 music player</a></div>
                        </div>                    	
                    </div>
                </div>
                
            </div>
        </div>
      </section>  
        
    

  </main>
@endsection

@section('footer')
    @parent
    
<script src="{{ asset('assets/amazingslider_thumbnail/amazingslider.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/amazingslider_thumbnail/amazingslider-1.css') }}">
<script src="{{ asset('assets/amazingslider_thumbnail/initslider-1.js') }}"></script>

<script src="{{ asset('assets/audioplayerengine/amazingaudioplayer.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/audioplayerengine/initaudioplayer-1.css') }}">
<script src="{{ asset('assets/audioplayerengine/initaudioplayer-1.js') }}"></script>

 <link rel="stylesheet" href="{{ asset('assets/colorbox/colorbox.css') }}" />
<script src="{{ asset('assets/colorbox/jquery.colorbox.js') }}"></script>
<script>
	(function($) {
		$(".youtube").colorbox({iframe:true, width:"80%", height:"80%"});
	})(jQuery);
</script>
@endsection	