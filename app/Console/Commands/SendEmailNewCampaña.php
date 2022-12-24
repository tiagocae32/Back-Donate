<?php

namespace App\Console\Commands;

use App\Mail\EmailNotificationAdmin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmailNewCampaña extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaña:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envio de mails cuando se crea una campaña';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        /*$emailNotification = new EmailNotificationAdmin("tiagoviezzoli@gmail.com", 
        "Campaña Creada", 
        "Se ha creado una nueva campaña");

        Mail::to('tiagoviezzoli@gmail.com')->send($emailNotification);

        $this->info("Mail enviado");
        */
        return "hola";
        
    }
}
