<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class PromotionController extends AdminBaseController
{
    public function index(Request $request)
    {
        $query = Coupon::with('product');

        if ($search = trim($request->input('search', ''))) {
            $query->where(function ($query) use ($search) {
                $query->where('code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($productId = $request->input('product_id')) {
            $query->where('product_id', $productId);
        }

        $sort = $request->input('sort', 'code');
        $direction = $request->input('dir', 'asc');

        match ($sort) {
            'discount' => $query->orderBy('discount_value', $direction),
            'expired_at' => $query->orderBy('expired_at', $direction),
            'status' => $query->orderBy('status', $direction),
            default => $query->orderBy('code', $direction),
        };

        $promotions = $request->boolean('show_all')
            ? $query->get()
            : $query->paginate(10)->withQueryString();

        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.form', [
            'promo' => new Coupon(),
            'products' => Product::orderBy('name')->get(),
            'mode' => 'create',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:coupons,code'],
            'description' => ['nullable', 'string'],
            'product_id' => ['nullable', 'exists:products,id'],
            'discount_type' => ['required', 'in:percentage,fixed'],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'minimum_order' => ['required', 'numeric', 'min:0'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'expired_at' => ['nullable', 'date'],
            'status' => ['required', 'in:active,inactive,expired'],
        ]);

        Coupon::create($data);

        return redirect()->route('admin.promotions.index')->with('success', 'Promo berhasil ditambahkan.');
    }

    public function edit(Coupon $promo)
    {
        return view('admin.promotions.form', [
            'promo' => $promo,
            'products' => Product::orderBy('name')->get(),
            'mode' => 'edit',
        ]);
    }

    public function update(Request $request, Coupon $promo)
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:coupons,code,' . $promo->id],
            'description' => ['nullable', 'string'],
            'product_id' => ['nullable', 'exists:products,id'],
            'discount_type' => ['required', 'in:percentage,fixed'],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'minimum_order' => ['required', 'numeric', 'min:0'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'expired_at' => ['nullable', 'date'],
            'status' => ['required', 'in:active,inactive,expired'],
        ]);

        $promo->update($data);

        return redirect()->route('admin.promotions.index')->with('success', 'Promo berhasil diperbarui.');
    }
}
