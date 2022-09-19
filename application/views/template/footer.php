</div>
<!-- End of Content -->
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="sidebarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="sidebarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content bg-danger poppins-light">
            <div class="modal-body">
                <div class="row p-0 text-light">
                    <div class="col-12 text-end">
                        <a class="btn-transparent text-light" data-bs-dismiss="modal" aria-label="Close">
                            <span class="fas fa-times fs-5"></span>
                        </a>
                    </div>
                </div>
                <div class="row p-4">
                    <!-- Sidebar pilih kategori -->
                    <div class="row px-2">
                        <label for="" class="text-white text-start mb-1">Pilih Kategori : </label>
                        <select id="seachable-select" class="w-100 changeFunc" onchange="changeFunc();">
                            <option data-display="Select" disabled>Choose one</option>
                            <option value="kabupaten">Kabupaten</option>
                            <option value="kecamatan">Kecamatan</option>
                            <option value="kelurahan">Kelurahan</option>
                        </select>
                    </div>
                    <!-- Sidebar pilihan setelah kategori -->
                    <div class="row px-2 mt-3 selectboxChange">
                        <label for="" class="text-white text-start mb-1">Pilih : </label>
                        <select id="seachable-select-two" class="w-100 selectbox-details">
                            <option data-display="Select" disabled>Type category first</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="<?= base_url(); ?>/assets/vendor/bs5-beta/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>/assets/vendor/niceselect/js/nice-select2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
<script src="<?= base_url(); ?>/assets/js/dashboard.js"></script>
<!-- <script src="<?= base_url(); ?>/assets/vendor/chartist/dist/chartist.min.js"></script> -->

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"
        integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj"
        crossorigin="anonymous"></script> -->
</body>

</html>