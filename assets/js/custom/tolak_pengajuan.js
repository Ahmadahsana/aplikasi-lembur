    var tbody = document.querySelector("tbody")
    let penanda = 0
    let angkaUrut = 1
    let tombol_tolak = dataDetail.length
    tbody.addEventListener("click", function(event) {

        if (event.target.id == "tolak") {
            var keterangan = prompt("ALASAN Tolak karyawan ini?");
            if (keterangan == null) {
                // console.log('cancel');
            } else {
                var ok = event.target.parentElement.parentElement;
                var iya = ok.querySelector('input');
                var isinama = iya.getAttribute('value');
                // console.log(isinama);

                var idform = `<?= $form['id'] ?>`;

                let idDetail = event.target.parentElement.children[0].value;

                let index = dataDetail.findIndex(dd => dd.id == idDetail);

                let dataIni = dataDetail[index]

                // console.log(dataIni);
                // $.ajax({
                //     type: "post",
                //     url: `<?= base_url('form/tambah_tolak/') ?>`,
                //     data: {
                //         nama: isinama,
                //         idform: idform,
                //         keterangan: keterangan
                //     },
                //     success: function(response) {
                //         console.log(response);
                //         event.target.parentElement.parentElement.remove();
                //     }
                // });


                if (penanda == 0) {
                    var list_tolak = document.querySelector('#list_tolak');
                    $(list_tolak).append(`<div class="card">
                                        <div class="card-body">
                                        <h4>Daftar Tolak</h4>
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Nama</th>
                                                        <th scope="col">NIK</th>
                                                        <th scope="col">No order</th>
                                                        <th scope="col" style="width: 140px;">Jam mulai</th>
                                                        <th scope="col" style="width: 140px;">Jam selesai</th>
                                                        <th scope="col">Bagian</th>
                                                        <th scope="col">Alasan</th>
                                                        <th scope="col">Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="number" id="dataTolak">
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        </div>`)
                }

                $('#dataTolak').append(`<tr class="urut">
                                                        <th scope="row" class="angka">${angkaUrut}</th>
                                                        <td>
                                                            <input type="hidden" id="id_detail" class="form-control" value="" readonly>
                                                            ${dataIni.nama_user}
                                                        </td>
                                                        <td>${dataIni.nik}</td>
                                                        <td>${dataIni.no_order}</td>
                                                        <td>${dataIni.jam_mulai}</td>
                                                        <td>${dataIni.jam_selesai}</td>
                                                        <td>${dataIni.bagian}</td>
                                                        <td>${dataIni.alasan}</td>
                                                        <td>
                                                            ${keterangan}
                                                            <input type="text" name="id_detail_tolak[]" class="form-control d-none" value="${dataIni.id}" readonly>
                                                            <input type="text" name="id_form_tolak[]" class="form-control d-none" value="${dataIni.id_form}" readonly>
                                                            <input type="text" name="nama_tolak[]" class="form-control d-none" value="${dataIni.nama_user}" readonly>
                                                            <input type="text" name="nik_tolak[]" class="form-control d-none" value="${dataIni.nik}" readonly>
                                                            <input type="time" class="form-control d-none" id="jam_mulai" name="jam_mulai_tolak[]" value="${dataIni.jam_mulai}">
                                                            <input type="time" class="form-control d-none" id="jam_selesai" name="jam_selesai_tolak[]" value="${dataIni.jam_selesai}">
                                                            <input type="text" class="form-control d-none" id="departemen" name="departemen_tolak[]" value="${dataIni.departemen}">
                                                            <input type="text" class="form-control d-none" id="status_kar" name="status_kar_tolak[]" value="${dataIni.status_kar}">
                                                            <input type="text" name="no_order_tolak[]" class="form-control d-none" value="${dataIni.no_order}">
                                                            <input type="text" class="form-control d-none" id="bagian" name="bagian_tolak[]" value="${dataIni.bagian}">
                                                            <input type="text" class="form-control d-none" id="alasan" name="alasan_tolak[]" value="${dataIni.alasan}">
                                                            <input type="text" class="form-control d-none" id="status" name="status_tolak[]" value="${dataIni.status}">
                                                            <input type="text" class="form-control d-none" id="keterangan" name="keterangan_tolak[]" value="${keterangan}">
                                                        </td>
                                                    </tr>`);
                penanda++
                angkaUrut++
                tombol_tolak--
                event.target.parentElement.parentElement.remove();

                if (tombol_tolak == 0) {
                    $('#submit').remove()
                    $('#wadah_submit').append('<button type="submit" id="submit" class="btn btn-danger mr-3">Tolak pengajuan</button>')
                }
            }

        }
    })