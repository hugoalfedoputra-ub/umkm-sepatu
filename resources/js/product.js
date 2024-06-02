// product.js

$(document).ready(function () {
    // Pastikan ini adalah selektor jQuery yang benar
    const filters = $("#filters");

    $("#toggle-filters-button").click(function (event) {
        if (filters.hasClass("hidden")) {
            filters.removeClass("hidden").addClass("flex mt-4");
        } else {
            filters.removeClass("flex mt-4").addClass("hidden");
        }
    });

    $("#addToCartForm").on("submit", function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr("action"),
            method: "POST",
            data: formData,
            success: function (response) {
                console.log(response);
                $("main").prepend(
                    '<div class="bg-green-500 text-white p-4 rounded mb-4 alert">' +
                        response.message +
                        "</div>"
                );
            },
            error: function (xhr, status, error) {
                var errorMessage =
                    xhr.responseJSON && xhr.responseJSON.message
                        ? xhr.responseJSON.message
                        : "Gagal menambahkan produk ke keranjang.";
                console.error(xhr.responseText);

                if (errorMessage === "Unauthenticated.") {
                    window.location.href = "/login";
                }

                $("main").prepend(
                    '<div class="bg-red-500 text-white p-4 rounded mb-4 alert">' +
                        errorMessage +
                        "</div>"
                );
            },
        });
    });

    const colorSelect = $("#color");
    const sizeSelect = $("#size");
    const stockInfo = $("#stock-info");
    const variants = window.productVariants;

    function updateStockInfo() {
        const selectedColor = colorSelect.val();
        const selectedSize = sizeSelect.val();
        const quantityInput = $("#quantity");
        const quantityLabel = $(".quantity-label");
        const addToCartButton = $("#add-to-cart-button");

        const variant = variants.find(
            (variant) =>
                variant.color === selectedColor && variant.size === selectedSize
        );

        if (variant) {
            // stockInfo.text(`Tersedia: ${variant.stock}`);
            quantityInput.attr("max", variant.stock); // Set max attribute to stock available

            if (variant.stock > 0) {
                stockInfo
                    .text(`Tersedia: ${variant.stock}`)
                    .removeClass("text-red-500")
                    .addClass("text-green-500");
                quantityInput.removeClass("hidden").prop("disabled", false);
                quantityLabel.removeClass("hidden");
                addToCartButton
                    .removeClass("bg-gray-600 cursor-not-allowed")
                    .addClass("bg-green-600 hover:bg-green-500")
                    .prop("disabled", false);
            } else {
                stockInfo
                    .text(`Stok habis`)
                    .removeClass("text-green-500")
                    .addClass("text-red-500");
                quantityInput.addClass("hidden").prop("disabled", true);
                quantityLabel.addClass("hidden");
                addToCartButton
                    .removeClass("bg-green-600 hover:bg-green-500")
                    .addClass("bg-gray-600 cursor-not-allowed")
                    .prop("disabled", true);
            }
        } else {
            stockInfo.text("Stock tidak tersedia");
            stockInfo.removeClass("text-green-500").addClass("text-red-500");
            quantityInput.prop("disabled", true); // Disable the input if variant not found
        }
    }

    colorSelect.change(updateStockInfo);
    sizeSelect.change(updateStockInfo);

    updateStockInfo();
});
