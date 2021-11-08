<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Money Receipt</title>
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
	  text-align:center;
	}
	page[size="A4"] {
		width:21cm;
	  text-align:center;
		height:21cm;
	}
	page[size="A4"][layout="portrait"] {
		width:21cm;
		height:21cm;
	  text-align:center;
	}
	page[size="A3"][layout="portrait"] {
		 width: 42cm;
		 height: 29.7cm;
	  text-align:center;
	 }
	 page[size="A5"] {
		 width: 14.8cm;
		 height: 21cm;
	  text-align:center;
	 }
	 page[size="A5"][layout="portrait"] {
		 width: 21cm;
		 height: 14.8cm;
	  text-align:center;
	 }
	 @media print {
		 body, page {
			 margin: 0;
			 box-shadow: none;
		 }
	 }
	 .customtable td{
		border:none !important; 
		padding:7px !important;
		font-size:13px;
	 }
</style>
<link href="{{ asset('assets/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<page size="A4" layout="portrait">
    <div style="width:100%; height:auto;page-break-before: auto; page-break-after: auto">
        
        
        <table width="100%" border="0" class="customtable">
        	<tr>
            	<td align="left"><img src="{{ asset('assets/img/logo.png') }}" style="width:80px; height:auto"></td>
                <td align="center">
                <h4 style="border:2px solid #333; padding:2px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; border-radius:10px; margin-top:10px; width:200px;">Money Receipt</h4></td>
                <td align="right">হ্নীলা ইউনিয়ন পরিষদ <br /> কক্সবাজার</td>
            </tr>
            
			<tr>
            	<td colspan="3" style="border:none">
                	<table width="100%" border="0" class="customtable">
                    	<tr>
                        	<td align="left" colspan="2"  valign="bottom">Memo <span style="border-bottom:1px dotted #333; font-weight:bold">{{ $receipt->memo }}</span></td>
                            <td align="right" colspan="2"  valign="bottom">Date: <span style="border-bottom:1px dotted #333; font-weight:bold">{{ date('d/m/Y',strtotime($receipt->date)) }}</span></td>
                      </tr>
                        <tr>
                        	<td align="left" colspan="2"  valign="bottom">Received with thanks from</td>
                            <td align="left" colspan="2"   valign="bottom" style="border-bottom:1px dotted #333 !important;"><span style="font-weight:bold">{{ $receipt->receiver_name }}</span></td>
                        </tr>
                        <tr>
                        	<td align="left" colspan="2"  valign="bottom">Amount in word</td>
                            <td align="left" colspan="2"  valign="bottom" style="border-bottom:1px dotted #333 !important;"><span style="font-weight:bold">{{ $receipt->amount_in_word }}</span></td>
                        </tr>
                        <tr>
                        	<td width="8%" align="left"  valign="bottom">By</td>
                          <td width="22%" align="left"  valign="bottom" style="border-bottom:1px dotted #333 !important;"><span style="font-weight:bold">{{ $receipt->paymenttype }}</span></td>
                          <td width="9%" align="left"  valign="bottom">Contact</td>
                          <td width="61%" align="left"  valign="bottom" style="border-bottom:1px dotted #333 !important;"><span style="font-weight:bold">{{ $receipt->receiver_contact }}</span></td>
                      </tr>
                        <tr>
                        	<td align="left" colspan="2">For the purpose of</td>
                            <td align="left" colspan="2" style="border-bottom:1px dotted #333 !important;"><span style="font-weight:bold">{{ $receipt->purpose }}</span></td>
                        </tr>
                        <tr>
                        	<td align="left">Amount</td>
                            <td align="left">
                            <h6 style="border:2px solid #333; padding:0px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; width:80px; text-align:center; margin-top:10px;">
                            {{ $receipt->amount }}</h6>
                            </td>
                        </tr>
                        <tr align="center"  style="border-bottom:1px dashed #333">
                        	<td align="center" colspan="2"  valign="bottom"><div  style="border-top:2px solid #333; width:120px; margin-top:20px">Received By</div></td>
                            <td align="center" colspan="2"  valign="bottom"><div  style="border-top:2px solid #333; width:120px;margin-left:100px;">Authorized By</div></td>
                      </tr>
                      
                    </table>
                </td>
            </tr>            
        </table>
        
        <table width="100%" border="0" class="customtable">
        	<tr>
            	<td align="left"><img src="{{ asset('assets/img/logo.png') }}" style="width:80px; height:auto"></td>
                <td align="center">
                <h4 style="border:2px solid #333; padding:2px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; border-radius:10px; margin-top:10px; width:200px;">Money Receipt</h4></td>
                <td align="right">হ্নীলা ইউনিয়ন পরিষদ <br /> কক্সবাজার</td>
            </tr>
            
			<tr>
            	<td colspan="3" style="border:none">
                	<table width="100%" border="0" class="customtable">
                    	<tr>
                        	<td align="left" colspan="2"  valign="bottom">Memo <span style="border-bottom:1px dotted #333; font-weight:bold">{{ $receipt->memo }}</span></td>
                            <td align="right" colspan="2"  valign="bottom">Date: <span style="border-bottom:1px dotted #333; font-weight:bold">{{ date('d/m/Y',strtotime($receipt->date)) }}</span></td>
                      </tr>
                        <tr>
                        	<td align="left" colspan="2"  valign="bottom">Received with thanks from</td>
                            <td align="left" colspan="2"   valign="bottom" style="border-bottom:1px dotted #333 !important;"><span style="font-weight:bold">{{ $receipt->receiver_name }}</span></td>
                        </tr>
                        <tr>
                        	<td align="left" colspan="2"  valign="bottom">Amount in word</td>
                            <td align="left" colspan="2"  valign="bottom" style="border-bottom:1px dotted #333 !important;"><span style="font-weight:bold">{{ $receipt->amount_in_word }}</span></td>
                        </tr>
                        <tr>
                        	<td width="8%" align="left"  valign="bottom">By</td>
                          <td width="22%" align="left"  valign="bottom" style="border-bottom:1px dotted #333 !important;"><span style="font-weight:bold">{{ $receipt->paymenttype }}</span></td>
                          <td width="9%" align="left"  valign="bottom">Contact</td>
                          <td width="61%" align="left"  valign="bottom" style="border-bottom:1px dotted #333 !important;"><span style="font-weight:bold">{{ $receipt->receiver_contact }}</span></td>
                      </tr>
                        <tr>
                        	<td align="left" colspan="2">For the purpose of</td>
                            <td align="left" colspan="2" style="border-bottom:1px dotted #333 !important;"><span style="font-weight:bold">{{ $receipt->purpose }}</span></td>
                        </tr>
                        <tr>
                        	<td align="left">Amount</td>
                            <td align="left">
                            <h6 style="border:2px solid #333; padding:0px; font-family:Arial, Helvetica, sans-serif; font-weight:bold; width:80px; text-align:center; margin-top:10px;">
                            {{ $receipt->amount }}</h6>
                            </td>
                        </tr>
                        <tr align="center">
                        	<td align="center" colspan="2"  valign="bottom"><div  style="border-top:2px solid #333; width:120px; margin-top:20px">Received By</div></td>
                            <td align="center" colspan="2"  valign="bottom"><div  style="border-top:2px solid #333; width:120px;margin-left:100px;">Authorized By</div></td>
                      </tr>
                      
                    </table>
                </td>
            </tr>            
        </table>
        
    </div>
</page>
</body>
<script type="text/javascript">
	window.print();
</script> 
</html>
