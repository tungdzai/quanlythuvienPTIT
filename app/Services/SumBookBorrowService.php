<?php

namespace App\Services;

use App\Models\BorrowingDetails;

class  SumBookBorrowService
{
    public function sumBook()
    {
        return BorrowingDetails::sum('quantity');

    }
}
