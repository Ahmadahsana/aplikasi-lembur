let tombol_add = document.querySelector('#addrole');
let role = document.querySelector('.role');
let arrow = document.getElementById('arrow')
let isi = `<div class="form-group row ">
<label for="inputPassword3" class="col-sm-2 col-form-label"></label>
<div class="col-sm-10">
    <select name="role" id="role" class="custom-select">
        <?php foreach ($role as $r) : ?>
            <option value="<?= $r['id'] ?>" <?php if ($r['id'] == $useredit['role_id']) {
                                                echo 'selected';
                                            } ?>><?= $r['role'] ?></option>
        <?php endforeach ?>
    </select>
</div>
</div>`;
// console.log(tombol_add);

tombol_add.addEventListener('click', function (e) {
    console.log('hai');
    role.toggleAttribute("hidden");
    // let kelas = tombol_add.className;

});

// let hapus = document.querySelector('#hapus');

// hapus.addEventListener('click', function (e) {
//     console.log('hapus');
// });

function remove(event) {
    // console.log(event);

    let yakin = confirm(`Apakah anda yakin ingin menghapus role dari user`);

    if (yakin) {
        let tombol = document.querySelector(`#hapus${event}`)
        console.log(tombol);
        tombol.parentElement.remove();

        // ini ajax cuy

        var xhr = new XMLHttpRequest();
        var url = base_url + "admin/hapus_role?id=" + event;

        var data = JSON.stringify({
            "id": 'event'
        });

        xhr.open("get", url, true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        xhr.onload = function () {
            console.log(this.responseText);
        };

        xhr.send(data);
        return false;
    }

}

