@extends('layouts.app')

@section('title', 'ToonBD')

@section('sidebar')
    @parent
@endsection

@section('content') 
	                    
     <main id="main">

    <section id="about" class="inner-page pt-4">
      <div class="container">
      	@if($articles!="")
        	<p>
              {!! $articles->content !!}
            </p>
        @endif
      </div>
    </section>

  </main> 
            
@endsection


@section('footer')
    @parent
@endsection


