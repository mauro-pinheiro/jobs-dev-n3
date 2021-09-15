<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReportCollection;
use App\Http\Resources\ReportResource;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class ReportController
 * @package App\Http\Controllers
 */
class ReportController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listReports(Request $request, ReportService $service)
    {
        $params = $request->only('filter', 'per_page');

        $result = $service->list($params);

        return new ReportCollection($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function createReport(Request $request, ReportService $service)
    {
        try {
            $data = $request->validate(ReportService::getCreateValidationRules());

            $report = $service->create($data);

            return (new ReportResource($report))
                ->response()
                ->setStatusCode(201);
        } catch (ValidationException $e) {
            return response([
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        }
    }

    /**
     * TODO: Implement it
     *
     * @param $reportId
     */
    public function deleteReport($reportId, ReportService $service)
    {
        $service->delete($reportId);

        return response('', 204);
    }
}
