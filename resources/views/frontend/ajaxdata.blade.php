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
                                </tbody>   
                             </table>
                             </div>