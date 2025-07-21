<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Generate missing SKUs for products that don't have one.
     * This method is typically for administrative tasks.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generateMissingSku()
    {
        // Find all products where the 'sku' field is null
        $products = Product::whereNull('sku')->get();
        $jumlah = 0; // Counter for updated products

        // Loop through each product and assign a new SKU
        foreach ($products as $product) {
            $product->sku = 'SKU-' . strtoupper(Str::random(8)); // Generate a unique SKU
            $product->save(); // Save the updated product
            $jumlah++; // Increment the counter
        }

        // Redirect back to the previous page with a success message
        return redirect()->back()->with('success', "$jumlah SKU berhasil digenerate.");
    }

    /**
     * Internal helper to check if the authenticated user has one of the allowed roles.
     * If not, it aborts the request with a 403 Forbidden error.
     *
     * @param array $roles An array of allowed roles (e.g., ['admin', 'manajer']).
     * @return void
     */
    private function checkRole($roles = ['admin'])
    {
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403, 'Role tidak diizinkan.');
        }
    }

    /**
     * Internal helper to determine the route prefix based on the user's role.
     * Used for dynamic redirection after CUD operations.
     *
     * @return string 'manajer' or 'admin'
     */
    private function rolePrefix()
    {
        return auth()->user()->role === 'manajer' ? 'manajer' : 'admin';
    }

    /**
     * Display a listing of the products.
     * Accessible by 'admin' and 'manajer' roles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->checkRole(['admin', 'manajer']); // Check if the user has 'admin' or 'manajer' role

        // Fetch products with their related category and supplier, ordered by latest, with pagination
        $products = Product::with(['category', 'supplier'])->latest()->paginate(10);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     * Accessible only by 'admin' role.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->checkRole(['admin']); // Check if the user has 'admin' role

        // Fetch all categories and suppliers for the form dropdowns
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('product.create', compact('categories', 'suppliers'));
    }

    /**
     * Store a newly created product in storage.
     * Accessible only by 'admin' role.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->checkRole(['admin']); // Check if the user has 'admin' role

        // Validate the incoming request data
        $request->validate([
            'nama'          => 'required|string|max:255',
            'kategori_id'   => 'required|exists:categories,id',
            'supplier_id'   => 'required|exists:suppliers,id',
            'satuan'        => 'required|string|max:50',
            'harga_beli'    => 'nullable|numeric|min:0',
            'harga_jual'    => 'nullable|numeric|min:0',
            'minimal_stok'  => 'nullable|integer|min:0',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Handle image upload: store if present, otherwise set to null
        $path = $request->file('image') ? $request->file('image')->store('products', 'public') : null;

        // Generate a unique SKU for the new product
        $sku = 'SKU-' . strtoupper(Str::random(8));

        // Create the new product record in the database
        Product::create([
            'nama'          => $request->nama,
            'SKU'           => $sku,
            'kategori_id'   => $request->kategori_id,
            'supplier_id'   => $request->supplier_id,
            'stock'         => 0, // Initial stock is 0 for new products
            'satuan'        => $request->satuan,
            'harga_beli'    => $request->harga_beli,
            'harga_jual'    => $request->harga_jual,
            'minimal_stok'  => $request->minimal_stok ?? 0, // Default to 0 if not provided
            'image'         => $path,
        ]);

        // Redirect to the product index page with a success message
        return redirect()->route($this->rolePrefix() . '.product.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified product.
     * Accessible by 'admin' and 'manajer' roles.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $this->checkRole(['admin', 'manajer']); // Check if the user has 'admin' or 'manajer' role

        // Fetch all categories and suppliers for the form dropdowns
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('product.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update the specified product in storage.
     * Accessible by 'admin' and 'manajer' roles.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        // Ensure only authorized roles can access this method
        $this->checkRole(['admin', 'manajer']);

        // Validate input data with stricter rules
        $request->validate([
            'nama'          => 'required|string|max:255',
            'kategori_id'   => 'required|exists:categories,id',
            'supplier_id'   => 'required|exists:suppliers,id',
            'stock'         => 'required|integer|min:0', // Stock is now required and must be >= 0
            'satuan'        => 'required|string|max:255', // Max length updated
            'harga_beli'    => 'required|numeric|min:0', // Required, must be numeric and >= 0
            'harga_jual'    => 'required|numeric|min:0', // Required, must be numeric and >= 0
            'minimal_stok'  => 'required|integer|min:1', // Required, must be integer and >= 1
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Accepts SVG, field name is 'image'
        ]);

        // Prepare data for update from the request
        $data = $request->only([
            'nama',
            'kategori_id',
            'supplier_id',
            'stock',
            'satuan',
            'harga_beli',
            'harga_jual',
            'minimal_stok',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists and is stored publicly
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            // Store the new image and update its path in the data array
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            // If no new image is uploaded, retain the existing image path
            $data['image'] = $product->image;
        }

        // Update the product record in the database
        $product->update($data);

        // Redirect to the product index page with a success message, using dynamic role prefix
        return redirect()->route($this->rolePrefix() . '.product.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified product from storage.
     * Accessible by 'admin' and 'manajer' roles.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $this->checkRole(['admin', 'manajer']); // Check if the user has 'admin' or 'manajer' role

        // Delete associated image from storage if it exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Delete the product record from the database
        $product->delete();

        // Redirect to the product index page with a success message
        return redirect()->route($this->rolePrefix() . '.product.index')->with('success', 'Produk berhasil dihapus');
    }
}
