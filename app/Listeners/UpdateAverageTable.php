<?php

namespace App\Listeners;

use App\Events\DecisionMatrixUpdated;
use App\Models\Average;
use App\Models\Subcriteria;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateAverageTable
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DecisionMatrixUpdated $event): void
    {
        $decisionmatrices = $event->decisionmatrix;
        $criterias = $event->criterias;
        $alternatives = $event->alternatives;
        $alternatives_count = $event->alternatives->count();
        $averages = [];

        foreach ($criterias as $key => $criteria) {
            foreach ($alternatives as $foo => $alternative) {
                $decisionmatrix = $decisionmatrices->where('id_criteria', $criteria->id)->where('id_alternative', $alternative->id)->first();
                $value = Subcriteria::where('id', $decisionmatrix->id_subcriteria)->first()->value;
                if (!isset($averages[$key])) {
                    $averages[$key] = 0;
                }
                $averages[$key] += $value;
                if ($foo == $alternatives_count - 1) {
                    $averages[$key] = $averages[$key] / $alternatives_count;
                    $averages[$key] = round($averages[$key], 2);
                    $average = Average::updateOrCreate(
                        [
                            'id_edas' => $decisionmatrix->id_edas,
                            'id_criteria' => $decisionmatrix->id_criteria,
                        ],
                        [
                            'value' => $averages[$key],
                        ]
                    );
                }
            }
        }
    }
}
