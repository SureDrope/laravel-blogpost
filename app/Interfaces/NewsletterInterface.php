<?php

namespace App\Interfaces;

interface NewsletterInterface {
    public function subscribe(string $email, string $list = null);

}

