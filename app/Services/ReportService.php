<?php

namespace App\Services;

use App\Report;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Clients\SpaceFlightNewsClient;

class ReportService
{

    private $client;

    public static function getCreateValidationRules()
    {
        return [
            'external_id' => [
                'required',
                'string',
                Rule::unique('reports')->whereNull('deleted_at')
            ],
            'title' => 'required|string',
            'url' => 'required|string',
            'summary' => 'nullable|string'
        ];
    }

    public function __construct(SpaceFlightNewsClient $client = null)
    {
        $this->client = $client ?? new SpaceFlightNewsClient;
    }

    public function create(array $data)
    {
        $report = $this->save($data);
        $report->restore();
        return $report;
    }

    public function list($params)
    {
        $rawResult = $this->client->getReports();

        foreach ($rawResult as $report) {
            $this->save($report);
        }

        return Report::filter($params)->paginate($params['per_page'] ?? null)->withQueryString();
    }

    public function save($data)
    {
        return Report::withTrashed()->updateOrCreate(
            ['external_id' => $data['external_id'] ?? $data['id']],
            [
                'title' => $data['title'],
                'url' => $data['url'],
                'summary' => $data['summary']
            ]
        );
    }

    public function delete($id)
    {
        Report::findOrFail($id)->delete();
    }
}
