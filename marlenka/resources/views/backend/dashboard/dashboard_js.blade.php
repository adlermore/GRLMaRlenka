<script>
    var spinner =
        '<div class="h-100 d-flex align-items-center justify-content-center">' +
        '<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>' +
        "</div>";

    $(".top_category_products_tab").click(function () {
        top_category_products_tab($(this).data("target"));
    });

    $(".top_brands_products_tab").click(function () {
        top_brands_products_tab($(this).data("target"));
    });

    function top_category_products_tab(interval_type) {
        $("#top-category-products-section").html(spinner);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url:
                AIZ.data.appUrl +
                "/admin/dashboard/top-category-products-section",
            data: {
                interval_type: interval_type,
            },
            success: function (data) {
                $("#top-category-products-section").html(data);
                AIZ.plugins.slickCarousel();
            },
        });
    }

    function top_brands_products_tab(interval_type) {
        $("#top-brands-products-section").html(spinner);
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url:
                AIZ.data.appUrl +
                "/admin/dashboard/top-brands-products-section",
            data: {
                interval_type: interval_type,
            },
            success: function (data) {
                $("#top-brands-products-section").html(data);
                AIZ.plugins.slickCarousel();
            },
        });
    }
</script>
