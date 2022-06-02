<?php

namespace App\Http\Controllers;

use App\Http\Requests\SelicHistories\Store;
use App\Http\Requests\SelicHistories\Update;
use App\Http\Resources\SelicHistoryResource;
use App\Models\SelicHistory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class SelicHistories extends Controller
{
    /**
     * List all SelicHistories paginating by 10
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return SelicHistoryResource::collection(
            SelicHistory::query()->paginate(10)
        );
    }

    /**
     * Show one SelicHistory record
     *
     * @param SelicHistory $selicHistory
     * @return SelicHistoryResource
     */
    public function show(
        SelicHistory $selicHistory,
    ): SelicHistoryResource {
        return new SelicHistoryResource($selicHistory);
    }

    /**
     * Store new SelicHistory to database
     *
     * @param Store $request
     * @return SelicHistoryResource
     */
    public function store(Store $request): SelicHistoryResource
    {
        return new SelicHistoryResource(
            SelicHistory::create($request->validated())
        );
    }

    /**
     * Update SelicHistory record on database
     *
     * @param SelicHistory $selicHistory
     * @param Update $request
     * @return SelicHistoryResource
     */
    public function update(
        SelicHistory $selicHistory,
        Update $request
    ): SelicHistoryResource {

        $selicHistory->update($request->validated());
        return new SelicHistoryResource($selicHistory);
    }

    /**
     * Update SelicHistory record on database
     *
     * @param SelicHistory $selicHistory
     * @return Response
     */
    public function destroy(
        SelicHistory $selicHistory,
    ): Response {

        $selicHistory->delete();
        return new Response('', 204);
    }
}
