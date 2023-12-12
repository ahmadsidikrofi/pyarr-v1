// Membuat tombol input menjadi enable
$('#nameButton').on('click', function() {
    $("#nameInput").prop('readonly', function(_, prop) {
        return !prop;
    })
});

$('#no_hpButton').on('click', function () {
    $('#no_hpInput').prop('readonly', function(_, prop) {
        return !prop;
    });
})

$('#alamatButton').on('click', function() {
    $('#alamatInput').prop('readonly', function(_, prop) {
        return !prop;
    });
});


// Update Profile Picture
$(document).ready(function () {
    // image preview
    $('#image').change(function() {
        let reader = new FileReader();

        reader.onload = (e) => {
            $('#image_preview').attr('src', e.target.result);
            $('#image_preview').width(150);
        };
        reader.readAsDataURL(this.files[0]);
    });
});
