<?php

namespace Tests\Feature;

use Tests\TestCase;
use Barryvdh\DomPDF\Facade as PDF;

class ExportUsersTest extends TestCase
{

    public function testDownloadCsv()
    {
        PDF::shouldReceive('loadView')
        ->once()
        ->andReturnSelf()
        ->getMock()
        ->shouldReceive('download')
        ->once()
        ->with('report.pdf')
        ->andReturn('THE_PDF_BINARY_DATA');

        $this->get('/api/v1/download-users-report')
                ->assertSuccessful()
                ->assertSeeText('THE_PDF_BINARY_DATA');
    }
}
