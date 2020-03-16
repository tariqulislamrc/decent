<?php 
namespace App\Utilities;

use App\models\Production\Product;
use App\models\Production\Transaction;
use App\models\Production\TransactionPayment;
use App\models\Production\VariationBrandDetails;
use App\models\inventory\TransactionSellLine;
use Illuminate\Support\Facades\DB;

class TransactionUtil
{
  
  public function createSellTransaction($input,$user_id,$ref_no){

  	$transaction = Transaction::create([
  		'client_id'=>$input['client_id']?:1,
  		'date'=>$input['date'],
  		'type'=>'Credit',
  		'reference_no'=>$ref_no,
  		'transaction_type'=>'Sale',
  		'brand_id'=>1,
  		'sub_total'=>$input['sub_total'],
  		'discount'=>$input['discount'],
  		'discount_type'=>$input['discount_type'],
  		'discount_amount'=>$input['discount_amount'],
  		'tax'=>$input['tax'],
  		'shipping_charges'=>$input['shipping_charges'],
  		'net_total'=>$input['net_total'],
  		'paid'=>$input['paid'],
  		'due'=>$input['due'],
  		'stuff_note'=>$input['stuff_note'],
  		'sell_note'=>$input['sale_note'],
  		'created_by'=>$user_id,

  	]);

  	return $transaction;
  }

  public function createSellLines($transaction,$variations)
  {
  	foreach ($variations as $variation) {
  		$create_sale_line = TransactionSellLine::create([
  			'transaction_id'=>$transaction->id,
  			'client_id'=>$transaction->client_id,
  			'product_id'=>$variation['product_id'],
  			'variation_id'=>$variation['variation_id'],
  			'quantity'=>$variation['quantity'],
  			'unit_price'=>$variation['unit_price'],
  			'total'=>$variation['unit_price']*$variation['quantity'],
  			'created_by'=>$transaction->created_by,
  		]);
  	}
  	return true;
  }


     public function decreaseProductQuantity($product_id, $variation_id, $brand_id, $new_quantity, $old_quantity = 0)
    {
        $qty_difference = $new_quantity - $old_quantity;

        $product = Product::find($product_id);

        //Check if stock is enabled or not.
            //Decrement Quantity in variations location table
            VariationBrandDetails::where('variation_id', $variation_id)
                ->where('product_id', $product_id)
                ->where('brand_id', $brand_id)
                ->decrement('qty_available', $qty_difference);

            
            // Variation::where('id', $variation_id)
            //     ->where('product_id', $product_id)
            //     ->decrement('qty_available', $qty_difference);

            //TODO: Decrement quantity in products table
            // Product::where('id', $product_id)
            //     ->decrement('total_qty_available', $qty_difference);

        return true;
    }


    public function IncreaseVariationQty($product_id, $variation_id, $brand_id, $new_quantity, $old_quantity = 0)

    {
        $product = Product::find($product_id);

        //Check if stock is enabled or not.
            //Decrement Quantity in variations location table
            VariationBrandDetails::where('variation_id', $variation_id)
                ->where('product_id', $product_id)
                ->where('brand_id', $brand_id)
                ->increment('qty_available', $new_quantity);

            
            // Variation::where('id', $variation_id)
            //     ->where('product_id', $product_id)
            //     ->decrement('qty_available', $qty_difference);

            //TODO: Decrement quantity in products table
            // Product::where('id', $product_id)
            //     ->decrement('total_qty_available', $qty_difference);

        return true;
    }


        /**
     * Update the payment status for purchase or sell transactions. Returns
     * the status
     *
     * @param int $transaction_id
     *
     * @return string
     */
    public function updatePaymentStatus($transaction_id, $final_amount = null)
    {
        $status = $this->calculatePaymentStatus($transaction_id, $final_amount);
        Transaction::where('id', $transaction_id)
            ->update(['payment_status' => $status]);

        return $status;
    }

    /**
     * Calculates the payment status and returns back.
     *
     * @param int $transaction_id
     * @param float $final_amount = null
     *
     * @return string
     */
    public function calculatePaymentStatus($transaction_id, $final_amount = null)
    {
        $total_paid = $this->getTotalPaid($transaction_id);

        if (is_null($final_amount)) {
            $final_amount = Transaction::find($transaction_id)->net_total;
        }

        $status = 'due';
        if ($final_amount <= $total_paid) {
            $status = 'paid';
        } elseif ($total_paid > 0 && $final_amount > $total_paid) {
            $status = 'partial';
        }

        return $status;
    }

    /**
     * Get total paid amount for a transaction
     *
     * @param int $transaction_id
     *
     * @return int
     */
    public function getTotalPaid($transaction_id)
    {
        $total_paid = TransactionPayment::where('transaction_id', $transaction_id)
                ->select(DB::raw('SUM(IF( is_return = 0, amount, amount*-1))as total_paid'))
                ->first()
                ->total_paid;

        return $total_paid;
    }

}
