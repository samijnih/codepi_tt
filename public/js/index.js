var Show = {
    ajax: function (page) {
        var data = {
            city: $("select[name=city]").val(),
            tags: $("select[name=tags]").val(),
            price: $("select[name=price]").val(),
            date_start: $("select[name=date_start]").val(),
            date_end: $("select[name=date_end]").val(),
            page: typeof page === "undefined" ? '' : page,
        };

        $.ajax({
            url: '/',
            dataType: 'html',
            data: data,
            success: function (res, xhr) {
                $("#shows").html(res);
            },
            error: function (xhr, textStatus, errorThrown) {
                if (xhr.status === 422) {
                    var errors   = JSON.parse(xhr.responseText),
                        messages = '';

                    messages = $.map(errors, function(item, index) {
                        return item[0];
                    });

                    toastr.warning(messages.join('<br>'));
                }
            }
        });
    }
};