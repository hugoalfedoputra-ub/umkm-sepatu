$(document).ready(function () {
    // Load product data
    function loadProductData(
        url = "/admin/products/table",
        search = "",
        sortBy = "id",
        sortOrder = "asc"
    ) {
        $.ajax({
            url: url,
            method: "GET",
            data: {
                search: search,
                sort_by: sortBy,
                sort_order: sortOrder,
            },
            success: function (data) {
                console.log(data); // Tambahkan log ini untuk debugging
                $("#productTableContainer").html(data.table);
                $("#productPaginationLinks").html(data.pagination);
                $("html, body").animate({ scrollTop: 0 }, "medium");
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    // Call loadProductData on page load
    if (window.location.pathname === "/admin/products/v2") {
        loadProductData();
    }

    // Handle search and sort
    $("#productSearchBtn").on("click", function () {
        let search = $("#productSearchInput").val() || "";
        let sortBy = $("#productSortBy").val() || "name";
        let sortOrder = $("#productSortOrder").val() || "asc";
        loadProductData("/admin/products/table", search, sortBy, sortOrder);
    });

    // Product CRUD Operations

    // Show Add Product Modal
    $("#addProductBtn").on("click", function () {
        $("#productModal").removeClass("hidden");
        $("#productModalTitle").text("Tambah Produk");
        $("#productForm")[0].reset();
        $("#productId").val("");
    });

    // Hide Modal
    $("#cancelProductBtn").on("click", function () {
        $("#productModal").addClass("hidden");
    });

    // Save Product
    $("#saveProductBtn").on("click", function (e) {
        e.preventDefault();
        let id = $("#productId").val();
        let url = id ? `/admin/products/edit/${id}` : "/admin/products/create";
        let method = id ? "PUT" : "POST";

        let formData = $("#productForm").serialize();

        $.ajax({
            url: url,
            method: method,
            data: formData,
            success: function (response) {
                $("#productTable").load(location.href + " #productTable");
                $("#cancelProductBtn").click();
            },
            error: function (xhr) {
                alert(
                    "Terjadi kesalahan. Silakan coba lagi." + xhr.responseText
                );
                $("#cancelProductBtn").click();
            },
        });
    });

    // Edit Product
    $("#editProductBtn").on("click", function () {
        let id = $(this).data("id");

        $.get(`/admin/products/edit/${id}`, function (data) {
            $("#productModal").removeClass("hidden");
            $("#productModalTitle").text("Edit Produk");
            $("#productId").val(data.id);
            $("#name").val(data.name);
            $("#price").val(data.price);
            $("#description").val(data.description);
            $("#image").val(data.image);
            // Set other fields as necessary
        });
    });

    // Delete Product
    $(".deleteProductBtn").on("click", function () {
        if (!confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
            return;
        }

        let id = $(this).data("id");

        $.ajax({
            url: `/admin/products/delete/${id}`,
            method: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                location.reload();
            },
            error: function (xhr) {
                alert("Terjadi kesalahan. Silakan coba lagi.");
            },
        });
    });
});
