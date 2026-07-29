<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Shoestep</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="mx-auto flex min-h-screen max-w-6xl flex-col px-6 py-10 lg:flex-row lg:gap-8">
        <div class="flex-1 rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm">
            <a href="/" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900">
                ← Kembali ke produk
            </a>
            <h1 class="mt-6 text-3xl font-black">Checkout</h1>
            <p class="mt-2 text-sm text-slate-500">Review pesanan Anda sebelum mengonfirmasi.</p>

            <div id="checkout-items" class="mt-8 space-y-4"></div>
        </div>

        <div class="mt-8 w-full max-w-md rounded-[2rem] border border-slate-200 bg-white p-8 shadow-sm lg:mt-0">
            <h2 class="text-xl font-black">Ringkasan</h2>
            <div class="mt-6 space-y-3 text-sm text-slate-600">
                <div class="flex items-center justify-between">
                    <span>Subtotal</span>
                    <span id="checkout-subtotal">Rp0</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Ongkir</span>
                    <span>Gratis</span>
                </div>
            </div>
            <div class="mt-6 border-t border-slate-200 pt-4">
                <div class="flex items-center justify-between text-base font-black">
                    <span>Total</span>
                    <span id="checkout-total">Rp0</span>
                </div>
            </div>
            <button class="mt-6 w-full rounded-full bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                Konfirmasi Pesanan
            </button>
        </div>
    </div>

    <script>
        function formatRupiah(value) {
            return 'Rp' + Number(value || 0).toLocaleString('id-ID');
        }

        function renderCheckout() {
            var items = JSON.parse(localStorage.getItem('shoestep_checkout') || '[]');
            if (!items.length) {
                items = JSON.parse(localStorage.getItem('shoestep_cart') || '[]');
            }

            var container = document.getElementById('checkout-items');
            var subtotalEl = document.getElementById('checkout-subtotal');
            var totalEl = document.getElementById('checkout-total');

            if (!container) return;

            if (!items.length) {
                container.innerHTML = '<div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 p-8 text-center text-sm text-slate-500">Tidak ada item untuk checkout.</div>';
                if (subtotalEl) subtotalEl.textContent = formatRupiah(0);
                if (totalEl) totalEl.textContent = formatRupiah(0);
                return;
            }

            var subtotal = items.reduce(function(sum, item) {
                return sum + (Number(item.price || 0) * Number(item.qty || 1));
            }, 0);

            container.innerHTML = items.map(function(item) {
                return '<div class="flex items-center justify-between rounded-2xl border border-slate-200 p-4">' +
                    '<div><p class="font-semibold">' + (item.name || 'Produk') + '</p><p class="text-sm text-slate-500">Qty: ' + (item.qty || 1) + '</p></div>' +
                    '<p class="font-semibold">' + formatRupiah((Number(item.price || 0) * Number(item.qty || 1))) + '</p>' +
                '</div>';
            }).join('');

            if (subtotalEl) subtotalEl.textContent = formatRupiah(subtotal);
            if (totalEl) totalEl.textContent = formatRupiah(subtotal);
        }

        renderCheckout();
    </script>
</body>
</html>
