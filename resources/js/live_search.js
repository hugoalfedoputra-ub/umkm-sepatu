$(document).ready(function () {
    //Live search
    $("#search").on("keyup", function () {
        var query = $(this).val();
        if (query.length > 0) {
            $.ajax({
                url: "/live-search",
                type: "GET",
                data: { search: query },
                success: function (data) {
                    $("#search-results").html(data).show();
                },
            });
        } else {
            $("#search-results").hide();
        }
    });

    // Hide search results when clicking outside
    $(document).on("click", function (e) {
        if (!$(e.target).closest("#search-results, #search").length) {
            $("#search-results").hide();
        }
    });

    // Prevent form submission on Enter key for live search
    $("#search").on("keypress", function (e) {
        if (e.which === 13) {
            e.preventDefault();
            if ($(this).val().trim() === "") {
                $("#search-results").hide();
            } else {
                $(this).closest("form").submit();
            }
        }
    });
});
