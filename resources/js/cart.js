$(document).ready(function () {
    let tempTotalPrice = 0;
    let tempSelectedCount = 0;

    function recalculateCart() {
        tempTotalPrice = 0;
        tempSelectedCount = 0;
        $(".item-checkbox:checked").each(function () {
            const itemId = $(this).data("item-id");
            const quantity = parseInt($("#quantity-input-" + itemId).val());
            const priceText = $("#price-" + itemId).text();
            const price = parseInt(priceText.replace(/[^0-9]/g, "")); // Ensure only digits are parsed

            if (!isNaN(price) && !isNaN(quantity)) {
                tempTotalPrice += quantity * price;
                tempSelectedCount++;
            }
        });

        if (tempTotalPrice > 0) {
            $("#total-price").text(
                "Total: Rp " + tempTotalPrice.toLocaleString()
            );
            $("#buy-button").text("Beli (" + tempSelectedCount + ")");
            $("#buy-button").prop("disabled", false); // Enable the button
            $("#buy-button").removeClass("bg-gray-600 cursor-not-allowed"); // Remove bg-gray-600 class
            $("#buy-button").addClass("bg-green-600 hover:bg-green-500"); // Add bg-gray-600 class
        } else {
            $("#total-price").text("Total: -");
            $("#buy-button").text("Beli");
            $("#buy-button").prop("disabled", true); // Disable the button
            $("#buy-button").removeClass("bg-green-600 hover:bg-green-500"); // Remove bg-gray-600 class
            $("#buy-button").addClass("bg-gray-600 cursor-not-allowed"); // Add bg-gray-600 class
        }
    }

    $(".quantity-button").click(function () {
        const button = $(this);
        const itemId = button.data("item-id");
        const delta = parseInt(button.data("delta"));
        const input = $("#quantity-input-" + itemId);
        const currentQuantity = parseInt(input.val());
        const maxStock = parseInt(input.data("stock"));
        const newQuantity = currentQuantity + delta;

        if (newQuantity >= 1 && newQuantity <= maxStock) {
            input.val(newQuantity);
            recalculateCart();
        }
    });

    $(".quantity-input").change(function () {
        const input = $(this);
        const maxStock = parseInt(input.data("stock"));
        let quantity = parseInt(input.val());

        if (quantity < 1) {
            input.val(1);
        } else if (quantity > maxStock) {
            input.val(maxStock);
        }

        recalculateCart();
    });

    recalculateCart();

    $(".item-checkbox, .quantity-input").change(function () {
        recalculateCart();
    });

    // Handler untuk tombol hapus
    $(".remove-button").on("click", function (e) {
        e.preventDefault(); // Prevent the default form submission
        const itemId = $(this).data("item-id");
        const token = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            url: "/cart/remove/" + itemId,
            type: "POST",
            data: {
                _token: token,
                _method: "DELETE",
            },
            success: function (response) {
                if (response.success) {
                    $("#cart-item-" + itemId).remove(); // Remove the item element from the DOM
                    recalculateCart(); // Recalculate the cart totals

                    // Check if cart is empty after removing item
                    if ($("#isikart .cart-item").length === 0) {
                        $("#isikart").html("<p>Keranjang Anda kosong.</p>");
                        $("#buy-button").addClass("hidden");
                        $("#total-price").addClass("hidden");
                    }
                } else {
                    alert("Gagal menghapus item");
                }
            },
            error: function () {
                alert("Error saat menghapus item");
            },
        });
    });

    function buyButton() {
        // Loop through each item in the cart
        $(".item-checkbox").each(function () {
            const itemId = $(this).data("item-id");
            const quantity = parseInt($("#quantity-input-" + itemId).val());
            const selected = $(this).prop("checked");

            // Create hidden input fields for quantity and selected status
            const quantityInput = $("<input>")
                .attr("type", "hidden")
                .attr("name", "items[" + itemId + "][quantity]")
                .val(quantity);
            const selectedInput = $("<input>")
                .attr("type", "hidden")
                .attr("name", "items[" + itemId + "][selected]")
                .val(selected ? 1 : 0);

            // Append hidden inputs to the form
            $("#buy-form").append(quantityInput, selectedInput);
        });

        // Submit the form
        $("#buy-form").submit();
    }

    // Event listener for the buy button
    $("#buy-button").on("click", function () {
        buyButton();
    });

    // Menjalankan fungsi buyButton saat page di reload, back page, tab closed, dan hilang fokus
    $(window).on("beforeunload pagehide", function () {
        buyButton();
    });
});
