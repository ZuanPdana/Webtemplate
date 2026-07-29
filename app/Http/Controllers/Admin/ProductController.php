<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends AdminBaseController
{
    public function index(Request $request)
    {
        $query = Product::with('category')->withCount(['orderItems as purchases_count']);

        if ($search = trim($request->input('search', ''))) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $sort = $request->input('sort', 'name_asc');

        match ($sort) {
            'name_asc' => $query->orderBy('name', 'asc'),
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'purchases_desc' => $query->orderBy('purchases_count', 'desc'),
            'purchases_asc' => $query->orderBy('purchases_count', 'asc'),
            'stock_desc' => $query->orderBy('stock', 'desc'),
            'stock_asc' => $query->orderBy('stock', 'asc'),
            default => $query->orderBy('name', 'asc'),
        };

        $products = $request->boolean('show_all')
            ? $query->get()
            : $query->paginate(10)->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', [
            'product' => new Product(),
            'categories' => Category::orderBy('name')->get(),
            'mode' => 'create',
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft,published,out_of_stock,archived'],
            'featured' => ['nullable', 'boolean'],
            'popular' => ['nullable', 'boolean'],
            'thumbnail' => ['required', 'image', 'max:2048'],
            'images.*' => ['nullable', 'image', 'max:2048'],
        ]);

        $slug = Str::slug($data['name']);
        $baseSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$count}";
            $count++;
        }

        $data['slug'] = $slug;
        $data['featured'] = $request->boolean('featured');
        $data['popular'] = $request->boolean('popular');
        $data['thumbnail'] = $request->file('thumbnail')->store('product-images', 'public');

        $product = Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $imageFile) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imageFile->store('product-images', 'public'),
                    'alt_text' => $product->name,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', [
            'product' => $product,
            'categories' => Category::orderBy('name')->get(),
            'mode' => 'edit',
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'status' => ['required', 'in:draft,published,out_of_stock,archived'],
            'featured' => ['nullable', 'boolean'],
            'popular' => ['nullable', 'boolean'],
            'thumbnail' => ['nullable', 'image', 'max:2048'],
            'images.*' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($product->name !== $data['name']) {
            $slug = Str::slug($data['name']);
            $baseSlug = $slug;
            $count = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = "{$baseSlug}-{$count}";
                $count++;
            }
            $data['slug'] = $slug;
        }

        $data['featured'] = $request->boolean('featured');
        $data['popular'] = $request->boolean('popular');

        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('product-images', 'public');
        }

        $product->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $imageFile) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imageFile->store('product-images', 'public'),
                    'alt_text' => $product->name,
                    'sort_order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }
}
