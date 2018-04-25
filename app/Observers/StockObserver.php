<?php
namespace App\Observers;

use App\Stock;

class StockObserver
{

  public function saving(Stock $stock)
  {
    $stock->total_value = $stock->quantity * $stock->unity_value;
  }

}
