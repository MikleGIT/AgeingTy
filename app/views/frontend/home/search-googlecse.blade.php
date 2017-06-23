@extends('frontend.template.master')



@section('rightcontent')

<style>
#gsc-iw-id1{
    height: 30px;
    border-color: #898989;
}

input.gsc-search-button-v2{
    width: 71px;
    height: 29px;
}
table.gsc-search-box {
 width:90%;	
}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th, table > tbody > tr > td, table > tbody > tr > th, table > tfoot > tr > td, table > tfoot > tr > th, table > thead > tr > td, table > thead > tr > th {
	padding:0;	
}
.gsc-table-cell-snippet-close, .gs-promotion-text-cell {
    vertical-align: top;
    width: 88%;
}
#gs_cb50{display:none;}
</style>

<div class="row">
    <div class="col-sm-12">
    <script>
      (function() {
        var cx = '002741241179678120054:wn2jbw35jko';
        var gcse = document.createElement('script');
        gcse.type = 'text/javascript';
        gcse.async = true;
        gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
            '//cse.google.com/cse.js?cx=' + cx;
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(gcse, s);
      })();
	  
	  $(function(){
            var tabindex = 2;
            $('a,button,#content,input,select,video').each(function() {
                if (this.type != "hidden") {
                    var $input = $(this);
					$input.attr("tabindex", tabindex);
                    tabindex++;
					$(".sr-only-focusable").attr("tabindex", 1);
                }
            });
		});
    </script>
    <gcse:search linktarget="_parent"></gcse:search>

    </div>
</div>
@stop