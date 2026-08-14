<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SolicitudEnviada
{
    use Dispatchable, SerializesModels;

        public $user;
        public $requerimiento;
        public $descripcion;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $requerimiento, $descripcion)
    {
        $this->user = $user;
        $this->requerimiento = $requerimiento;
        $this->descripcion = $descripcion;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
   /* public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }*/
}