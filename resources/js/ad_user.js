$(document).ready(function () {
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
                loadUserTable();
                $("#cancelUserBtn").click();
            },
            error: function (error) {
                alert("Gagal menyimpan user");
                console.log(error);
            },
        });
    });

    // Edit user
    $(".editUserBtn").on("click", function () {
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
    $(".deleteUserBtn").on("click", function () {
        if (confirm("Apakah Anda yakin ingin menghapus pengguna ini?")) {
            let id = $(this).data("id");
            $.ajax({
                type: "DELETE",
                url: `/admin/users/delete/${id}`,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    window.location.reload();
                    $("#cancelUserBtn").click();
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
