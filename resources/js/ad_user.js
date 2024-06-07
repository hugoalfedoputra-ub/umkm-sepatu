$(document).ready(function () {
    // Load user data
    function loadUserData(
        url = "/admin/users/table",
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
                $("#userTableBody").html(data.table);
                $("#mobileUserTable").html(data.mobile);
                $("#userPaginationLinks").html(data.pagination);
                $("html, body").animate({ scrollTop: 0 }, "fast");
            },
            error: function (error) {
                console.log(error);
            },
        });
    }

    // Call loadUserData on page load
    if (window.location.pathname === "/admin/users") {
        loadUserData();
    }

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
            document.getElementById("userModalTitle").innerText = "Edit User";
            document.getElementById("nameField").style.display = "none";
            document.getElementById("emailField").style.display = "none";
            document.getElementById("passwordField").style.display = "none";
            document.getElementById("passwordConfirmationField").style.display =
                "none";
            $("#userModalTitle").text("Edit Pengguna");
            $("#userId").val(data.id);
            $("#name").val(data.name);
            $("#email").val(data.email);
            $("#userrole").val(data.userrole);
            $("#password").val("");
            $("#password_confirmation").val("");
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
