$(document).ready(function () {
    function updateQuantity(itemId, delta) {
        const quantityInput = $("#quantity-input-" + itemId);
        let currentValue = parseInt(quantityInput.val());
        if (currentValue + delta >= 1) {
            const newQuantity = currentValue + delta;
            $.ajax({
                url: "/cart/updateQ/" + itemId,
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    quantity: newQuantity,
                },
                success: function (response) {
                    if (response.success) {
                        quantityInput.val(newQuantity);
                        $("#total-price").text(response.totalPrice);
                        $("#buy-button").text(response.selectedCount);
                    }
                    $("#pricenih").load(location.href + " #pricenih");
                },
            });
        }
    }

    $(".quantity-button").on("click", function () {
        const itemId = $(this).data("item-id");
        const delta = $(this).data("delta");
        updateQuantity(itemId, delta);
    });

    $(".item-checkbox").on("change", function () {
        const itemId = $(this).data("item-id");
        $.ajax({
            url: "/cart/updateS/" + itemId,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                selected: $(this).is(":checked") ? 1 : 0,
            },
            success: function (response) {
                if (response.success) {
                    $("#total-price").text(response.totalPrice);
                    $("#buy-button").text(response.selectedCount);
                }
                $("#pricenih").load(location.href + " #pricenih");
            },
        });
    });

    $(".remove-button").on("click", function (e) {
        e.preventDefault();
        const itemId = $(this).data("item-id");
        $.ajax({
            url: "/cart/remove/" + itemId,
            method: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                _method: "DELETE",
            },
            success: function (response) {
                if (response.success) {
                    $("#cart-item-" + itemId).remove();
                    $("#total-price").text(response.totalPrice);
                    $("#buy-button").text(response.selectedCount);
                    $("#pricenih, #isikart").load(
                        location.href + " #pricenih, #isikart"
                    );
                }
            },
        });
    });
});
