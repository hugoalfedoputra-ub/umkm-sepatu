$(document).ready(function () {
    var paymentMethodMapping = {
        credit_card: "Kartu Kredit",
        bank_transfer: "Transfer Bank",
        cash_on_delivery: "Bayar di Tempat",
    };

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    $("#whatsapp-button").on("click", function (event) {
        var address = $("#address").val();

        if (address.trim() === "") {
            return;
        }

        var paymentMethodValue = $("#payment_method").val();
        var paymentMethod =
            paymentMethodMapping[paymentMethodValue] || paymentMethodValue;

        var products = "";
        $("tbody tr").each(function (index) {
            var name = $(this).find("td").eq(0).text().trim();
            var quantity = $(this).find("td").eq(1).text().trim();
            var price = $(this).find("td").eq(2).text().trim();
            var total = $(this).find("td").eq(3).text().trim();
            products += `${
                index + 1
            }. ${name}\n    Jumlah: ${quantity},\n    Harga: Rp${price},\n    Total: Rp${total}\n`;
        });

        var totalPrice = formatNumber($("#totalPrice").data("total-price"));

        var adminNumber = "6287873734243";

        var message = `Halo Admin,\nSaya ingin memesan produk berikut:\n${products}\nAlamat Pengiriman: ${address}\nMetode Pembayaran: ${paymentMethod}\nTotal Harga: Rp${totalPrice}\n\nTerima kasih.`;

        var whatsappURL = `https://wa.me/${adminNumber}?text=${encodeURIComponent(
            message
        )}`;
        window.open(whatsappURL, "_blank");

        // Jangan mencegah form submission di sini
        // Submit the form via POST
        $("#checkout-form").submit();
    });
});
