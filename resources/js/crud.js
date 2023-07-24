const modal = new bootstrap.Modal($("#modalAction"));
$(".btn-add").on("click", function () {
    let data = $(this).data();
    let url = data.url;
    $.ajax({
        method: "get",
        url: url,
        success: function (res) {
            $("#modalAction").find(".modal-dialog").html(res);
            modal.show();
            store();
        },
    });
});

$("#table").on("click", ".action", function () {
    let data = $(this).data();
    let url = data.url;
    let type = data.type;

    if (type == "delete") {
        Swal.fire({
            icon: "warning",
            title: "Apakah Anda Yakin?",
            text: "Data akan dihapus secara permanen!",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: url,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (res) {
                        window.LaravelDataTables["table"].ajax.reload();
                        Swal.fire(
                            "Terhapus!",
                            "Data telah dihapus.",
                            "success"
                        );
                    },
                });
            }
        });
    } else if (type == "edit") {
        $.ajax({
            method: "get",
            url: url,
            success: function (res) {
                $("#modalAction").find(".modal-dialog").html(res);
                modal.show();
                store();
            },
        });
    } else {
        $.ajax({
            method: "get",
            url: url,
            success: function (res) {
                $("#modalAction").find(".modal-dialog").html(res);
                modal.show();
            },
        });
    }
});

function store() {
    $("#formAction").on("submit", function (e) {
        e.preventDefault();
        const _form = this;
        const formData = new FormData(_form);

        const url = this.getAttribute("action");

        $.ajax({
            method: "POST",
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                window.LaravelDataTables["table"].ajax.reload();
                Swal.fire("Tersimpan!", "Data telah disimpan.", "success");
                modal.hide();
            },
            error: function (res) {
                let errors = res.responseJSON?.errors;
                $(".invalid-feedback").remove();
                $(".is-invalid").removeClass("is-invalid");

                if (errors) {
                    for (const [key, value] of Object.entries(errors)) {
                        $(`[name='${key}']`)
                            .parent()
                            .append(
                                `<span class="invalid-feedback">${value}</span>`
                            );
                        $(`[name='${key}']`).addClass("is-invalid");
                    }
                }
            },
        });
    });
}
