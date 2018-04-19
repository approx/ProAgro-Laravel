<?php

namespace App\Observers;

use App\IncomeHistory;

class IncomeObserver{

  public function saved(IncomeHistory $income)
  {
    $income->farm->CalculateIncome();
  }
}
