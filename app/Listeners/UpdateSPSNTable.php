<?php

namespace App\Listeners;

use App\Events\DecisionMatrixUpdated;
use App\Models\NDA;
use App\Models\PDA;
use App\Models\SN;
use App\Models\SP;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateSPSNTable
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
        $pdas = PDA::where('id_edas', $event->decisionmatrix[0]->id_edas)->get();
        $ndas = NDA::where('id_edas', $event->decisionmatrix[0]->id_edas)->get();
        $criterias = $event->criterias;
        $alternatives = $event->alternatives;

        foreach ($alternatives as $alternative) {
            $sp = 0;
            $sn = 0;
            foreach ($criterias as $criteria) {
                $pda = $pdas->where('id_criteria', $criteria->id)->where('id_alternative', $alternative->id)->first();
                $nda = $ndas->where('id_criteria', $criteria->id)->where('id_alternative', $alternative->id)->first();
                $value_pda = $pda->value;
                $value_nda = $nda->value;
                $sp += ($value_pda * $criteria->weight);
                $sn += ($value_nda * $criteria->weight);
                $sp = round($sp, 3);
                $sn = round($sn, 3);
            }
            $sp = SP::updateOrCreate(
                [
                    'id_edas' => $pda->id_edas,
                    'id_alternative' => $pda->id_alternative,
                ],
                [
                    'value' => $sp,
                ]
            );
            $sn = SN::updateOrCreate(
                [
                    'id_edas' => $nda->id_edas,
                    'id_alternative' => $nda->id_alternative,
                ],
                [
                    'value' => $sn,
                ]
            );
        }
    }
}
