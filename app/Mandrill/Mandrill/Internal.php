<?php
namespace App\Mandrill\Mandrill;
use App\Mandrill\Mandrill;
use App\Mandrill\Mandrill\Mandrill_Templates;
use App\Mandrill\Mandrill\Mandrill_Exports;
use App\Mandrill\Mandrill\Mandrill_Inbound;
use App\Mandrill\Mandrill\Mandrill_Ips;
use App\Mandrill\Mandrill\Mandrill_Messages;
use App\Mandrill\Mandrill\Mandrill_Metadata;
use App\Mandrill\Mandrill\Mandrill_Rejects;
use App\Mandrill\Mandrill\Mandrill_Senders;
use App\Mandrill\Mandrill\Mandrill_Subaccounts;
use App\Mandrill\Mandrill\Mandrill_Tags;
use App\Mandrill\Mandrill\Mandrill_Urls;
use App\Mandrill\Mandrill\Mandrill_Users;
use App\Mandrill\Mandrill\Mandrill_Webhooks;
use App\Mandrill\Mandrill\Mandrill_Whitelists;
class Mandrill_Internal {
    public function __construct(Mandrill $master) {
        $this->master = $master;
    }

}


