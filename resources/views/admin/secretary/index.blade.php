 @extends('admin.include.master') 
	@section('title') Secretary User List - BD-ICU @endsection 
@section('content')

 
	<div class="layout-content">
        <div class="layout-content-body">
        	<div class="col-sm-12">
                <div class="page-header" style="border:none">
                    <h3 class="page-title">View Secretary List</h3>
                        <div class="col-sm-6" style="margin:0; padding:0">
                            <ol class="breadcrumb" style="padding:13px;">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="active">Secretary  List</li>
                            </ol>
                        </div>
                        <div class="col-sm-6 breadcrumb pull-right" style="float:right; text-align:right">
                          <a  href="javascript:void()" onclick="permissions('secretary','1','status');" style="color:#000; margin-right:5px;" 
                          class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approved</a>
                          <a  href="javascript:void()" onclick="permissions('secretary','0','status');" style="color:#000; margin-right:5px;" 
                          class="btn btn-warning btn-sm"><i class="fa fa-times"></i> Disapproved</a>
                          <a  href="javascript:void()" onclick="deletedata('masterdelete','secretary');" style="color:#fff; margin-right:5px;" 
                          class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Multiple Delete</a>
                          <a  href="{{ route('secretary.create') }}" style="color:#fff; margin-right:0" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Secretary</a>
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
                            <table width="100%" class="table table-bordered table-striped">
                 	 <thead>
                        <tr>
                          <th width="2%"><input name="checkbox" onclick='checkedAll();' type="checkbox" readonly="readonly" /></th>
                          <th width="5%" height="22">SI</th>
                          <th width="17%">Secretary Name</th>
                          <th width="17%">Photo</th>
                          <th width="16%">Email</th>
                          <th width="13%">Contact</th>
                          <th width="15%">Designation</th>
                          <th width="5%">Status</th>
                          <th width="10%">Action</th>
                       </tr>
                    </thead>
                    <tbody>
                     <?php $i=0; ?>
                    @foreach($secretaryuser as $k=>$menu)
					<?php $i++; 
					
					if($menu->status!="" && $menu->status==1){
						$statusdis = '<span style="background:#006600; padding:3px 5px; border-radius:5px; margin:2px;float:left; font-size:12px;text-align:center">
						<i class="fa fa-check"></i> </span>';
					}
					else{
						$statusdis = '<span style="background:#D91021; padding:3px 5px; border-radius:5px; margin:2px;float:left; font-size:12px;text-align:center">
						<i class="fa fa-times"></i> </span>';
					}
					?>
                    <tr id="tablerow<?php echo $menu->id;?>" class="tablerow">	
                    	<td><input type="checkbox"  name="summe_code[]" id="summe_code<?php echo $i; ?>" value="{{ $menu->id }}" /></td>
                    	<td>{{ $i }}</td>
                        <td>{{ $menu->fullname }}</td>
                        <td>@if($menu->photo!="") <img src="{{ asset('uploads/secretary/'.$menu->photo) }}" style="width:100px; height:auto" /> @endif</td>
                      	<td>{{ $menu->email }}</td>
                        <td>{{ $menu->contact }}</td>
                        <td>{{ $menu->designation }}</td>
                        <td width="5%" align="center" valign="top"><?php echo $statusdis; ?></td>
                        <td  align="center">
                        
                        
                        <a href="{{ route('secretary.show', $menu->id) }}" class="btn btn-info btn-xs" style="font-size: 12px; float:left; margin-right:5px;" title="Details">
                        <i class="fa fa-file"></i></a>
                        <a href="{{ route('secretary.edit', $menu->id) }}" class="btn btn-warning btn-xs" style="font-size: 12px; float:left; margin-right:5px;" title="Edit">
                        <i class="fa fa-edit"></i></a>
                        <button type="button" class="btn btn-danger btn-xs" style="font-size: 12px; float:left;"
                                    onclick="deleteSingle('<?php echo $menu->id;?>','masterdelete','secretary')"><i class="fa fa-trash"></i></button>
                                    
                                    
                       </td>
                    </tr>
                     
                	@endforeach
                     <tr><td colspan="10">{{ $secretaryuser->links() }}</td></tr>
                    </tbody>   
                 </table> 
                        </form>
                      </div>
                  </div>
                </div>  
              </div>
    </div>
</div>
@endsection
