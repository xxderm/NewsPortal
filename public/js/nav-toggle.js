$(function () {
            parameters = {
                duration: 500,
                progress: function (animation, progress) {
                    $('#progress')
                        .width(parseInt(progress * 1000) + '%')
                        .text(parseInt(progress * 1000) + '%');
                },
                complete: function () {
                    $('#progress')
                        .css('width', '0%')
                        .text('0%');
                }
            }            
            $('#slidetoggle').click(function () {
                $('#block').slideToggle(parameters);
			});
});