<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="d-flex">
        <div class="border border-1 mw-100 px-4 mx-2">
            <div class="p-2">
                Kas Masuk
            </div>
            <div class="my-3 mx-5">
                {{ number_format($total_kas->kas_masuk, 0, ',', '.') }}
            </div>
        </div>
        <div class="border border-1 mw-100 px-4 mx-2">
            <div class="p-2">
                Kas Keluar
            </div>
            <div class="my-3 mx-5">
                {{ number_format($total_kas->kas_keluar, 0, ',', '.') }}
            </div>
        </div>
        <div class="border border-1 mw-100 px-4 mx-2">
            <div class="p-2">
                Kas Masuk
            </div>
            <div class="my-3 mx-5">
                {{ number_format($saldo_akhir, 0, ',', '.') }}
            </div>
        </div>
    </div>
</div>
