<?php 
header("Content-type: text/javascript");
if(!defined('_ASSET')) define('_ASSET','../assets/');
echo "var aset='"._ASSET."';";
?>
$('a.color').click(function(){
  var color=$(this).attr('data-value');
  document.getElementById('disc_css').href=aset+'/css/w3/w3-theme-'+color+'.css';
  $.post(aset+'/js/change.color.php',{'color':color});
});

$('a.color_graph').click(function(){
  var color=$(this).attr('data-value');
  document.getElementById('disc_css').href=aset+'/css/w3/w3-theme-'+color+'.css'; 
  data={
        'color':color,
        's1':$('#s1').val(),
        'i1':$('#i1').val(),
        'p1':$('#p1').val(),
        's2':$('#s2').val(),
        'i2':$('#i2').val(),
        'p2':$('#p2').val(),
        's3':$('#s3').val(),
        'i3':$('#i3').val(),
        'p3':$('#p3').val(),
        };
  $.post(aset+'/js/change.color.php',data,function(result){
    var r=Math.random()*1000;
    $('#graph1').attr('src',aset+'/img/graph.php?g=1&v='+r);
    $('#graph2').attr('src',aset+'/img/graph.php?g=2&v='+r);
    $('#graph3').attr('src',aset+'/img/graph.php?g=3&v='+r);
  });
});

$('input:radio').on('click',function(){
  var m=$(this).attr('id');
  //-- Check for 
  if($('#'+(m.slice(0,1)=='m'?'l':'m')+'_'+m.slice(2)).is(':checked')){
      $('#msg').html('Anda tidak dapat memilih kedua pilihan "paling" dan "paling tidak" dalam satu pernyataan yang sama');
      $('#warning').show();
      $(this).removeAttr('checked');
  }
});

// Questionnaire Validation
$('form[name="disc"] input[type="submit"]').on('click',function(e){
        var answered = 0;
        // Remove incomplete class from all questions
        $('form[name="disc"] td, form[name="disc"] th').removeClass('incomplete');
        // Check does we have 24 P and K options selected
        for ( i=1; i<25; i++ ) {
            // count answered questions
            if ( $('form[name="disc"] input[type="radio"][name^="m['+i+']"]:checked').length == 1 && $('form[name="disc"] input[type="radio"][name^="l['+i+']"]:checked').length == 1 ) {
                answered++;
            } else {
                $('form[name="disc"] input[type="radio"][name^="m['+i+']"]').each(function(i){
                    // Traverse to previous 2 siblings only for first control
                    if ( i == 0 ) {
                        $(this).parent().addClass('incomplete').prev().addClass('incomplete').prev().addClass('incomplete');
                    } else {
                        $(this).parent().addClass('incomplete').prev().addClass('incomplete');
                    }
                });
            }
        }
        if ( answered != 24 ) {
            // Prevent form submission
            e.preventDefault();
            // Display message
      $('#msg').html('Kamu telah menjawab '+answered+' dari 24 pertanyaan.<br>\nHarap tinjau kembali pertanyaan dan jawaban anda serta pastikan semua field terisi.');
      $('#warning').show();
        }
});

function openTabs(evt, tabName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("tabs");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-border-theme", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-theme";
}