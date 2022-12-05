<?php

namespace App\Observers;

use App\Mail\EmailNotificationAdmin;
use App\Models\Campaña\Campaña;
use Illuminate\Support\Facades\Mail;

class CampañaObserver
{
    /**
     * Handle the Campaña "created" event.
     *
     * @param  \App\Models\Campaña\Campaña  $campaña
     * @return void
     */
    public function created(Campaña $campaña)
    {
        $userName = Auth()->user()->name;

        $emailNotification = new EmailNotificationAdmin("tiagoviezzoli@gmail.com", 
        "Campaña Creada", 
        "El usuario $userName ha creado una campaña llamada {$campaña['name']} que tiene {$campaña['fondos_a_recaudar']} pesos como objetivo.");

        Mail::to('tiagoviezzoli@gmail.com')->send($emailNotification);
    }

    /**
     * Handle the Campaña "updated" event.
     *
     * @param  \App\Models\Campaña\Campaña $campaña
     * @return void
     */
    public function updated(Campaña $campaña)
    {
        //
    }

    /**
     * Handle the Campaña "deleted" event.
     *
     * @param  \App\Models\Campaña\Campaña $campaña
     * @return void
     */
    public function deleted(Campaña $campaña)
    {
        //
    }

    /**
     * Handle the Campaña "restored" event.
     *
     * @param \App\Models\Campaña\Campaña $campaña
     * @return void
     */
    public function restored(Campaña $campaña)
    {
        //
    }

    /**
     * Handle the Campaña "force deleted" event.
     *
     * @param \App\Models\Campaña\Campaña $campaña
     * @return void
     */
    public function forceDeleted(Campaña $campaña)
    {
        //
    }
}
