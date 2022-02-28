// ready method is used when document loaded completely
$(document).ready(function () {

    $('.remove-to-do').click(function () {
        // attr() sets or returns attributes or values of selected element
        const id = $(this).attr('id');

        $.post("app/remove.php", {
            id: id
        },
            (data) => {
                if (data) {
                    $(this).parent().hide(600);
                }
            }
        );
    });

    // this is for checkbox 
    $(".check-box").click(function (e) {
        const id = $(this).attr('data-todo-id');

        $.post('app/check.php', {
            id: id
        },
            (data) => {
                if (data != 'error') {
                    // The next () method returns an object with two properties done and value
                    const h2 = $(this).next();
                    if (data === '1') {
                        h2.removeClass('checked');
                    } else {
                        h2.addClass('checked');
                    }
                }
            }
        );
    });
});
