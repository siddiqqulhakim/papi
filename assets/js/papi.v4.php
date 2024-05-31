<?php

header("Content-type: text/javascript");
?>
$('.w3-radio').on('click',function(){
$(this).parent().prev().removeClass('incomplete');
$(this).parent().parent().prev().children().removeClass('incomplete');
});
$('#btn_kembali').on('click',function(e){
e.preventDefault();
$('tbody[id^="p"]').hide();
var h=$('input#page').val()*1-1;
$('input#page').val(h);
$('tbody[id="p'+h+'"]').show();
if(h==0){
$(this).addClass('w3-disabled').prop("disabled", true);
}
if( h < 17 ){ $('#btn_lanjut').removeClass('w3-disabled').prop("disabled", false);
	$('#btn_kirim').addClass('w3-disabled').prop("disabled", true); } }); $('#btn_lanjut').on('click',function(e){
	e.preventDefault(); $('tbody[id^="p" ]').hide(); var p=$('input#page').val()*1+1; $('input#page').val(p);
	$('tbody[id="p'+p+'" ]').show(); if(p>=0){
	$('#btn_kembali').removeClass('w3-disabled').prop("disabled", false);
	}
	if( p == 17 ){
	$(this).addClass('w3-disabled').prop("disabled", true);;
	$('#btn_kirim').removeClass('w3-disabled').prop("disabled", false);
	}
	});
	$('a.color').click(function(){
	var color=$(this).attr('data-value');
	document.getElementById('papi_css').href='assets/css/w3/w3-theme-'+color+'.css';
	$.post('assets/js/change.color.php',{'color':color});
	});
	// Questionnaire Validation
	$('form[id="papi"] input[type="submit"]').on('click',function(e){
	var answered = 0;
	// Remove incomplete class from all questions
	$('form[id="papi"] td').removeClass('incomplete');
	// Check does we have 90 questions answered
	for ( i=1; i<91; i++ ) { // count answered questions if ( $('form[id="papi" ] input[type="radio" ][name^="d['+i+']"
		]:checked').length==1 ) { answered++; } else { $('form[id="papi" ] input[type="radio" ][name^="d['+i+']"
		]').each(function(i){ $(this).parent().prev().addClass('incomplete'); }); } } if ( answered !=90 ) { // Prevent
		form submission e.preventDefault(); // Display message $('#msg').html('You have answered '+answered+' out of 90
		questions.<br>\nPlease review questionnaire and answer marked questions.');
		$('#warning').show();
		}
		});

		$('#btn1').on('click',function(){
		var check=1;
		if($('#name').val()=='') check=0;
		if($('#email').val()=='') check=0;
		if(check==1){
		$.post('inc/check.php',{email:$('#email').val()},function(data){
		var d=$.parseJSON(data);
		console.log(d.status);
		if(d.status=='ada'){
		alert('data sudah ada');
		document.location.replace('final.php?recall');
		}else{
		$('#intro').hide();
		$('#instruct').show();
		$('#test').show();
		$('#nav').show();
		}
		});
		}else{
		$('#msg').html('Please fulfill your personal information first.');
		$('#warning').show();
		}
		});