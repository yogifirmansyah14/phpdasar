// Versi Ajax

// var keyword = document.getElementById('keyword');
// var container = document.getElementById('container');

// keyword.addEventListener('keyup', function () {
//     // buat objek ajax
//     var xhr = new XMLHttpRequest();
//     // cek kesiapan ajax
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4 && xhr.status == 200) {
//             container.innerHTML = xhr.responseText;
//         }
//     }
//     // eksekusi ajax
//     xhr.open('GET', 'ajax/mahasiswa.php?keyword=' + keyword.value, true)
//     xhr.send()
// });

// Versi Jquery

$(document).ready(function () {
    $('#keyword').on('keyup', function () {
        $('.loader').show();
        $.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(),
            function (data) {
              $('#container').html(data); 
              $('.loader').hide(); 
            },
        );
    })
});