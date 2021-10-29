 @extends('admin.include.master') 
	@section('title') Details for [{{ $secretaryinfo->fullname }}] | Officer - BD-ICU @endsection 
@section('content')

 
	<div class="layout-content">
        <div class="layout-content-body">
          <div class="x_title">
                  <h2>Details for {{ $secretaryinfo->fullname }}</h2>
                 
                  <div class="clearfix"></div>
                </div>
          <div class="x_content">
          	<div class="col-sm-12" id="firststep">
                      <div class="col-sm-8 col-sm-offset-2">
                            <table width="100%" border="1" class="table" style="margin-top:30px;">
                                <tr>
                                <td width="24%">{{ __('Fullname') }}</td>            
                                <td width="76%">{{ $secretaryinfo->fullname }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Contact') }}</label>            
                                <td>{{ $secretaryinfo->contact }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Email') }}</label>            
                                <td>{{ $secretaryinfo->email }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Designation') }}</label>            
                                <td>{{ $secretaryinfo->designation }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Address') }}</label>            
                                <td>{{ $secretaryinfo->address }}</td>
                            </tr>
                            
                            <tr>
                                <td>{{ __('Photo') }}</label>            
                                <td>
                                    @if($secretaryinfo->photo!="") <img src="{{ asset('uploads/secretary/'.$secretaryinfo->photo) }}" style="width:100px; height:auto" /> @endif
                                </td>
                            </tr>
                            </table>
                        </div>         
                    </div>
		  </div>

     
    </div>
</div>
@endsection
