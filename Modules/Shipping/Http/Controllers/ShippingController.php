<?php

namespace Modules\Shipping\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Shipping\Http\Requests\Store;
use Modules\Shipping\Http\Requests\Update;
use Modules\Shipping\Models\Shipping;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $shipping = Shipping::orderBy('id', 'DESC')->paginate(10);
        
        return view('shipping::index')->with('shippings', $shipping);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  Store  $request
     *
     * @return RedirectResponse
     */
    public function store(Store $request): RedirectResponse
    {
        // return $data;
        $status = Shipping::create($request->validated());
        if ($status) {
            request()->session()->flash('success', 'Shipping successfully created');
        } else {
            request()->session()->flash('error', 'Error, Please try again');
        }
        
        return redirect()->route('shipping.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('shipping::create');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Shipping  $shipping
     *
     * @return Application|Factory|View
     */
    public function edit(Shipping $shipping)
    {
        return view('shipping::edit')->with('shipping', $shipping);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  Update  $request
     * @param  Shipping  $shipping
     *
     * @return RedirectResponse
     */
    public function update(Update $request, Shipping $shipping): RedirectResponse
    {
        $status = $shipping->update($request->validated());
        if ($status) {
            request()->session()->flash('success', 'Shipping successfully updated');
        } else {
            request()->session()->flash('error', 'Error, Please try again');
        }
        
        return redirect()->route('shipping.index');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $shipping = Shipping::find($id);
        if ($shipping) {
            $status = $shipping->delete();
            if ($status) {
                request()->session()->flash('success', 'Shipping successfully deleted');
            } else {
                request()->session()->flash('error', 'Error, Please try again');
            }
            
            return redirect()->route('shipping.index');
        } else {
            request()->session()->flash('error', 'Shipping not found');
            
            return redirect()->back();
        }
    }
}
