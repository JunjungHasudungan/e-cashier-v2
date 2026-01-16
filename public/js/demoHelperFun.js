function swalSuccess(messge) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    Toast.fire({
    icon: "success",
    title: messge
    });
}


function confirmDelete(message = "", callback) {
    Swal.fire({
        title: message,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: 'Batal',
        confirmButtonText: "Ya, hapus!!",
    }).then((result) => {
        callback(result)
    });
}

function swalLoading(message, callback) {
    const loading = Swal.fire({
        title: "Please Wait..",
        text: message || 'Process Delete',
        timer: 2000,
        timerProgressBar: true,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
            callback()
        },
    })

    return loading
}

function swalAlert(icon, message = "") {
    Swal.fire({
        icon: icon,
        title: "Oops...",
        text: message,
    });
}


