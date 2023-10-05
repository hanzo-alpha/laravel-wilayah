<?php

namespace HanzoAlpha\LaravelWilayah;

use HanzoAlpha\LaravelWilayah\Models\City;
use HanzoAlpha\LaravelWilayah\Models\District;
use HanzoAlpha\LaravelWilayah\Models\Province;
use HanzoAlpha\LaravelWilayah\Models\Village;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LaravelWilayahApiController extends Controller
{
    /**
     * Get provinces data.
     */
    public function provinces(Request $request): JsonResponse|string
    {
        $query = Province::select(config('wilayah.api.response_columns.province'));

        return $this->getResponse($request, $query);
    }

    /**
     * Get cities data.
     */
    public function cities(Request $request): JsonResponse|string
    {
        $query = City::select(config('wilayah.api.response_columns.city'));

        if ($request->filled('province_code')) {
            $query->where('province_code', $request->province_code);
        }

        if ($request->filled('province_name')) {
            $query->whereHas('province', function ($sQuery) use ($request) {
                $sQuery->where('name', $request->province_name);
            });
        }

        return $this->getResponse($request, $query);
    }

    /**
     * Get districts data.
     */
    public function districts(Request $request): JsonResponse|string
    {
        $query = District::select(config('wilayah.api.response_columns.district'));

        if ($request->filled('city_code')) {
            $query->where('city_code', $request->city_code);
        }

        if ($request->filled('city_name')) {
            $query->whereHas('city', function ($sQuery) use ($request) {
                $sQuery->where('name', $request->city_name);
            });
        }

        return $this->getResponse($request, $query);
    }

    /**
     * Get villages data.
     */
    public function villages(Request $request): JsonResponse|string
    {
        //
        if (empty($request->district_code) && empty($request->district_name)) {
            //.
            $message = 'Parameter district_code or district_name is required';
            $status = ResponseAlias::HTTP_UNPROCESSABLE_ENTITY;

            return $this->responseAsJson(null, false, $message, $status);
        }

        $query = Village::select(config('wilayah.api.response_columns.village'));

        if ($request->filled('district_code')) {
            $query->where('district_code', $request->district_code);
        }

        if ($request->filled('district_name')) {
            $query->whereHas('district', function ($sQuery) use ($request) {
                $sQuery->where('name', $request->district_name);
            });
        }

        return $this->getResponse($request, $query);
    }

    /**
     * Get response as JSON or as HTML options.
     */
    protected function getResponse(Request $request, Builder $query): JsonResponse|string
    {
        $data = $query->get();

        return $request->as_html
            ? $this->responseAsHtml($data) : $this->responseAsJson($data);
    }

    /**
     * Generate response as json.
     */
    protected function responseAsJson(
        mixed $data,
        bool $success = true,
        string $message = 'Success',
        int $status = ResponseAlias::HTTP_OK
    ): JsonResponse {
        return response()->json(compact('data', 'success', 'message'), $status);
    }

    /**
     * Generate response as html options.
     */
    protected function responseAsHtml(Collection $data): string
    {
        return $data->map(function ($item) {
            return match ($item) {
                $item->province_code => '<option value="' . $item->province_code . '">' . $item->name . '</option>',
                $item->city_code => '<option value="' . $item->city_code . '">' . $item->name . '</option>',
                $item->district_code => '<option value="' . $item->district_code . '">' . $item->name . '</option>',
                $item->village_code => '<option value="' . $item->village_code . '">' . $item->name . '</option>',
                $item->island_code => '<option value="' . $item->island_code . '">' . $item->name . '</option>',
            };

        })->implode('');
    }
}
