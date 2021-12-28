<?php


namespace service\payment;


interface PaymentService
{
    public function paymentRegister($userId, $attributes, $receipt_id, $pdfStore, $PMF);

    public function paymentCheck($userId);
}