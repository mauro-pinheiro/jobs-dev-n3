<?php

namespace Tests\Feature;

use App\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ReportTest
 * @package Tests\Feature
 */
class ReportTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateReport()
    {
        $report = factory(Report::class)->make();
        $response = $this->post(route('reports.create'), $report->getAttributes());

        $response->assertStatus(201);
        $this->assertDatabaseHas($report->getTable(), $report->toArray());
    }

    public function testCreateReportExternalIdRequired()
    {
        $report = factory(Report::class)->make();

        $data = $report->getAttributes();
        unset($data['external_id']);

        $response = $this->post(route('reports.create'), $data);

        $response->assertJsonValidationErrors([
            'external_id' => 'The external id field is required.',
        ]);
    }

    public function testCreateReportExternalIdUnique()
    {
        $report1 = factory(Report::class)->make();
        $report2 = factory(Report::class)->make();
        $report2->external_id = $report1->external_id;

        $data1 = $report1->getAttributes();
        $data2 = $report2->getAttributes();

        $response1 = $this->post(route('reports.create'), $data1);
        $response2 = $this->post(route('reports.create'), $data2);

        $response2->assertJsonValidationErrors([
            'external_id' => 'The external id has already been taken.',
        ]);
    }

    public function testCreateReportTitleRequired()
    {
        $report = factory(Report::class)->make();

        $data = $report->getAttributes();
        unset($data['title']);

        $response = $this->post(route('reports.create'), $data);

        $response->assertJsonValidationErrors([
            'title' => 'The title field is required.',
        ]);
    }

    public function testCreateReportUrlRequired()
    {
        $report = factory(Report::class)->make();

        $data = $report->getAttributes();
        unset($data['url']);

        $response = $this->post(route('reports.create'), $data);

        $response->assertJsonValidationErrors([
            'url' => 'The url field is required.',
        ]);
    }

    public function testCreateSummaryOptional()
    {
        $report = factory(Report::class)->make();

        $data = $report->getAttributes();
        unset($data['summary']);

        $response = $this->post(route('reports.create'), $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas($report->getTable(), $data);
    }

    public function testDeleteReport()
    {
        $report = factory(Report::class)->create();
        $response = $this->delete(route('reports.delete', $report->id));

        $response->assertStatus(204);
        $this->assertDeleted($report->getTable(), $report->toArray());
    }

    public function testListReports()
    {
        $num = rand(10, 20);
        $report = factory(Report::class, $num)->create();
        $response = $this->get(route('reports.list', ['per_page' => $num]));

        $response->assertOk()
            ->assertJsonCount($num, 'data');
    }


    public function testListReportsPagination()
    {
        $num = rand(10, 20);
        $per_page = $num / 4;
        $report = factory(Report::class, $num)->create();
        $response = $this->get(route('reports.list', ['per_page' => $per_page]));

        $response->assertOk()
            ->assertJsonCount($per_page, 'data');
    }
}
