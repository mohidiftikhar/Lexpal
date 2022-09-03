<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDatatable;
use App\Http\Requests\ProductRequest;
use App\Repositories\products\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productRepository;
    public function __construct(ProductInterface $productRepository){
        $this->productRepository = $productRepository;
    }
    public function index(ProductDatatable $dataTable)
    {
        return $dataTable->render('products.index');
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(ProductRequest $request){
        $store = $this->productRepository->create($request->all());
        if ($store) {
            return redirect()->route('products.index')->with('success', 'Product added successfully');
        } else {
            return redirect()->route('products.create')->withErrors('Something went wrong');
        }
    }
    public function edit($id){
        $products = $this->productRepository->findById($id);
        //dd($products['name']);
        if ($products){
            return view('products.edit', compact('products'));
        }
        else{
            return redirect()->route('products.index')->withErrors('Something went wrong');
        }
    }
    public function update(ProductRequest $request, $id)
    {
        $product = $this->productRepository->update($id, $request->all());

        if($product){
            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        }
        else{
            return redirect()->route('products.index')->withErrors('Something went wrong');
        }
    }
    public function destroy($id){
        $product = $this->productRepository->delete($id);
        if($product){
            return redirect()->route('products.index')->with('success', 'Product deleted successfully');
        }
        else{
            return redirect()->route('products.index')->withErrors('Something went wrong');
        }
    }
}
