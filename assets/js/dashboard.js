var base_url = 'https://kerja-praktek.herokuapp.com/'

var options = {
    searchable: true
};
// search dropdown 1
// plugin NiceSelect, selectbox yang bisa disearch
NiceSelect.bind(document.getElementById("seachable-select"), options);


// Loaded content first time
// or when reloaded page
document.addEventListener('DOMContentLoaded', () => {
    // Call function showData on loaded content
    showData();
    // init datatable
    if (document.getElementById("seachable-select-two")) {
        NiceSelect.bind(document.getElementById("seachable-select-two"), options);
    }
    if (document.getElementById("seachable-select-three")) {
        NiceSelect.bind(document.getElementById("seachable-select-three"), options);
    }
});

// Load data for the first time
async function showData() {
    try {
        const response = await fetch(`${base_url}/home/getData/`, {
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest"
            }
        });
        const data = await response.json();
        const tableData = document.querySelector('.contentData')
        let rowData = "";
        let number = 1;
        rowData += `
        <table class='table table-striped' id='myTable'>
            <thead>
                <tr class= "text-center align-self-center">
                    <th scope="col"></th>
                    <th scope="col">Kelurahan</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kabupaten</th>
                    <th width="300px" style="white-space:nowrap" scope="col">Penduduk (ribu)</th>
                    <th width="300px" style="white-space:nowrap" scope="col">Luas Wilayah (&#13218;)</th>
                    <th width="300px" style="white-space:nowrap" scope="col">Kepadatan Penduduk (penduduk/&#13218;)</th>
                    <th width="300px" style="white-space:nowrap" scope="col">Jumlah Pelanggan</th>
                    <th width="300px" style="white-space:nowrap" scope="col">Revenue (juta)</th>
                    <th width="300px" style="white-space:nowrap" scope="col">Outlet Existing</th>
                    <th width="300px" style="white-space:nowrap" scope="col">Outlet Terbaik</th>
                    <th scope="col">Efektivitas</th>
                </tr>
            </thead>
            <tbody>
        `;
        data.forEach(({
            kabupaten,
            kecamatan,
            kelurahan,
            jumlahpenduduk,
            luaswilayah,
            tingkatkepadatan,
            jumlahpelanggan,
            revenue,
            jumlahoutlet,
            outletterbaik,
            efektivitas,
        }) => {
            rowData += `<tr class="text-left align-left">`;
            rowData += `<td>${number++}</td>`;
            rowData += `<td>${kelurahan}</td>`;
            rowData += `<td>${kecamatan}</td>`;
            rowData += `<td>${kabupaten}</td>`;
            rowData += `<td>${numberWithCommas(jumlahpenduduk)}</td>`;
            rowData += `<td style="width:70% white-space:nowrap">${roundValue(luaswilayah)}</td>`;
            rowData += `<td>${tingkatkepadatan}</td>`;
            rowData += `<td>${numberWithCommas(jumlahpelanggan)}</td>`;
            rowData += `<td>${numberWithCommas(revenue)}</td>`;
            rowData += `<td>${jumlahoutlet}</td>`;
            rowData += `<td>${outletterbaik}</td>`;
            rowData += `<td>${efektivitas}</td>`;
            rowData += `</tr>`;
        });
        rowData += `</tbody></table>`
        tableData.innerHTML = rowData;

        // Plugin dataTable
        var dataTable = new DataTable("#myTable");
    } catch (err) {
        console.log(err);
    }
}

// Change function select 1 and get select 2 value
async function changeFunc(e) {
    //ambil this dari changeFunc di header, pilih array/index di option, ambil valuenya -> kabupaten/kecamatan/kelurahab
    var selectedValue = e.options[e.selectedIndex].value;
    console.log(e.selectedIndex)
    // console.log(selectedValue)
    if (selectedValue != 'kelurahan') {
        if (selectedValue != 'all') {
            let response = await fetch(`${base_url}/home/getKategori/${selectedValue}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: 'GET',
        });
            
        // you can check for response.ok here, and literally just throw an error if you want
        const data = await response.json();
        // console.log(data)
        let rowData = "";
        rowData += "<label class='text-white text-start mb-1'>Pilih : </label><select id='seachable-select-two' class='w-100 selectbox-details' onchange='changeData();'><option data-display='Select' disabled>Choose one</option>";
        data.forEach(({
            data,
        }) => {
            rowData += `<option value="${data}">${data}</option>`;
        });
        rowData += '</select>'
        //isikan option sesuai data yg diambil, dengan ubah tampilan html sesuai rowData
        document.querySelector('.selectboxChange').innerHTML = rowData;

        // search dropdown 2
        NiceSelect.bind(document.getElementById("seachable-select-two"), options);

        // get parameter first category
        document.querySelector('.selectbox-details li').setAttribute("data-value", selectedValue)

        // kalau mau pakai cara hidden box
        document.querySelector('.selectboxChange').classList.remove('d-none');
        document.querySelector('.selectEfektivitas').classList.add('d-none');
            
        } else {
            let response = await fetch(`${base_url}/home/getData/`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: 'GET',
            });
            // you can check for response.ok here, and literally just throw an error if you want
            const data = await response.json();
            // console.log(data)
            let rowData = "";
            rowData += "<label class='text-white text-start mb-1'>Pilih : </label><select id='seachable-select-two' class='w-100 selectbox-details' onchange='changeData();'><option data-display='Select' disabled>Choose one</option>";
            data.forEach(({
                data,
            }) => {
                rowData += `<option value="${data}">${data}</option>`;
            });
            rowData += '</select>'
            //isikan option sesuai data yg diambil, dengan ubah tampilan html sesuai rowData
            document.querySelector('.selectboxChange').innerHTML = rowData;

            // search dropdown 2
            NiceSelect.bind(document.getElementById("seachable-select-two"), options);

            // get parameter first category
            document.querySelector('.selectbox-details li').setAttribute("data-value", selectedValue)
            
            // kalau mau pakai cara hidden box
            document.querySelector('.selectboxChange').classList.add('d-none');
            document.querySelector('.selectEfektivitas').classList.remove('d-none');
        }        
    } else {
        let response = await fetch(`${base_url}/home/getKelurahan`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: 'GET',
        });
        // you can check for response.ok here, and literally just throw an error if you want
        const data = await response.json();
        // console.log(data)
        let rowData = "";
        rowData += "<label class='text-white text-start mb-1'>Pilih : </label><select id='seachable-select-two' class='w-100 selectbox-details' onchange='changeData();'><option data-display='Select' disabled>Choose one</option>";
        data.forEach(({
            kelurahan,
            kecamatan,
        }) => {
            rowData += `<option value="${kelurahan} ${kecamatan}">${kelurahan}, ${kecamatan}</option>`;
        });
        rowData += '</select>'
        document.querySelector('.selectboxChange').innerHTML = rowData;

        // search dropdown 2
        NiceSelect.bind(document.getElementById("seachable-select-two"), options);

        // get parameter first category, ngisi data di selectbox
        document.querySelector('.selectbox-details li').setAttribute("data-value", selectedValue)

        // kalau mau pakai cara hidden box
        document.querySelector('.selectboxChange').classList.remove('d-none');
        document.querySelector('.selectEfektivitas').classList.add('d-none');
    }
}

// Submit value to geting data
async function changeData() {
    document.querySelector('.selectEfektivitas').classList.add('d-none');
    // ambil selectbox-details -> class selectbox nama daerah yg udah diganti di rowData
    var selectChange = document.querySelector(".selectbox-details");
    // dibawah ini buat get nama kategori
    var selectCategory = document.querySelector(".selectbox-details ul > li:first-child").getAttribute('data-value');
    console.log(selectCategory)
    document.querySelector('.selectbox-efektivitas').setAttribute('data-kategori', selectCategory);

    var selectedValue = selectChange.options[selectChange.selectedIndex].value;
    console.log(selectedValue)
        // dibawah ini buat ngganti nama kategori yang ada space jadi /
    var selectedKelurahan = selectedValue.replace(/\s+/g, '/').toUpperCase()
    var selectedKabupaten = selectedValue.replace(/\s+/g, '-').toUpperCase()

    // ini buat dapetin value dari kategori
    document.querySelector('.selectbox-efektivitas').setAttribute('data-valueKategori', selectedKabupaten)

    if (selectCategory != 'kelurahan') {

        let response = await fetch(`${base_url}/home/getDetails/${selectCategory}/${selectedKabupaten}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: 'GET',
        });
        // you can check for response.ok here, and literally just throw an error if you want
        const data = await response.json();
        const tableData = document.querySelector('.contentData')
        let rowData = "";
        let number = 1;
        rowData += `
            <table class='table table-striped' id='myTable'>
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Kelurahan</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kabupaten</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Penduduk (ribu)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Luas Wilayah (&#13218;)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Kepadatan Penduduk (penduduk/&#13218;)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Jumlah Pelanggan</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Revenue (juta)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Outlet Existing</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Outlet Terbaik</th>
                        <th scope="col">Efektivitas</th>
                    </tr>
                </thead>
                <tbody>
            `;
        data.forEach(({
            kabupaten,
            kecamatan,
            kelurahan,
            jumlahpenduduk,
            luaswilayah,
            tingkatkepadatan,
            jumlahpelanggan,
            revenue,
            jumlahoutlet,
            outletterbaik,
            efektivitas,
        }) => {
            rowData += `<tr class="text-left align-left">`;
            rowData += `<td>${number++}</td>`;
            rowData += `<td>${kelurahan}</td>`;
            rowData += `<td>${kecamatan}</td>`;
            rowData += `<td>${kabupaten}</td>`;
            rowData += `<td>${numberWithCommas(jumlahpenduduk)}</td>`;
            rowData += `<td>${roundValue(luaswilayah)}</td>`;
            rowData += `<td>${tingkatkepadatan}</td>`;
            rowData += `<td>${numberWithCommas(jumlahpelanggan)}</td>`;
            rowData += `<td>${numberWithCommas(revenue)}</td>`;
            rowData += `<td>${jumlahoutlet}</td>`;
            rowData += `<td>${outletterbaik}</td>`;
            rowData += `<td>${efektivitas}</td>`;
            rowData += `</tr>`;
        });
        rowData += `</tbody></table>`
        tableData.innerHTML = rowData;

        document.getElementById('changeVB').className = "container mt-5 d-none";
        // Memunculkan/render selectbox efektivitas
        document.querySelector('.selectEfektivitas').classList.remove('d-none');
        var dataTable = new DataTable("#myTable");
    } else {
        let response = await fetch(`${base_url}/home/getNamaKelurahan/${selectedKelurahan}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: 'GET',
        });
        // you can check for response.ok here, and literally just throw an error if you want
        const data = await response.json();
        // console.log(data)
        const tableData = document.querySelector('.contentData')
        let rowData = "";
        let number = 1;
        rowData += `
            <table class='table table-striped' id='myTable'>
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Kelurahan</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kabupaten</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Penduduk (ribu)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Luas Wilayah (&#13218;)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Kepadatan Penduduk (penduduk/&#13218;)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Jumlah Pelanggan</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Revenue (juta)</th>
                        <th scope="col">Outlet Existing</th>
                    </tr>
                </thead>
                <tbody>
            `;
        data.forEach(({
            kabupaten,
            kecamatan,
            kelurahan,
            jumlahpenduduk,
            luaswilayah,
            tingkatkepadatan,
            jumlahpelanggan,
            revenue,
            jumlahoutlet,
        }) => {
            rowData += `<tr class="text-left align-left">`;
            rowData += `<td>${number++}</td>`;
            rowData += `<td>${kelurahan}</td>`;
            rowData += `<td>${kecamatan}</td>`;
            rowData += `<td>${kabupaten}</td>`;
            rowData += `<td>${numberWithCommas(jumlahpenduduk)}</td>`;
            rowData += `<td>${roundValue(luaswilayah)}</td>`;
            rowData += `<td>${tingkatkepadatan}</td>`;
            rowData += `<td>${numberWithCommas(jumlahpelanggan)}</td>`;
            rowData += `<td>${numberWithCommas(revenue)}</td>`;
            rowData += `<td>${jumlahoutlet}</td>`;
            rowData += `</tr>`;
        });
        rowData += `</tbody></table>`
        tableData.innerHTML = rowData;

        document.querySelector('.outletChange').innerHTML = data[0]['outletterbaik'];
        document.querySelector('.efektivitasChange').innerHTML = data[0]['efektivitas'];

        document.getElementById('changeVB').className = "container mt-5 d-block";

        document.querySelector('.selectEfektivitas').classList.add('d-none');
        var dataTable = new DataTable("#myTable");
    }
}

async function changeEfektivitas(e) {
    
    if(document.querySelector('.selectbox-details li').getAttribute("data-value", 'all')){
        
        var selectedValue = e.options[e.selectedIndex].value;

        let response = await fetch(`${base_url}/home/getDetailsAllEfektivitas/${selectedValue}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: 'GET',
        });
        // you can check for response.ok here, and literally just throw an error if you want
        const data = await response.json();
        if (data) {
            document.getElementById('changeVB').className = "container mt-5 d-none";
        } else {
            document.getElementById('changeVB').className = "container mt-5 d-block";
        }
        // console.log(data)
        const tableData = document.querySelector('.contentData')
        let rowData = "";
        let number = 1;
        rowData += `
            <table class='table table-striped' id='myTable'>
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Kelurahan</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kabupaten</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Penduduk (ribu)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Luas Wilayah (&#13218;)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Kepadatan Penduduk (penduduk/&#13218;)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Jumlah Pelanggan</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Revenue (juta)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Outlet Existing</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Outlet Terbaik</th>
                        <th scope="col">Efektivitas</th>
                    </tr>
                </thead>
                <tbody>
            `;
        data.forEach(({
            kabupaten,
            kecamatan,
            kelurahan,
            jumlahpenduduk,
            luaswilayah,
            tingkatkepadatan,
            jumlahpelanggan,
            revenue,
            jumlahoutlet,
            outletterbaik,
            efektivitas,
        }) => {
            rowData += `<tr class="text-left align-left">`;
            rowData += `<td>${number++}</td>`;
            rowData += `<td>${kelurahan}</td>`;
            rowData += `<td>${kecamatan}</td>`;
            rowData += `<td>${kabupaten}</td>`;
            rowData += `<td>${numberWithCommas(jumlahpenduduk)}</td>`;
            rowData += `<td>${roundValue(luaswilayah)}</td>`;
            rowData += `<td>${tingkatkepadatan}</td>`;
            rowData += `<td>${numberWithCommas(jumlahpelanggan)}</td>`;
            rowData += `<td>${numberWithCommas(revenue)}</td>`;
            rowData += `<td>${jumlahoutlet}</td>`;
            rowData += `<td>${outletterbaik}</td>`;
            rowData += `<td>${efektivitas}</td>`;
            rowData += `</tr>`;
        });
        rowData += `</tbody></table>`
        tableData.innerHTML = rowData;

        var dataTable = new DataTable("#myTable");
    } else {
        // display kategori
        var selectedKategori = document.querySelector('.selectbox-efektivitas').getAttribute('data-kategori');
        // display value dari kategori
        var valueKategori = document.querySelector('.selectbox-efektivitas').getAttribute('data-valuekategori');
        // display efektivitas
        var selectedValue = e.options[e.selectedIndex].value;

        if (selectedKategori == 'kabupaten') {
            valueKategori = valueKategori + '-kabupaten'
        }
        if (selectedKategori == 'kecamatan') {
            valueKategori = valueKategori + '-kecamatan'
        }
        console.log(selectedKategori, valueKategori, selectedValue)
    //    console.log(`${base_url}/home/getDetailsEfektivitas/${selectedKategori}/${valueKategori}/${selectedValue}`)
        let response = await fetch(`${base_url}/home/getDetailsEfektivitas/${selectedKategori}/${valueKategori}/${selectedValue}`, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            method: 'GET',
        });
        // you can check for response.ok here, and literally just throw an error if you want
        const data = await response.json();
        if (data) {
            document.getElementById('changeVB').className = "container mt-5 d-none";
        } else {
            document.getElementById('changeVB').className = "container mt-5 d-block";
        }
        // console.log(data)
        const tableData = document.querySelector('.contentData')
        let rowData = "";
        let number = 1;
        rowData += `
            <table class='table table-striped' id='myTable'>
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Kelurahan</th>
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kabupaten</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Penduduk (ribu)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Luas Wilayah (&#13218;)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Kepadatan Penduduk (penduduk/&#13218;)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Jumlah Pelanggan</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Revenue (juta)</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Outlet Existing</th>
                        <th width="300px" style="white-space:nowrap" scope="col">Outlet Terbaik</th>
                        <th scope="col">Efektivitas</th>
                    </tr>
                </thead>
                <tbody>
            `;
        data.forEach(({
            kabupaten,
            kecamatan,
            kelurahan,
            jumlahpenduduk,
            luaswilayah,
            tingkatkepadatan,
            jumlahpelanggan,
            revenue,
            jumlahoutlet,
            outletterbaik,
            efektivitas,
        }) => {
            rowData += `<tr class="text-left align-left">`;
            rowData += `<td>${number++}</td>`;
            rowData += `<td>${kelurahan}</td>`;
            rowData += `<td>${kecamatan}</td>`;
            rowData += `<td>${kabupaten}</td>`;
            rowData += `<td>${numberWithCommas(jumlahpenduduk)}</td>`;
            rowData += `<td>${roundValue(luaswilayah)}</td>`;
            rowData += `<td>${tingkatkepadatan}</td>`;
            rowData += `<td>${numberWithCommas(jumlahpelanggan)}</td>`;
            rowData += `<td>${numberWithCommas(revenue)}</td>`;
            rowData += `<td>${jumlahoutlet}</td>`;
            rowData += `<td>${outletterbaik}</td>`;
            rowData += `<td>${efektivitas}</td>`;
            rowData += `</tr>`;
        });
        rowData += `</tbody></table>`
        tableData.innerHTML = rowData;

        var dataTable = new DataTable("#myTable");
    }
    
}


function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function roundValue(x) {
    var round = x;
    //    console.log(round);
    return parseFloat(round).toFixed(2);
}

// add sidebar
async function addSidebar() {
    var element = document.querySelector(".responsive-sidebar");
    element.classList.add("open");
}

async function closeSidebar() {
    var element = document.querySelector(".responsive-sidebar");
    element.classList.remove("open");
}