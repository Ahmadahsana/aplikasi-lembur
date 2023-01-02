
$('table').on('change', 'tr', function(e) {
    let indexRow = this.rowIndex
    if (e.target.name == "jam_selesai[]") {
        console.log(indexRow);
        // console.log(e.target.parentElement.parentElement.childNodes[5].childNodes[0].value);
        var selesai = e.target.value
        var mulai = e.target.parentElement.parentElement.childNodes[5].childNodes[0].value;

        var Start = cekJamMulai(mulai);
        var End = cekJamSelesai(selesai);
        
        var selisih_jam = End - Start
        
        if (selisih_jam > 0) {
            var jadi_jam = selisih_jam / (1000 * 60 * 60)
            e.target.parentElement.parentElement.childNodes[13].childNodes[0].value = jadi_jam
        } else {
            var jadi_jam = (selisih_jam + 86400000) / (1000 * 60 * 60)
            e.target.parentElement.parentElement.childNodes[13].childNodes[0].value = jadi_jam
        }


        if (jadi_jam <= 1) {
            var jam_per_user = (jadi_jam * 1.5) * 13500 ;
            // console.log(jam_per_user);
        } else if (jadi_jam > 1) {
            var jam_a = (1 * 1.5) * 13500
            var jam_b = (jadi_jam - 1) * 2 * 13500 ;
            var jam_per_user = jam_a + jam_b
            // console.log(jam_per_user);
        }

        total_harga_lembur.splice(indexRow-1, 1, jam_per_user)

        // console.log(total_harga_lembur);

        var hasil_jumlah_tarif = total_harga_lembur.reduce((a, b) => a + b, 0);

        $('#total_tarif_lembur').html(Rupiah.format( hasil_jumlah_tarif));

    }
})
