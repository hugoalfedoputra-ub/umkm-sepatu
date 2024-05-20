// product.js

$(document).ready(function () {
    $("#addToCartForm").on("submit", function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr("action"),
            method: "POST",
            data: formData,
            success: function (response) {
                // Tambahkan logika di sini untuk menangani respons dari server
                console.log(response);
                $("main").prepend(
                    '<div class="bg-green-500 text-white p-4 rounded mb-4 alert">' +
                        response.message +
                        "</div>"
                );
            },
            error: function (xhr, status, error) {
                // Tambahkan logika di sini untuk menangani kesalahan
                console.error(xhr.responseText);
                alert("Gagal menambahkan produk ke keranjang.");
                $("main").prepend(
                    '<div class="bg-red-500 text-white p-4 rounded mb-4 alert">Gagal menambahkan produk ke keranjang.</div>'
                );
            },
        });
    });
});
