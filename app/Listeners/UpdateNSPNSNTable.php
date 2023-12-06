<?php

namespace App\Listeners;

use App\Events\DecisionMatrixUpdated;
use App\Models\NSN;
use App\Models\NSP;
use App\Models\SN;
use App\Models\SP;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateNSPNSNTable
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
        $nsp = SP::where('id_edas', $event->decisionmatrix[0]->id_edas)->get();
        $nsn = SN::where('id_edas', $event->decisionmatrix[0]->id_edas)->get();
        $alternatives = $event->alternatives;

        $max_sp = $nsp->max('value');
        $max_sn = $nsn->max('value');

        foreach ($alternatives as $alternative) {
            $sp = SP::where('id_edas', $event->decisionmatrix[0]->id_edas)->where('id_alternative', $alternative->id)->first();
            $sn = SN::where('id_edas', $event->decisionmatrix[0]->id_edas)->where('id_alternative', $alternative->id)->first();
            $nsp_value = $sp->value / $max_sp;
            $nsp_value = round($nsp_value, 3);
            $nsn_value = 1 - ($sn->value / $max_sn);
            $nsn_value = round($nsn_value, 3);
            $nsp_value = NSP::updateOrCreate(
                [
                    'id_edas' => $sp->id_edas,
                    'id_alternative' => $sp->id_alternative,
                ],
                [
                    'value' => $nsp_value,
                ]
            );
            $nsn_value = NSN::updateOrCreate(
                [
                    'id_edas' => $sn->id_edas,
                    'id_alternative' => $sn->id_alternative,
                ],
                [
                    'value' => $nsn_value,
                ]
            );
        }
    }
}
