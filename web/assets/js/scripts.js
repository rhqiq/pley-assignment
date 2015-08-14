jQuery(document).ready(function () {

    /*
     Fullscreen background
     */
    $.backstretch("assets/img/backgrounds/box-bg.png");

    /*
     Form validation
     */
    $('.registration-form input[type="text"], .registration-form input[type="password"]').on('focus', function () {
        $(this).removeClass('input-error');
    });

    $('.registration-form').on('submit', function (e) {
        var stat = false;
        $(this).find('input[type="text"], input[type="password"]').each(function () {
            if ($(this).val() == "") {
                e.preventDefault();
                $(this).addClass('input-error');
                stat = false;
            }
            else {
                $(this).removeClass('input-error');
                stat = true;
            }
        });

        if (stat) {
            var $form = $("#register-form");
            var $url = $form.attr('action');
            var $data = $form.serialize();

            $.ajax({
                url: $url,
                data: $data,
                method: 'post',
                dataType: 'json',
                cache: false,
                success: function (obj) {
                    console.log(obj);
                    $('.modal-content').html(obj.result);
                    $('.modal').modal('show');
                },
                complete: function () {
                    console.log('complete!');
                },
                error: function (err) {
                    console.log('complete!');
                }
            });
        }
        return false; // avoid to execute the actual submit of the form.
    });
});