<?php

namespace App\Listeners;

use App\Events\DecisionMatrixUpdated;
use App\Models\Average;
use App\Models\Criteria;
use App\Models\NDA;
use App\Models\PDA;
use App\Models\Subcriteria;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatePDANDATable
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
        $averages = Average::where('id_edas', $decisionmatrices[0]->id_edas)->get();
        $subcriterias = Subcriteria::where('id_edas', $decisionmatrices[0]->id_edas)->get();

        foreach ($decisionmatrices as $decisionmatrix) {
            $value = $subcriterias->where('id', $decisionmatrix->id_subcriteria)->first()->value;
            $average = $averages->where('id_criteria', $decisionmatrix->id_criteria)->first()->value;
            $type_criteria = $subcriterias->where('id', $decisionmatrix->id_subcriteria)->first()->criteria->type;
            $temp_pda = 0;
            $temp_nda = 0;
            if ($type_criteria == true) {
                $temp_pda = $value - $average;
                $temp_nda = $average - $value;
            } else {
                $temp_pda = $average - $value;
                $temp_nda = $value - $average;
            }
            if ($temp_pda < 0) {
                $temp_pda = 0;
            }
            if ($temp_nda < 0) {
                $temp_nda = 0;
            }
            $pda = $temp_pda / $average;
            $nda = $temp_nda / $average;
            $pda = round($pda, 3);
            $nda = round($nda, 3);
            $pda = PDA::updateOrCreate(
                [
                    'id_edas' => $decisionmatrix->id_edas,
                    'id_criteria' => $decisionmatrix->id_criteria,
                    'id_alternative' => $decisionmatrix->id_alternative,
                ],
                [
                    'value' => $pda,
                ]
            );
            $nda = NDA::updateOrCreate(
                [
                    'id_edas' => $decisionmatrix->id_edas,
                    'id_criteria' => $decisionmatrix->id_criteria,
                    'id_alternative' => $decisionmatrix->id_alternative,
                ],
                [
                    'value' => $nda,
                ]
            );
        }
    }
}
