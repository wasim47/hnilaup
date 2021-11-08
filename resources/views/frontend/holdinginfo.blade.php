@extends('layouts.app')

@section('title', 'Holding Information')

@section('sidebar')
    @parent
@endsection
<style>
@import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css');
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
@section('content')
	 <div id="page" class="page">
          <div class="content-section">
             <div style="float:left">
                  <div class="col-lg-12">                        
                        
                        <div class="row breadcrumb">
                           <div class="col-sm-2">
                          	মোটঃ- <span id="totalvalue">{{ count($unioninformation) }}</span>
                          </div>
                         <div class="col-sm-8">
                                <div style="width:25%; float:left">
                                        <select name="usefulllink_id" id="usefulllink_id" class="form-control" required>
                                            <option value="">সেবা সমূহ</option>
                                            @foreach($links as $link)
                                             <option value="{{ $link->id }}">{{  $link->name  }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div style="width:25%; float:left">
                                	<input type="text" name="holdingno" id="holdingno" class="form-control" placeholder="হোল্ডিং নং" />
                                </div>
                                <div style="width:25%; float:left">
                                	<input type="text" name="wordno" id="wordno" class="form-control" placeholder="ওয়ার্ড নং" />
                                </div>
                                <div style="width:25%; float:left"><button type="button" class="btn btn-primary btn-sm" onclick="ajaxSearch();">অনুসন্ধান করুন</button></div>
                                   
                         </div>
                        </div>  
                        <div class="row"> 
                        	<div id="responsedata">
                            	<div style="overflow-x:auto; width:100%;max-width:1110px;">
                        			<table width="100%" class="table table-bordered table-striped">
                                 <thead>
                                    <tr>          
                                      <th>সচিব</th>
                                      <th>সেবা</th>                            
                                      <th>কর দাতার নাম</th>
                                      <th>পিতা/স্বামীর নাম</th>
                                      <th>গ্রাম</th>
                                      <th>পেশা</th>
                                      <td>এন আইডি নং</td>
                                      <td>জমির পরিমাণ</td>
                                      <th>হোল্ডিং নং</th>
                                      <th>ওয়ার্ড নং</th>
                                      <td>বসত বাড়ির ধরণ</td>
                                      <td>বাৎসরিক কার্য কৃত কর</td>
                                      <td>অর্থ বছর</td>  
                                      <th>অ্যাকশান</th>
                                   </tr>
                                </thead>
                                <tbody>
                                 <?php $i=0; ?>
                                @foreach($unioninformation as $k=>$menu)
                                <?php $i++; 
                                ?>
                                <tr id="tablerow<?php echo $menu->id;?>" class="tablerow">	  
                                    <td>@if($menu->secretaries) {{ $menu->secretaries->fullname }} @endif</td>
                                    <td>@if($menu->usefulllinks) {{ $menu->usefulllinks->name }} @endif</td>                                     
                                    <td>{{ $menu->name }}</td>
                                    <td>{{ $menu->spouse_name }}</td>
                                    <td>{{ $menu->village }}</td>
                                    <td>{{ $menu->profession }}</td>
                                    <td>{{ $menu->nid }}</td>
                                    <td>{{ $menu->land }}</td>
                                    <td>{{ $menu->holding_no }}</td>
                                    <td>{{ $menu->wordno }}</td>
                                    <td>{{ $menu->house_type }}</td>
                                    <td>{{ $menu->yearly_tax }}</td>
                                    <td>{{ $menu->budget_year }}</td>
                                    <td  align="center">                                   
                                    
                                    <a href="javascript:void(0)" class="btn btn-info btn-sm" style="padding:2px 5px; font-size:12px;" title="{{ trans('app.details') }}" 
                                    data-toggle="modal" data-target="#exampleModal{{ $menu->id }}"><i class="fa fa-file"></i></a>                        
                                     <div class="modal fade" id="exampleModal{{ $menu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document" style="max-width:800px!important">
                                        <div class="modal-content">
                                          <div class="modal-header" style="padding:3px;">
                                            <div style="width:100%; height:auto; float:left; ">
                                                <div style="width:100%; height:auto; float:left;">
                                                    <div style="width:50%; height:auto; float:left">
                                                        <h2 class="modal-title" id="exampleModalLabel" style="padding:0; margin:0; text-align:left; font-weight:bold">{{ $menu->name }}</h2>
                                                    </div>
                                                    <div style="width:50%; height:auto; float:left">
                                                    	<a href="{{ route('secretary.printinfo',$menu->id) }}" target="_blank">Print</a>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                </div>                                                
                                            </div>                                          
                                          </div>
                                          <div class="modal-body">
                                              <table width="100%" border="0" class="table-bordered table">
                                                <tr>
                                                    <td>কর দাতার নাম<span style="color:#ff0000; font-size:20px;">*</span></td>            
                                                    <td>{{ $menu->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>পিতা/স্বামীর নাম</td>            
                                                    <td>{{ $menu->spouse_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>গ্রাম</td>            
                                                    <td>{{ $menu->village }}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>পেশা</td>            
                                                    <td>{{ $menu->profession}}</td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <td>এন আইডি নং</td>            
                                                    <td>{{ $menu->nid }}</td>
                                                </tr> 
                                                
                                                <tr>
                                                    <td>হোল্ডিং নং</td>            
                                                    <td>{{ $menu->holding_no }}</td>
                                                </tr>
                                                <tr>
                                                    <td>ওয়ার্ড নং</td>            
                                                    <td>{{ $menu->wordno }}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>জমির পরিমাণ</td>            
                                                    <td>{{ $menu->land }}</td>
                                                </tr>
                                                <tr>
                                                    <td>বসত বাড়ির ধরণ</td>            
                                                    <td>{{ $menu->house_type }}</td>
                                                </tr>
                                                <tr>
                                                    <td>বাৎসরিক কার্য কৃত কর</td>            
                                                    <td>{{ $menu->yearly_tax }}</td>
                                                </tr>
                                                <tr>
                                                    <td>অর্থ বছর</td>            
                                                    <td>{{ $menu->budget_year }}</td>
                                                </tr>
                                                <tr>
                                                    <td>মন্তব্য</td>            
                                                    <td>{{ $menu->remark }}</td>
                                                </tr>
                                                </table>
                                          </div>
                                          
                                        </div>
                                      </div>
                                    </div>
                                   
                                    <a href="{{ route('secretary.printinfo',$menu->id) }}" class="btn btn-success btn-sm" style="padding:2px 5px; font-size:12px;" target="_blank">
                                    <i class="fa fa-print"></i></a>                                               
                                   </td>
                                </tr>
                                 
                                @endforeach
                                 <tr><td colspan="14">{{ $unioninformation->links() }}</td></tr>
                                </tbody>   
                             </table>
                             	</div>
                            </div>
                       </div>
                  </div>                  
                </div>
    	  </div>
  	</div>
@endsection


@section('footer')
    @parent
@endsection

<script>
function ajaxSearch()
{
	 var holdingno = $("#holdingno").val();
	  var wordno = $("#wordno").val();
	  var usefulllink_id = $("#usefulllink_id").val();
	  var surl = '{{ route("frontend.ajaxsearch") }}';
	  $.ajax({
		type: "GET",
		url: surl,
		data: {'holdingno':holdingno,'wordno':wordno,'usefulllink_id':usefulllink_id},

		cache: false,
		beforeSend: function(){
			$('#LoadingImageE').show();
		},
		complete: function(){
			$('#LoadingImageE').hide();
		},
		success: function(response) {
			  $('#responsedata').html(response);
			  $("#LoadingImageE").hide();
		},
		error: function (xhr, status) {
		  $("#LoadingImageE").hide();
		  alert('Unknown error ' + status);
		}
	  });
}
</script>