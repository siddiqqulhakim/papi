$('.w3-radio').on('click', function () {
    $(this).parent().prev().removeClass('incomplete');
    $(this).parent().parent().prev().children().removeClass('incomplete');
});
$('#btn_kembali').on('click', function (e) {
    e.preventDefault();
    $('tbody[id^="p"]').hide();
    var h = $('input#page').val() * 1 - 1;
    $('input#page').val(h);
    $('tbody[id="p' + h + '"]').show();
    if (h == 0) {
        $(this).hide();
        $(this).addClass('w3-disabled').prop("disabled", true);
    }
    if (h < 17) {
        $('#btn_lanjut').show();
        $('#btn_lanjut').removeClass('w3-disabled').prop("disabled", false);
        $('#btn_kirim').addClass('w3-disabled').prop("disabled", true);
        $('#agree').hide();
    }
});
$('#btn_lanjut').on('click', function (e) {
    e.preventDefault();
    $('tbody[id^="p"]').hide();
    var p = $('input#page').val() * 1 + 1;
    $('input#page').val(p);
    $('tbody[id="p' + p + '"]').show();
    if (p >= 0) {
        $('#btn_kembali').show();
        $('#btn_kembali').removeClass('w3-disabled').prop("disabled", false);
    }
    if (p == 17) {
        $(this).hide();
        $(this).addClass('w3-disabled').prop("disabled", true);
        $('#btn_kirim').removeClass('w3-disabled').prop("disabled", false);
        $('#agree').show();
    }
});
$('a.color').click(function () {
    var color = $(this).attr('data-value');
    document.getElementById('papi_css').href = 'assets/css/w3/w3-theme-' + color + '.css';
    $.post('assets/js/change.color.php', { 'color': color });
});
// Questionnaire Validation
$('form[id="papi"] input[type="submit"]').on('click', function (e) {
    var answered = 0;
    // Remove incomplete class from all questions
    $('form[id="papi"] td').removeClass('incomplete');
    // Check does we have 90 questions answered
    for (i = 1; i < 91; i++) {
        // count answered questions
        if ($('form[id="papi"] input[type="radio"][name^="d[' + i + ']"]:checked').length == 1) {
            answered++;
        } else {
            $('form[id="papi"] input[type="radio"][name^="d[' + i + ']"]').each(function (i) {
                $(this).parent().prev().addClass('incomplete');
            });
        }
    }
    if (answered != 90) {
        // Prevent form submission
        e.preventDefault();
        // Display message
        $('#msg').html('Kamu telah menjawab ' + answered + ' dari 90 pertanyaan.<br>\nHarap tinjau kembali pertanyaan dan jawaban anda.');
        $('#warning').show();
    }

    const agreeCheckbox = document.getElementById('agreecheckbox');
    const div = document.querySelector('div[for="agree"]');
    if (!agreeCheckbox.checked) {
        e.preventDefault();
        alert('Harap setujui Penggunaan Data Pribadi sebelum mengirimkan formulir.');
        div.style.backgroundColor = "#FFD7D7";
    } else {
        div.style.backgroundColor = '';
    }
});

$('#btn1').on('click', function () {
    var check = 1;
    var email = $('#email').val();
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if ($('#name').val() == '') check = 0;
    if ($('#email').val() == '') check = 0;
    if (!emailRegex.test(email)) check = 0;
    if ($('#posisi').val() == '') check = 0;
    if (check == 1) {
        $.post('inc/check.php', { email: $('#email').val() }, function (data) {
            var d = $.parseJSON(data);
            console.log(d.status);
            if (d.status == 'ada') {
                alert('data sudah ada');
                document.location.replace('final.php?recall');
            } else {
                $('#intro').hide();
                $('#instruct').show();
                $('#test').show();
                $('#nav').show();
            }
        });
    } else {
        $('#msg').html('Tolong masukan data diri terlebih dahulu dengan format email yang benar.');
        $('#warning').show();
    }
});