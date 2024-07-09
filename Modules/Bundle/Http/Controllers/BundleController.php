<?php

namespace Modules\Bundle\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Modules\Bundle\Http\Requests\Store;
use Modules\Bundle\Models\Bundle;
use Modules\Bundle\Service\BundleService;
use Modules\Product\Models\Product;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class BundleController extends Controller
{
    protected BundleService $bundleService;

    public function __construct(BundleService $bundleService)
    {
        $this->bundleService = $bundleService;
        $this->authorizeResource(Bundle::class, 'bundle');
    }

    public function index(): View
    {
        $bundles = $this->bundleService->getAll();

        return view('bundle::index', compact('bundles'));
    }

    public function create(): View
    {
        return view('bundle::create', compact([
            'products' => Product::get(),
            'bundle' => new Bundle(),
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Store  $request
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     * @throws Exception
     */
    public function store(Store $request): RedirectResponse
    {
        $banner = $this->bundleService->create($request->validated());
        if ($request->hasFile('images')) {
            $banner->addMultipleMediaFromRequest(['images'])->each(function ($fileAdder) {
                $fileAdder->preservingOriginal()->toMediaCollection('bundle');
            });
        }
        return redirect()->route('bundle.index')->with('status', 'Brand created successfully.');
    }

    public function edit(Bundle $bundle): View
    {
        return view('bundle::edit')->with($this->bundleService->edit($bundle->id));
    }

    /**
     * @param  Store   $request
     * @param  Bundle  $bundle
     * @return RedirectResponse
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(Store $request, Bundle $bundle): RedirectResponse
    {
        $this->bundleService->update($bundle->id, $request->all());
        if ($request->hasFile('images')) {
            $bundle->clearMediaCollection('bundle');
            $bundle->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->preservingOriginal()->toMediaCollection('bundle');
                });
        }
        return redirect()->route('bundle.edit', $bundle)->with('status', 'Brand updated successfully.');
    }

    public function destroy(Bundle $bundle): RedirectResponse
    {
        $this->bundleService->delete($bundle->id);

        return redirect()->route('bundle.index')->with('status', 'Brand deleted successfully.');
    }

    /**
     * Deletes a media item associated with a bundle.
     *
     * @param  int  $modelId  The ID of the bundle.
     * @param  int  $mediaId  The ID of the media to be deleted.
     */
    public function deleteMedia(int $modelId, int $mediaId): RedirectResponse
    {
        $model = Bundle::findOrFail($modelId);
        $media = $model->media()->where('id', $mediaId)->firstOrFail();
        $media->delete();

        return redirect()->route('bundle.index')->with('status', 'Media deleted successfully.');
    }
}
