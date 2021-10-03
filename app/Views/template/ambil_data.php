<script>
    function ambilDataOrtu() {
        let nokk = $('#id_keluarga').val();
        if (nokk.split('').length > 0) {
            $.ajax({
                url: "<?= base_url('lahir/ortu') ?>/" + nokk,
                method: "POST",
                dataType: "JSON",
                success: function(response) {
                    $('#nm_ayah').val(response.nm_ayah);
                    $('#nm_ibu').val(response.nm_ibu);
                    $('#nik_ayah').val(response.nik_ayah);
                    $('#nik_ibu').val(response.nik_ibu);
                }
            });
        }
    }

    function ambilNama() {
        let id = $('#id_penduduk').val();
        if (id.split('').length > 0) {
            $.ajax({
                url: "<?= base_url('mati/nama') ?>/" + id,
                method: "POST",
                dataType: "JSON",
                success: function(response) {
                    $('#nama').val(response.nama);
                }
            });
        }
    }

    function surat() {
        var id = $('#jenis').val();
        if (id === "SKTM" || id === "SKPO") {
            document.getElementById("divtambah").style.display = "";
            document.getElementById("divjamkes").style.display = "none";
            document.getElementById("tambahan").attributes["type"].value = "number";
            $('#labeltambahan').text("Penghasilan orang tua");
            $('#tambahan').attr("placeholder", "Masukkan penghasilan orang tua").placeholder();
        } else if (id === "SKM") {
            document.getElementById("divtambah").style.display = "";
            document.getElementById("divjamkes").style.display = "";
            document.getElementById("tambahan").attributes["type"].value = "number";
            $('#labeltambahan').text("Penghasilan orang tua");
            $('#tambahan').attr("placeholder", "Masukkan penghasilan orang tua").placeholder();
        } else if (id === "SKU") {
            document.getElementById("divtambah").style.display = "";
            document.getElementById("divjamkes").style.display = "none";
            document.getElementById("tambahan").attributes["type"].value = "text";
            $('#labeltambahan').text("Jenis usaha");
            $('#tambahan').attr("placeholder", "Masukkan jenis usaha").placeholder();
        } else {
            document.getElementById("divtambah").style.display = "none";
            document.getElementById("divjamkes").style.display = "none";
        }
    }

    function nik() {
        let id = $('#id_keluarga').val();
        if (id.split('').length > 0) {
            $.ajax({
                url: "<?= base_url('sku/getnik') ?>/" + id,
                method: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    var html = '';
                    var i;
                    html += '<option value="">Pilih NIK</option>';
                    for (i = 0; i < response.length; i++) {
                        html += '<option value="' + response[i].id_penduduk + '">' + response[i].nik + ' - ' + response[i].nama + '</option>';
                    }
                    $('#id_penduduk').html(html);
                }
            });
        }
    }

    function nikmati() {
        let id = $('#id_keluarga').val();
        if (id.split('').length > 0) {
            $.ajax({
                url: "<?= base_url('mati/getnik') ?>/" + id,
                method: "POST",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    var html = '';
                    var i;
                    html += '<option value="">Pilih NIK</option>';
                    for (i = 0; i < response.length; i++) {
                        html += '<option value="' + response[i].id_penduduk + '">' + response[i].nik + ' - ' + response[i].nama + '</option>';
                    }
                    $('#id_penduduk').html(html);
                }
            });
        }
    }

    function ambilnik() {
        let id = $('#id_penduduk').val();
        if (id.split('').length > 0) {
            $.ajax({
                url: "<?= base_url('user/nik') ?>/" + id,
                method: "POST",
                dataType: "JSON",
                success: function(response) {
                    $('#username').val(response.nik);
                }
            });
        }
    }

    function previewImg() {
        const foto = document.querySelector('#fotoo');
        const imgPreview = document.querySelector('.img-preview');
        const label = document.querySelector('.custom-file-label');

        label.textContent = foto.files[0].name;

        const file = new FileReader();
        file.readAsDataURL(foto.files[0]);

        file.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewImg1() {
        const foto = document.querySelector('#foto1');
        const imgPreview = document.querySelector('.img_prev1');
        const label = document.querySelector('.img_lab1');

        label.textContent = foto.files[0].name;

        const file = new FileReader();
        file.readAsDataURL(foto.files[0]);

        file.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }

    function previewImg2() {
        const foto = document.querySelector('#foto2');
        const imgPreview = document.querySelector('.img_prev2');
        const label = document.querySelector('.img_lab2');
        label.textContent = foto.files[0].name;

        const file = new FileReader();
        file.readAsDataURL(foto.files[0]);

        file.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>