<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Product\Http\Requests\ProductReviewStore;
use Modules\Product\Models\ProductReview;
use Modules\Product\Service\ProductReviewService;

class ProductReviewController extends CoreController
{
    private ProductReviewService $product_review_service;
    
    public function __construct(ProductReviewService $product_review_service)
    {
        $this->product_review_service = $product_review_service;
        $this->middleware('permission:review-list');
        $this->middleware('permission:review-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:review-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:review-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (Auth::user()->hasRole('client')) {
            return view('product::review.index', ['reviews' => $this->product_review_service->findAllByUser()]);
        } else {
            return view('product::review.index', ['reviews' => $this->product_review_service->index()]);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductReviewStore  $request
     *
     * @return RedirectResponse
     */
    public function store(ProductReviewStore $request): RedirectResponse
    {
        $this->product_review_service->store($request);
        
        return redirect()->back();
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  ProductReview  $productReview
     *
     * @return Application|Factory|View
     */
    public function edit(ProductReview $productReview)
    {
        dd($productReview);
        
        return view('product::review.edit')->with($this->product_review_service->edit($productReview->id));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $this->product_review_service->update($id, $request);
        
        return redirect()->route('product::review.index');
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
        $this->product_review_service->destroy($id);
        
        return redirect()->route('review.index');
    }
}
