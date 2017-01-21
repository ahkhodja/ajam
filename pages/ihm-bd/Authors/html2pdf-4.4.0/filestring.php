
<?php 

$body="<head>
<style type=\"text/css\">
<!--
table
{
    widtd:100%;
	margin-left:70px;
	margin-top:50px;
    border:none;
    border-collapse: collapse;
}
#header{
	display:inline-block;
	margin:0;
	height:20px;
}
#textLogo, #textLogo h1{
	display:inline-block;
	text-align:left;
	height:20px;
	/*border-left:1px solid #000;*/
	font-size:12px;
}
#logo{
	display:inline-block;
	width:20px;
	margin-left:0;
}

#title{
	margin-top:80px;
	max-width:300px;
	font-size:16px;
	font-weight:bold;
	text-align:center;	
}
td
{
	padding:5px;
    text-align: center;
    border: solid 1px #999;
}

-->
</style>
</head>
<body>
<div id=\"header\">
<!--<div id=\"logo\"><img height=\"20px\" width=\"20px\" src=\"logo.png\"/></div>-->
<div id=\"textLogo\"><h1>Algerien Journal for Advanced Materials</h1></div>
<div>--Manuscript Draft--</div>
</div>
<div id=\"title\">Robustness of Radon transform to white additive noise. General case study </div>

<table>
<col style=\"width: 20%; text-align:left; background-color:#f8f8f8;\">
<col style=\"width: 60%; text-align:left;\">
<tr>
<td>Manuscript ID</td>
<td>AJAM-000-000</td>
</tr>
<tr>
<td>Article Type</td>
<td>Full Paper</td>
</tr>
<tr>
<td>Date Submitted by the Author</td>
<td>29-Mar-2013</td>
</tr>
<tr>
<td>Corresponding Author</td>
<td>Nacereddine Nafaa</td>
</tr>
<tr>
<td>Complete List of Authors</td>
<td>Nacereddine Nafaa <br/>Zhun Fan <br /> Shantou University <br /> </td>
</tr>
<tr>
<td>Abstract</td>
<td>PDF Merger for PHP makes it incredibly easy to merge multiple PDFs together in your PHP web application. After merging you can either output to the browser, prompt a download, save it to a file location or return it as a string.PDF Merger for PHP makes it incredibly easy to merge multiple PDFs together in your PHP web application. After merging you can either output to the browser, prompt a download, save it to a file location or return it as a string.PDF Merger for PHP makes it incredibly easy to merge multiple PDFs together in your PHP web application. After merging you can either output to the browser, prompt a download, save it to a file location or return it as a string.PDF Merger for PHP makes it incredibly easy to merge multiple PDFs together in your PHP web application. After merging you can either output to the browser, prompt a download, save it to a file location or return it as a string. PDFs together in your PHP web application. After merging you can either output to the browser, prompt a download, save it to a file location or return it as a string.PDF Merger for PHP makes it incredibly easy to merge multiple PDFs together in your PHP web application. After merging you can either output to the browser, prompt a download, save it to a file location or return it as a string. PDFs together in your PHP web application. After merging you can either .</td>
</tr>
<tr>
<td>Keywords</td>
<td>file' WITH 'browser', 'download', 'string', or 'file' for output options</td>
</tr>
</table>
</body>";
    require('html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF("P", "A4", "en");
        $html2pdf->setDefaultFont("Arial");
        $html2pdf->writeHTML($body);
        $html2pdf->Output('rep/file.pdf','F');
		
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
?>
