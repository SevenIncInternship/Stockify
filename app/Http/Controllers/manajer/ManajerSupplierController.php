<?php

namespace App\Http\Controllers\Manajer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class ManajerSupplierController extends Controller
{
    public function index() {
        $supplier = Supplier::all(); // atau paginate
    return view('manajer.supplier.index', compact('supplier'));
    }

    public function create() {}
    public function store(Request $request) {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
    public function destroy($id) {}
}
