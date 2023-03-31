<?php

namespace App\Repositories\Readers;
interface ReadersRepositoryInterface
{
    public function getReader($barcode_reader,$barcode_book);
    public function updateBorrowingDetail($barcode_reader,$barcode_book,$returned_date);
    public function infoReader($reader_id);
}
