@extends('layouts.app')

@section('title', 'নোটিশ')

@section('sidebar')
    @parent
@endsection

@section('content')      
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
      <main id="main">
            <div class="container">
              
              <div class="row"> 
                <h3 style="margin:20px;">নোটিশ</h3> 
              </div>
              <div id="services">                            
                  <div class="row">                        
                    @foreach($notices as $lnotice)	
                        <div class="col-xs-12 col-sm-6 col-md-4">
                        
                          <div class="box" style="height:400px;">
                                 <a href="{{ route('notice.details',[$lnotice->url]) }}">
                                  <img src="{{ asset('uploads/notice/'.$lnotice->image) }}" alt="{{ $lnotice->name }}"  style="max-height:200px;">                         
                                 </a>   	
                            <h4><a href="{{ route('notice.details',[$lnotice->id]) }}">{!! strip_tags(str_limit($lnotice->name,60)) !!}</a></h4>
                            <p>{!! strip_tags(str_limit($lnotice->details,150)) !!}</p>
                              
                              <a href="{{ route('notice.details',[$lnotice->id]) }}" class="color-link">বিস্তারিত পড়ুন
                                <i class="fa fa-long-arrow-right"></i>
                              </a>
                          </div>
                        </div>   
                    @endforeach                
                  </div>              
                  <div class="row">{{ $notices->links() }}</div>
            </div>
          </div>
      </main>    
@endsection
@section('footer')
    @parent
@endsection