<?php

namespace App\Listeners;

use App\Events\DecisionMatrixUpdated;
use App\Models\ApraisalScore;
use App\Models\NSN;
use App\Models\NSP;

class UpdateApraisalScroreTable
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
        $nsp = NSP::where('id_edas', $event->decisionmatrix[0]->id_edas)->get();
        $nsn = NSN::where('id_edas', $event->decisionmatrix[0]->id_edas)->get();
        $alternatives = $event->alternatives;

        foreach ($alternatives as $alternative) {
            $nsp_value = $nsp->where('id_alternative', $alternative->id)->first()->value;
            $nsn_value = $nsn->where('id_alternative', $alternative->id)->first()->value;

            $as = $nsp_value + $nsn_value;
            $as /= 2;
            $as = round($as, 3);

            $as = ApraisalScore::updateOrCreate(
                [
                    'id_edas' => $event->decisionmatrix[0]->id_edas,
                    'id_alternative' => $alternative->id,
                ],
                [
                    'value' => $as,
                ]
            );
        }
    }
}
