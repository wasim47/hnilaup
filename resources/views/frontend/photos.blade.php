@extends('layouts.app')

@section('title', 'ফটো গ্যালারী')

@section('sidebar')
    @parent
@endsection
<style>
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css');
</style>
@section('content')
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
	<main id="main">
    	 
         <section id="services" class="section-bg">
         	<div class="container">
             <div class="col-sm-12" style=" float:left; margin:20px 0;"><h2>ফটো গ্যালারী</h2></div>
          </div>
          
          
              <div class="container">
                <div class="row">
                        @if($photos!="")
                            <?php $i=0; ?>
                            @foreach($photos as $photo)
                            <?php
                                $i++;
                                $photoImagePath = asset('uploads/photogallery/'.$photo->image);			
                                if($photo->image!=""){
                                    $coverImage = $photoImagePath;
                                }
                                else{
                                  $coverImage = asset('assets/front/images/defaultlogo.png');	
                                }
                            ?>
                                <div class="col-sm-4">
                                <div style="margin:10px; float:left; width:100%; padding:0; height:200px;box-shadow:#ccc 0 0 2px 2px;">                                                 
                                   <a  class="youtube" href='{{ $coverImage }}'>
                                       <img src="{{ $coverImage }}" style="width:100%; height:100%;" title="{{ $photo->name }}" alt="{{ $photo->name }}" />
                                   </a>  
                                 </div>
                                </div>
                             @endforeach
                        @endif
                </div>
              </div>
    	  </section>
     </main>
@endsection


@section('footer')
    @parent
    
  <link rel="stylesheet" href="{{ asset('assets/colorbox/colorbox.css') }}" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script src="{{ asset('assets/colorbox/jquery.colorbox.js') }}"></script>
<script>
	(function($) {
		//$(".youtube").colorbox({photo:true, width:"80%", height:"80%"});
		$(".youtube").colorbox({rel: 'gal', width:"90%", height:"90%", title: function(){
		  var url = $(this).attr('href');
		  return '<a href="' + url + '" target="_blank">Click here full view</a>';
		}});

	})(jQuery);
</script>
@endsection
