<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Checkout | Shoestep</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-900">
    <div class="mx-auto min-h-screen max-w-7xl px-6 py-10">
        <div class="mb-8 rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-cyan-700">Checkout</p>
                    <h1 class="mt-3 text-4xl font-black text-slate-950">Bayar Sekarang dengan Mudah</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">Pilih metode pembayaran favoritmu dan selesaikan pesanan dengan tampilan yang elegan dan informatif.</p>
                </div>
                <a href="/" class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    ← Kembali ke produk
                </a>
            </div>
        </div>

        <div class="grid gap-8 xl:grid-cols-[1.45fr_0.95fr]">
            <section class="space-y-8 rounded-[2rem] bg-white p-8 shadow-sm">
                <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-[0.33em] text-slate-500">Ringkasan Pesanan</p>
                            <h2 class="mt-2 text-2xl font-black text-slate-950">Detail Barang</h2>
                        </div>
                        <span class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm">{{ date('d M Y') }}</span>
                    </div>
                    <div id="checkout-items" class="mt-6 space-y-4"></div>
                </div>

                <div class="rounded-[2rem] border border-slate-200 p-6 shadow-sm">
                    <div class="mb-6 flex items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-[0.33em] text-slate-500">Metode Pembayaran</p>
                            <h3 class="mt-2 text-xl font-black text-slate-950">Pilih layanan yang kamu suka</h3>
                        </div>
                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.28em] text-emerald-700">Aman & Cepat</span>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <button type="button" class="payment-option group rounded-[1.75rem] border border-slate-200 bg-white p-5 text-left transition hover:border-slate-900" data-method="Bank Transfer">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-white">BT</span>
                                <div>
                                    <p class="text-sm font-semibold text-slate-950">Bank Transfer</p>
                                    <p class="mt-1 text-xs text-slate-500">Transfer manual lewat bank atau mobile banking</p>
                                </div>
                            </div>
                        </button>
                        <button type="button" class="payment-option group rounded-[1.75rem] border border-slate-200 bg-white p-5 text-left transition hover:border-slate-900" data-method="E-Wallet">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-700 text-white">EW</span>
                                <div>
                                    <p class="text-sm font-semibold text-slate-950">E-Wallet</p>
                                    <p class="mt-1 text-xs text-slate-500">Dukung GO-PAY, OVO, DANA, dan QRIS</p>
                                </div>
                            </div>
                        </button>
                        <button type="button" class="payment-option group rounded-[1.75rem] border border-slate-200 bg-white p-5 text-left transition hover:border-slate-900" data-method="Credit Card">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-500 text-white">CC</span>
                                <div>
                                    <p class="text-sm font-semibold text-slate-950">Credit Card</p>
                                    <p class="mt-1 text-xs text-slate-500">Visa, Mastercard, dan JCB</p>
                                </div>
                            </div>
                        </button>
                        <button type="button" class="payment-option group rounded-[1.75rem] border border-slate-200 bg-white p-5 text-left transition hover:border-slate-900" data-method="Cash on Delivery">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-950 text-white">COD</span>
                                <div>
                                    <p class="text-sm font-semibold text-slate-950">COD</p>
                                    <p class="mt-1 text-xs text-slate-500">Bayar saat barang sampai</p>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div id="payment-suboptions" class="mt-6 hidden rounded-[1.75rem] border border-slate-200 bg-slate-50 p-5">
                        <p class="text-sm font-semibold text-slate-950">Pilih opsi pembayaran</p>
                        <div id="suboption-list" class="mt-4 grid gap-4 sm:grid-cols-2"></div>
                    </div>

                    <div id="payment-details" class="mt-6 hidden rounded-[1.75rem] border border-slate-200 bg-slate-50 p-5 text-slate-950">
                        <p class="text-sm font-semibold text-slate-950" id="payment-details-title">Detail Pembayaran</p>
                        <div id="payment-details-body" class="mt-4 grid gap-3"></div>
                        <p id="payment-details-note" class="mt-4 text-sm text-slate-600"></p>
                    </div>
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <p class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-500">Catatan Tambahan</p>
                    <textarea id="checkout-note" rows="4" placeholder="Tulis pesan atau instruksi khusus untuk penjual..." class="mt-4 w-full resize-none rounded-3xl border border-slate-200 bg-white px-4 py-4 text-sm text-slate-900 outline-none transition focus:border-slate-900"></textarea>
                </div>
            </section>

            <aside class="space-y-6">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm uppercase tracking-[0.33em] text-slate-500">Ringkasan Pesanan</p>
                            <h2 class="mt-2 text-xl font-black text-slate-950">Total Pembayaran</h2>
                        </div>
                        <span id="selected-method" class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.28em] text-emerald-700">Bank Transfer</span>
                    </div>

                    <div class="mt-6 space-y-4 text-sm text-slate-600">
                        <div class="flex items-center justify-between">
                            <span>Subtotal</span>
                            <span id="checkout-subtotal">Rp0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Diskon</span>
                            <span id="checkout-discount">Rp0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Biaya Layanan</span>
                            <span id="checkout-fee">Rp0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Ongkir</span>
                            <span>Gratis</span>
                        </div>
                    </div>

                    <div class="mt-6 rounded-[1.75rem] bg-slate-950 p-5 text-white shadow-sm">
                        <div class="flex items-center justify-between text-sm uppercase tracking-[0.28em] text-slate-300">
                            <span>Total</span>
                            <span id="checkout-total">Rp0</span>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-slate-300">Selesaikan pembayaran melalui layanan yang kamu pilih. Kami mendukung banyak opsi.</p>
                    </div>

                    <button id="confirm-order" class="mt-6 w-full rounded-full bg-slate-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                        Konfirmasi Pesanan
                    </button>
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-slate-950 p-6 text-white shadow-sm">
                    <p class="text-xs uppercase tracking-[0.33em] text-cyan-300">Pembayaran Aman</p>
                    <h3 class="mt-3 text-lg font-black">Layanan yang tersedia</h3>
                    <ul class="mt-5 space-y-3 text-sm leading-7 text-slate-300">
                        <li>• Bank Transfer dengan instruksi otomatis</li>
                        <li>• E-Wallet (GoPay, OVO, DANA, QRIS)</li>
                        <li>• Kartu Kredit / Debit</li>
                        <li>• Cash on Delivery untuk wilayah tertentu</li>
                    </ul>
                </div>
            </aside>
        </div>
    </div>

    <script>
        function formatRupiah(value) {
            return 'Rp' + Number(value || 0).toLocaleString('id-ID');
        }

        var selectedPaymentMethod = 'Bank Transfer';
        var selectedPaymentOption = 'BCA';
        var paymentOptions = [];
        var paymentMethods = {
            'Bank Transfer': {
                options: [
                    { value: 'BCA', label: 'BCA' },
                    { value: 'Mandiri', label: 'Mandiri' },
                    { value: 'BNI', label: 'BNI' }
                ],
                info: {
                    BCA: {
                        title: 'BCA',
                        type: 'Rekening Tujuan',
                        accountNumber: '1234567890',
                        accountName: 'PT SHOESTEP',
                        branch: 'Jakarta',
                        note: 'Transfer melalui BCA Mobile, ATM, atau internet banking.'
                    },
                    Mandiri: {
                        title: 'Mandiri',
                        type: 'Rekening Tujuan',
                        accountNumber: '9876543210',
                        accountName: 'PT SHOESTEP',
                        branch: 'Bandung',
                        note: 'Transfer melalui Mandiri Online atau ATM Mandiri.'
                    },
                    BNI: {
                        title: 'BNI',
                        type: 'Rekening Tujuan',
                        accountNumber: '1122334455',
                        accountName: 'PT SHOESTEP',
                        branch: 'Surabaya',
                        note: 'Transfer melalui BNI Mobile Banking atau ATM BNI.'
                    }
                },
                description: 'Gunakan nomor rekening yang tertera untuk menyelesaikan transfer.'
            },
            'E-Wallet': {
                options: [
                    { value: 'GoPay', label: 'GoPay' },
                    { value: 'OVO', label: 'OVO' },
                    { value: 'DANA', label: 'DANA' },
                    { value: 'QRIS', label: 'QRIS' }
                ],
                info: {
                    GoPay: {
                        title: 'GoPay',
                        type: 'Akun E-Wallet',
                        accountNumber: '0812-3456-7890',
                        accountName: 'PT SHOESTEP',
                        note: 'Buka aplikasi GoPay, pilih Kirim atau Scan dan transfer ke nomor tujuan.'
                    },
                    OVO: {
                        title: 'OVO',
                        type: 'Akun E-Wallet',
                        accountNumber: '0812-3456-7891',
                        accountName: 'PT SHOESTEP',
                        note: 'Gunakan transfer OVO ke nomor tujuan untuk menyelesaikan pembayaran.'
                    },
                    DANA: {
                        title: 'DANA',
                        type: 'Akun E-Wallet',
                        accountNumber: '0812-3456-7892',
                        accountName: 'PT SHOESTEP',
                        note: 'Bayar lewat aplikasi DANA dengan memasukkan nomor tujuan.'
                    },
                    QRIS: {
                        title: 'QRIS',
                        type: 'Kode QR',
                        code: 'SHOESTEP-QR-2026',
                        note: 'Scan atau tampilkan QRIS untuk membayar langsung dari aplikasi e-wallet.'
                    }
                },
                description: 'Bayar lewat e-wallet pilihanmu atau scan QRIS jika tersedia.'
            },
            'Credit Card': {
                options: [
                    { value: 'Visa', label: 'Visa' },
                    { value: 'Mastercard', label: 'Mastercard' },
                    { value: 'JCB', label: 'JCB' }
                ],
                info: {
                    Visa: {
                        title: 'Visa',
                        type: 'Kartu Kredit',
                        note: 'Masukkan nomor kartu, tanggal kadaluarsa, dan CVV di halaman pembayaran kartu.'
                    },
                    Mastercard: {
                        title: 'Mastercard',
                        type: 'Kartu Kredit',
                        note: 'Masukkan nomor kartu, tanggal kadaluarsa, dan CVV di halaman pembayaran kartu.'
                    },
                    JCB: {
                        title: 'JCB',
                        type: 'Kartu Kredit',
                        note: 'Masukkan nomor kartu, tanggal kadaluarsa, dan CVV di halaman pembayaran kartu.'
                    }
                },
                description: 'Isi detail kartu kredit di halaman pembayaran berikutnya.'
            },
            'Cash on Delivery': {
                options: [
                    { value: 'COD', label: 'Bayar Saat Barang Sampai' }
                ],
                info: {
                    COD: {
                        title: 'Cash on Delivery',
                        type: 'Pembayaran Tunai',
                        note: 'Siapkan uang tunai saat kurir mengantarkan pesanan ke alamatmu.'
                    }
                },
                description: 'Bayar langsung ketika pesanan tiba di alamatmu.'
            }
        };

        function renderCheckout() {
            var items = JSON.parse(localStorage.getItem('shoestep_checkout') || '[]');
            if (!items.length) {
                items = JSON.parse(localStorage.getItem('shoestep_cart') || '[]');
            }

            var container = document.getElementById('checkout-items');
            var subtotalEl = document.getElementById('checkout-subtotal');
            var totalEl = document.getElementById('checkout-total');
            var discountEl = document.getElementById('checkout-discount');
            var feeEl = document.getElementById('checkout-fee');
            var selectedMethodEl = document.getElementById('selected-method');
            var paymentSuboptionsEl = document.getElementById('payment-suboptions');

            if (!container) return;

            if (!items.length) {
                container.innerHTML = '<div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-sm text-slate-500">Tidak ada item untuk checkout.</div>';
                if (subtotalEl) subtotalEl.textContent = formatRupiah(0);
                if (totalEl) totalEl.textContent = formatRupiah(0);
                if (discountEl) discountEl.textContent = formatRupiah(0);
                if (feeEl) feeEl.textContent = formatRupiah(0);
                if (selectedMethodEl) selectedMethodEl.textContent = selectedPaymentMethod;
                if (paymentSuboptionsEl) paymentSuboptionsEl.classList.toggle('hidden', true);
                renderPaymentDetails();
                return;
            }

            var subtotal = items.reduce(function(sum, item) {
                return sum + (Number(item.price || 0) * Number(item.qty || 1));
            }, 0);
            var discount = 0;
            var fee = selectedPaymentMethod === 'Credit Card' ? Math.round(subtotal * 0.02) : 0;
            var total = subtotal - discount + fee;

            container.innerHTML = items.map(function(item) {
                return '<div class="flex items-center justify-between rounded-2xl border border-slate-200 p-4 shadow-sm">' +
                    '<div class="max-w-[70%]">' +
                        '<p class="font-semibold text-slate-950">' + (item.name || 'Produk') + '</p>' +
                        '<p class="mt-1 text-sm text-slate-500">Qty: ' + (item.qty || 1) + '</p>' +
                    '</div>' +
                    '<p class="font-semibold text-slate-950">' + formatRupiah((Number(item.price || 0) * Number(item.qty || 1))) + '</p>' +
                '</div>';
            }).join('');

            if (subtotalEl) subtotalEl.textContent = formatRupiah(subtotal);
            if (discountEl) discountEl.textContent = formatRupiah(discount);
            if (feeEl) feeEl.textContent = formatRupiah(fee);
            if (totalEl) totalEl.textContent = formatRupiah(total);
            if (selectedMethodEl) selectedMethodEl.textContent = selectedPaymentMethod + (selectedPaymentOption ? ' • ' + selectedPaymentOption : '');
            if (paymentSuboptionsEl) paymentSuboptionsEl.classList.toggle('hidden', false);
            renderPaymentDetails();
        }

        function renderPaymentDetails() {
            var details = document.getElementById('payment-details');
            var detailsBody = document.getElementById('payment-details-body');
            var detailsNote = document.getElementById('payment-details-note');
            if (!details || !detailsBody || !detailsNote) return;

            var methodInfo = paymentMethods[selectedPaymentMethod];
            if (!methodInfo) {
                details.classList.add('hidden');
                return;
            }

            var detailInfo = methodInfo.info[selectedPaymentOption] || Object.values(methodInfo.info)[0];
            details.classList.remove('hidden');
            detailsBody.innerHTML = '';

            if (detailInfo.type === 'Rekening Tujuan' || detailInfo.type === 'Akun E-Wallet') {
                detailsBody.innerHTML = '<div class="grid gap-3 sm:grid-cols-2">' +
                    '<div class="rounded-3xl bg-white p-4 shadow-sm">' +
                        '<p class="text-xs uppercase tracking-[0.28em] text-slate-500">Metode</p>' +
                        '<p class="mt-2 text-base font-semibold">' + detailInfo.title + '</p>' +
                    '</div>' +
                    '<div class="rounded-3xl bg-white p-4 shadow-sm">' +
                        '<p class="text-xs uppercase tracking-[0.28em] text-slate-500">Tipe</p>' +
                        '<p class="mt-2 text-base font-semibold">' + detailInfo.type + '</p>' +
                    '</div>' +
                    (detailInfo.accountNumber ? '<div class="rounded-3xl bg-white p-4 shadow-sm">' +
                        '<p class="text-xs uppercase tracking-[0.28em] text-slate-500">Nomor</p>' +
                        '<p class="mt-2 text-base font-semibold">' + detailInfo.accountNumber + '</p>' +
                    '</div>' : '') +
                    (detailInfo.accountName ? '<div class="rounded-3xl bg-white p-4 shadow-sm">' +
                        '<p class="text-xs uppercase tracking-[0.28em] text-slate-500">Atas Nama</p>' +
                        '<p class="mt-2 text-base font-semibold">' + detailInfo.accountName + '</p>' +
                    '</div>' : '') +
                    (detailInfo.branch ? '<div class="rounded-3xl bg-white p-4 shadow-sm">' +
                        '<p class="text-xs uppercase tracking-[0.28em] text-slate-500">Cabang</p>' +
                        '<p class="mt-2 text-base font-semibold">' + detailInfo.branch + '</p>' +
                    '</div>' : '') +
                    (detailInfo.code ? '<div class="rounded-3xl bg-white p-4 shadow-sm sm:col-span-2">' +
                        '<p class="text-xs uppercase tracking-[0.28em] text-slate-500">Kode QRIS</p>' +
                        '<p class="mt-2 text-base font-semibold">' + detailInfo.code + '</p>' +
                    '</div>' : '') +
                '</div>';
            } else {
                detailsBody.innerHTML = '<div class="rounded-3xl bg-white p-4 shadow-sm">' +
                    '<p class="text-xs uppercase tracking-[0.28em] text-slate-500">Metode</p>' +
                    '<p class="mt-2 text-base font-semibold">' + detailInfo.title + '</p>' +
                '</div>';
            }

            detailsNote.textContent = detailInfo.note || methodInfo.description || '';
        }

        function setupPaymentOptions() {
            paymentOptions = Array.from(document.querySelectorAll('.payment-option'));
            paymentOptions.forEach(function(option) {
                option.addEventListener('click', function() {
                    paymentOptions.forEach(function(button) {
                        button.classList.remove('border-slate-900', 'bg-slate-950', 'text-white');
                        button.classList.add('border-slate-200', 'bg-white');
                    });
                    option.classList.add('border-slate-900', 'bg-slate-950', 'text-white');
                    option.classList.remove('bg-white');
                    selectedPaymentMethod = option.getAttribute('data-method') || 'Bank Transfer';
                    selectedPaymentOption = paymentMethods[selectedPaymentMethod].options[0].value;
                    renderPaymentSubOptions();
                    renderCheckout();
                });
            });
        }

        function selectPaymentSubOption(value) {
            selectedPaymentOption = value;
            renderCheckout();
            renderPaymentSubOptions();
        }

        function renderPaymentSubOptions() {
            var suboptionList = document.getElementById('suboption-list');
            var paymentSuboptionsEl = document.getElementById('payment-suboptions');
            var methodInfo = paymentMethods[selectedPaymentMethod];
            if (!suboptionList || !methodInfo) return;

            suboptionList.innerHTML = methodInfo.options.map(function(option) {
                var isSelected = option.value === selectedPaymentOption;
                return '<button type="button" class="rounded-[1.5rem] border px-4 py-4 text-left transition ' +
                    (isSelected ? 'border-slate-950 bg-slate-950 text-white' : 'border-slate-200 bg-white text-slate-700 hover:border-slate-900') + '"' +
                    ' onclick="selectPaymentSubOption(\'' + option.value + '\')">' +
                    '<p class="font-semibold">' + option.label + '</p>' +
                '</button>';
            }).join('');

            paymentSuboptionsEl.classList.toggle('hidden', methodInfo.options.length === 0);
        }

        function confirmOrder() {
            var button = document.getElementById('confirm-order');
            if (!button) return;
            button.addEventListener('click', function() {
                var message = 'Pesanan berhasil diproses menggunakan ' + selectedPaymentMethod;
                if (selectedPaymentOption) {
                    message += ' (' + selectedPaymentOption + ')';
                }
                if (selectedPaymentMethod === 'Bank Transfer') {
                    var methodInfo = paymentMethods[selectedPaymentMethod];
                    var selectedInfo = methodInfo.info[selectedPaymentOption] || methodInfo.info.BCA;
                    message += '.\n\nSilakan transfer ke:\nBank: ' + selectedInfo.title + '\nNomor Rekening: ' + selectedInfo.accountNumber + '\nAtas Nama: ' + selectedInfo.accountName;
                }
                if (selectedPaymentMethod === 'E-Wallet' && selectedPaymentOption === 'QRIS') {
                    message += '.\n\nGunakan QRIS untuk scan dan bayar sesuai total.';
                }
                if (selectedPaymentMethod === 'E-Wallet' && selectedPaymentOption !== 'QRIS') {
                    message += '.\n\nBuka aplikasi ' + selectedPaymentOption + ' dan selesaikan pembayaran.';
                }
                if (selectedPaymentMethod === 'Credit Card') {
                    message += '.\n\nLanjutkan ke halaman pembayaran kartu untuk memasukkan data kartu.';
                }
                if (selectedPaymentMethod === 'Cash on Delivery') {
                    message += '.\n\nSiapkan pembayaran tunai saat paket sampai di alamatmu.';
                }
                message += '\n\nTerima kasih telah berbelanja di SHOESTEP!';
                alert(message);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            setupPaymentOptions();
            renderPaymentSubOptions();
            renderCheckout();
            confirmOrder();
        });
    </script>
</body>

</html>
