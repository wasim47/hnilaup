@extends('admin.include.master')
	@section('title') Money Receipt List - HNILAUP @endsection
@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header" style="border:none">
                    <h3 class="page-title">View Money Receipt List</h3>
                        <div class="col-sm-4" style="margin:0; padding:0">
                            <ol class="breadcrumb" style="padding:13px;">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li>Settings</li>
                                <li class="active">Money Receipt List</li>
                            </ol>
                        </div>
                        <div class="col-sm-8 breadcrumb pull-right" style="float:right; text-align:right">
                          <a  href="javascript:void()" onclick="permissions('union_information','1');" style="color:#000; margin-right:20px;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a>
                          <a  href="javascript:void()" onclick="permissions('union_information','0');" style="color:#000; margin-right:20px;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a>
                          <a  href="javascript:void()" onclick="deletedata('masterdelete','union_information');" style="color:#fff; margin-right:20px;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a>
                          <a  href="{{ route('receipt.create') }}" style="color:#fff; margin-right:20px" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Money Receipt</a>
                      </div>
                </div>
              @if (session()->has('messageType'))
                  <div class="alert alert-{{ session()->get('messageType') }}" role="alert">
                      <strong>STATUS: </strong> {{ session()->get('message') }}
                  </div>
              @endif
            </div>
             <div class="row-fluid">
                <div class="col-sm-12">
                  <div class="card">

                      <div class="card-block">
                      	<form id="form_check">
                            	<div style="overflow-x:auto; max-width:1024px;">
                                    <table id="responsive-datatable" class="table-striped table-bordered table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                      <th width="4%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                                      <th>অ্যাকশান</th>
                                      <th>দাতার নাম</th>
                                      <th>গ্রহীতার নাম</th>   
                                      <th>গ্রহীতার মোবাইল নং</th>   
                                      <th>উদ্দেশ্য</th>    
                                      <th>টাকার পরিমাণ</th>    
                                      <th>পাঠানোর তারিখ</th>      
                                      <th>মতামত</th>   
                                      
                                  </tr>
                			  </thead>
                               <tbody>
                			<?php $i=0; ?>
                            @foreach($allreceipt as $menu)
                            <?php $i++;
							?>

                            <tr id="tablerow<?php echo $menu->id;?>" class="tablerow">
                              <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $menu->id }}" /></td>
                               <td align="right">
                                  <div style="width:50%; float:left">
                                     <a href="{{ route('receipt.edit', $menu->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a>
                                  </div>
                                  <div style="width:50%; float:left">
                                      <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px"
                                        onclick="deleteSingle('<?php echo $menu->id;?>','masterdelete','union_information')"><i class="fa fa-trash"></i></button>
                                  </div>
                                  <a href="{{ route('receipt.show', $menu->id) }}" class="btn btn-info btn-sm" style="padding:2px 5px; font-size:12px;"><i class="fa fa-file"></i></a>               
                                  <a href="{{ route('receipt.print',$menu->id) }}" class="btn btn-success btn-sm" style="padding:2px 5px; font-size:12px;" target="_blank">
                                    <i class="fa fa-print"></i></a>         
                                     
                              </td>
                                <td>{{ $menu->sender_name }}</td>
                                <td>{{ $menu->receiver_name }}</td>
                                <td>{{ $menu->receiver_contact }}</td>
                                <td>{{ $menu->purpose }}</td>
                                <td>{{ $menu->amount }}</td>
                                <td>{{ $menu->date }}</td>
                                <td>{{ $menu->remark }}</td>                              
                            </tr>
                            @endforeach
            				</tbody>
                      </table>
                      		</div>
                        </form>
                      </div>
                  </div>
                </div>
              </div>
    </div>
</div>
@endsection
