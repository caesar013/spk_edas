<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DecisionMatrixUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $decisionmatrix;
    public $criterias;
    public $alternatives;

    public function __construct(Collection $decisionmatrix, Collection $criterias, Collection $alternatives)
    {
        $this->decisionmatrix = $decisionmatrix;
        $this->criterias = $criterias;
        $this->alternatives = $alternatives;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
