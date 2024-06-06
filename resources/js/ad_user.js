$(document).ready(function () {
    // Load user data
    function loadUserData(
        url = "/admin/users/table",
        search = "",
        sortBy = "name",
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
                $("#userTableBody").html(data.table);
                $("#mobileUserTable").html(data.mobile);
                $("#paginationLinks").html(data.pagination);
            },
            error: function (error) {
                alert("Gagal memuat data pengguna");
                console.log(error);
            },
        });
    }

    // Call loadUserData on page load
    loadUserData();

    // Handle pagination click
    $(document).on("click", "#paginationLinks a", function (e) {
        e.preventDefault();
        let url = $(this).attr("href");
        let search = $("#userSearchInput").val() || "";
        let sortBy = $("#userSortBy").val() || "name";
        let sortOrder = $("#userSortOrder").val() || "asc";
        loadUserData(url, search, sortBy, sortOrder);
    });

    // Handle search and sort
    $("#userSearchBtn").on("click", function () {
        let search = $("#userSearchInput").val() || "";
        let sortBy = $("#userSortBy").val() || "name";
        let sortOrder = $("#userSortOrder").val() || "asc";
        loadUserData("/admin/users/table", search, sortBy, sortOrder);
    });

    // Open the modal to create a new user
    $("#addUserBtn").on("click", function () {
        $("#userModalTitle").text("Tambah Pengguna");
        $("#userForm")[0].reset();
        $("#userId").val("");
        $("#userModal").removeClass("hidden");
    });

    // Save or update user
    $("#saveUserBtn").on("click", function (e) {
        e.preventDefault();

        let userId = $("#userId").val();
        let url = userId
            ? `/admin/users/edit/${userId}`
            : "/admin/users/create";
        let method = userId ? "PUT" : "POST";
        let formData = $("#userForm").serialize();

        $.ajax({
            type: method,
            url: url,
            data: formData,
            success: function (response) {
                loadUserData();
                $("#userModal").addClass("hidden");
            },
            error: function (error) {
                alert("Gagal menyimpan user");
                console.log(error);
            },
        });
    });

    // Edit user
    $(document).on("click", ".editUserBtn", function () {
        let id = $(this).data("id");
        $.get(`/admin/users/edit/${id}`, function (data) {
            $("#userModalTitle").text("Edit Pengguna");
            $("#userId").val(data.id);
            $("#name").val(data.name);
            $("#email").val(data.email);
            $("#userrole").val(data.userrole);
            $("#password").val("");
            $("#password_confirmation").val("");
            $("#userModal").removeClass("hidden");
        });
    });

    // Delete user
    $(document).on("click", ".deleteUserBtn", function () {
        if (confirm("Apakah Anda yakin ingin menghapus pengguna ini?")) {
            let id = $(this).data("id");
            $.ajax({
                type: "DELETE",
                url: `/admin/users/delete/${id}`,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    loadUserData();
                },
                error: function (xhr) {
                    alert(
                        "Terjadi kesalahan. Silakan coba lagi." +
                            xhr.responseText
                    );
                },
            });
        }
    });
});
