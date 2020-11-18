jQuery(function($) {
    $('.bxslider').bxSlider({
        pager: false,
        mode: 'fade',
        captions: true,
        responsive: true,
        slideWidth: 500,
        onSliderLoad: function() {
            $("#memeOption2").css("visibility", "visible");
        },
    });
});

jQuery(function($) {
    $("input[name='chooseMemeType']").on('change', function() {
        var selectedValue = $(this).val();

        $("div.desc").hide();
        $("#memeOption" + selectedValue).show();
    });
});

jQuery(function($) {
    $('form[name="create-meme-form"').on('submit', (e) => {
        e.preventDefault();
        let selectedType = $("input[name='chooseMemeType']:checked").val();
        if (selectedType == 2)
        {
            let form = e.currentTarget;
            let image = $(".carouselImage:visible").children('img')[0].src;
            let title = $(form).find("input[name='title']").val();
            let body = $(form).find("input[name='body']").val();
            let category = $(form).find("select[name='category_id'] option:selected").val();
            let requestData = {
                image: image,
                title: title,
                body: body,
                category_id: category
            };
            let actionUrl = $('form[name="create-meme-form"').attr('action');
            
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: requestData,
                dataType: 'JSON',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function(response) {
                    window.location = response.url;
                },    
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                    console.log(xhr.responseText);
                }
            })
        }
        else if (selectedType == 1)
        {
            e.currentTarget.submit();
        }
    });
});