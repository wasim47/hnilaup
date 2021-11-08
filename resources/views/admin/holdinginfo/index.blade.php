@extends('admin.include.master')
	@section('title') Holding Info List - HNILAUP @endsection
@section('content')
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header" style="border:none">
                    <h3 class="page-title">View Holding Info List</h3>
                        <div class="col-sm-3" style="margin:0; padding:0">
                            <ol class="breadcrumb" style="padding:13px;">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li>Holding Info</li>
                            </ol>
                        </div>
                        <div class="col-sm-9 breadcrumb" style="float:right; text-align:right">
                          <span style="margin-right:10px; font-size:15px">Total: {{ count($allholdinginfo) }}</span>
                          <a  href="javascript:void()" onclick="permissions('union_information','1');" style="color:#000; margin-right:0;" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a>
                          <a  href="javascript:void()" onclick="permissions('union_information','0');" style="color:#000; margin-right:0;" class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a>
                          <a  href="javascript:void()" onclick="deletedata('masterdelete','union_information');" style="color:#fff; margin-right:0;" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a>
                          <a  href="{{ route('holdinginfo.create') }}" style="color:#fff; margin-right:0" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create New Holding Info</a>
                          <a href="{{ route('holding.export') }}" class="btn btn-success btn-sm" style="color:#fff"><i class="fa fa-download"></i> Export</a>
                          <a href="javascript:void(0)" class="btn btn-info	 btn-sm" style="color:#fff" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-upload"></i> Import</a>
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
                                      
                                  </tr>
                			  </thead>
                               <tbody>
                			<?php $i=0; ?>
                            @foreach($allholdinginfo as $menu)
                            <?php $i++;
							?>

                            <tr id="tablerow<?php echo $menu->id;?>" class="tablerow">
                              <td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $menu->id }}" /></td>
                               <td align="right">
                                  <div style="width:50%; float:left">
                                     <a href="{{ route('holdinginfo.edit', $menu->id) }}" class="btn btn-warning" style="font-size: 12px; float:left; padding:3px 5px"><i class="fa fa-edit"></i></a>
                                  </div>
                                  <div style="width:50%; float:left">
                                      <button type="button" class="btn btn-danger" style="font-size: 12px; float:left; padding:3px 5px"
                                        onclick="deleteSingle('<?php echo $menu->id;?>','masterdelete','union_information')"><i class="fa fa-trash"></i></button>
                                  </div>
                                  <a href="{{ route('holdinginfo.show', $menu->id) }}" class="btn btn-info btn-sm" style="padding:2px 5px; font-size:12px;"><i class="fa fa-file"></i></a>               
                                  <a href="{{ route('secretary.printinfo',$menu->id) }}" class="btn btn-success btn-sm" style="padding:2px 5px; font-size:12px;" target="_blank">
                                    <i class="fa fa-print"></i></a>         
                                     
                              </td>
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


<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle" style="color:#333; width:50%; float:left">Bulk Import </h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style=" width:50%; float:right">X</button>
      </div>
      <div class="modal-body">
           <div class="row">
                <div class="col-sm-4">
                	<label style="color:#333">Download excel format</label>
                    <a href="{{ route('holding.samplefiledownload') }}" class="btn btn-warning">Click here to download</a>
                </div>
                <div class="col-sm-8">
                	<label style="color:#333">Choose your excel file</label>
                    <form method="post" action="{{ route('holding.import') }}" enctype="multipart/form-data">
                    	{{ csrf_field() }}
                        <div class="col-sm-8">
                        	<input type="file" name="importfile" class="form-control" />
                            <small style="color:#FF0000">
                            	ডাটা ইম্পর্ট করার পুর্বে অবশ্যই সেক্রেটারি নাম ও সেবার নাম আগে থেকে ডাটাবেজ এ প্রবেশ করাতে হবে।
                            </small>
                            
                        </div>
                        <div class="col-sm-4"><button type="submit" class="btn btn-info">Upload</button></div>
                    </form>
                </div>
            </div>
      </div>
    </div>
  </div>
</div>
@endsection
