@extends('layouts.app')

@section('title', $notices->name)

@section('sidebar')
    @parent
@endsection

@section('content')    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
      <main id="main">
            <div class="container">
              <div class="row">
                <div class="col-md-8">
                  <article class="post single">
                    <figure class="post-thumbnail">
                      <img src="{{ asset('uploads/notice/'.$notices->image) }}" alt="{{ $notices->name }}" style="width:100%; height:auto">                    
                    </figure>
                    <header class="article-header">
                    	<h2 class="title">{{ ucfirst($notices->name) }}</h2>
                      <a href="#" style="color:#999">প্রকাশিত: {{ date('l , d F Y',strtotime($notices->updated_at)) }}</a>                      
                    </header>
                    
                    <p style="margin-bottom:20px;">{!! $notices->details !!}</p>                    
                    
                  </article>
                </div>
                
                <div class="col-md-4">
                  <div id="services">
                      <div class="box">
                      <header class="section-header">
                          <h3>সকল নোটিশ</h3>
                        </header>
                      	<div class="lists" style="max-height:450px; overflow:auto">
                        <ul>
                        	
                          @foreach($relnotices as $lnotices)	
                          	<li> <a href="{{ route('notice.details',$lnotices->id) }}" style="color:#000">{!! strip_tags(str_limit($lnotices->name,50)) !!}</a></li>
                          @endforeach
                        </ul>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
    </main>             
@endsection
         
@section('footer')
    @parent
@endsection