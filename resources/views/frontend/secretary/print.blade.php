<style>
body {
	  background: #ddd; 
	  text-align:center;
	  margin:auto;
	}
	page {
		background: #fff;
		display: block;
		margin: 0 auto;
		margin-bottom: 0.5cm;
		box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
		width:21cm;
	}
	page[size="A4"] {
		width:21cm;
		height:21cm;
	}
	page[size="A4"][layout="portrait"] {
		width:21cm;
		height:21cm;
	}
	page[size="A3"][layout="portrait"] {
		 width: 42cm;
		 height: 29.7cm;
	 }
	 page[size="A5"] {
		 width: 14.8cm;
		 height: 21cm;
	 }
	 page[size="A5"][layout="portrait"] {
		 width: 21cm;
		 height: 14.8cm;
	 }
	 @media print {
		 body, page {
			 margin: 0;
			 box-shadow: none;
		 }
	 }
</style>
<link href="{{ asset('assets/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<body>
<page size="A4" layout="portrait">
    <div style="width:100%; height:auto;page-break-before: auto; page-break-after: auto">
    	<div class="col-sm-4 offset-5">
            <img src="{{ asset('assets/img/logo.png') }}" style="width:100px; height:auto">
        </div>
		<table width="100%" border="0" class="table-bordered table">
    <tr>
        <td>কর দাতার নাম<span style="color:#ff0000; font-size:20px;">*</span></td>            
        <td>{{ $userinfo->name }}</td>
    </tr>
    <tr>
        <td>পিতা/স্বামীর নাম</td>            
        <td>{{ $userinfo->spouse_name }}</td>
    </tr>
    <tr>
        <td>গ্রাম</td>            
        <td>{{ $userinfo->village }}</td>
    </tr>
    
    <tr>
        <td>পেশা</td>            
        <td>{{ $userinfo->profession}}</td>
    </tr>
    
    
    <tr>
        <td>এন আইডি নং</td>            
        <td>{{ $userinfo->nid }}</td>
    </tr> 
    
    <tr>
        <td>হোল্ডিং নং</td>            
        <td>{{ $userinfo->holding_no }}</td>
    </tr>
    
    <tr>
        <td>জমির পরিমাণ</td>            
        <td>{{ $userinfo->land }}</td>
    </tr>
    <tr>
        <td>বসত বাড়ির ধরণ</td>            
        <td>{{ $userinfo->house_type }}</td>
    </tr>
    <tr>
        <td>বাৎসরিক কার্য কৃত কর</td>            
        <td>{{ $userinfo->yearly_tax }}</td>
    </tr>
    <tr>
        <td>অর্থ বছর</td>            
        <td>{{ $userinfo->budget_year }}</td>
    </tr>
    <tr>
        <td>মন্তব্য</td>            
        <td>{{ $userinfo->remark }}</td>
    </tr>
    </table>
    </div>
</page>
</body>
<script type="text/javascript">
	window.print();
</script> 