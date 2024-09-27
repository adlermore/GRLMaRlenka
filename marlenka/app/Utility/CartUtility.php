<?php

namespace App\Utility;

use App\Models\Cart;
use Cookie;

class CartUtility
{
    public static function get_price($product, $product_specification)
    {
        $price = $product->price;

        $price = self::discount_calculation($product, $price);
        return $price;
    }

    public static function discount_calculation($product, $price)
    {
        $discount_applicable = false;

        if (
            $product->discount_start_date == null ||
            (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
                strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date)
        ) {
            $discount_applicable = true;
        }

        if ($discount_applicable) {
            if ($product->discount_type == 'percent') {
                $price -= ($price * $product->discount) / 100;
            } elseif ($product->discount_type == 'amount') {
                $price -= $product->discount;
            }
        }
        return $price;
    }

    public static function tax_calculation($product, $price)
    {
        $tax = 0;
        foreach ($product->taxes as $product_tax) {
            if ($product_tax->tax_type == 'percent') {
                $tax += ($price * $product_tax->tax) / 100;
            } elseif ($product_tax->tax_type == 'amount') {
                $tax += $product_tax->tax;
            }
        }

        return $tax;
    }

    public static function save_cart_data($cart, $product, $price, $tax, $quantity)
    {
        $cart->quantity = $quantity;
        $cart->product_id = $product->id;
        $cart->owner_id = $product->user_id;
        $cart->price = $price;
        $cart->tax = $tax;
        $cart->product_referral_code = null;
        $cart->save();
    }
}
