<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $shop = $request->get('shop');
        if ($shop == null) {
            return response()->json(['status' => '400']);
        } elseif ($shop == 'sl') {
            $sl_gender = $request->get('sl_gender');
            $sl_min_price = $request->get('sl_min_price');
            $sl_max_price = $request->get('sl_max_price');
            $sl_color = $request->get('sl_color');
            $sl_occasion = $request->get('sl_occasion');
            $sl_style = $request->get('sl_style');

            $sl_gender = (empty($sl_gender)) ? '' : 'gender=' . $sl_gender . '&';
            $sl_min_price = (empty($sl_min_price)) ? '' : 'min_price=' . $sl_min_price . '&';
            $sl_max_price = (empty($sl_max_price)) ? '' : 'max_price=' . $sl_max_price . '&';
            $sl_color = (empty($sl_color)) ? '' : 'color=' . $sl_color . '&';
            $sl_occasion = (empty($sl_occasion)) ? '' : 'occasion=' . $sl_occasion . '&';
            $sl_style = (empty($sl_style)) ? '' : 'style=' . $sl_style . '&';

            $parameters = "sort_by=relevance&" . $sl_gender . $sl_min_price . $sl_max_price . $sl_color . $sl_occasion
                . $sl_style;
            $url = "http://api-hack.stylight.net/products?" . $parameters;
            $header = array(
                "accept: application/json",
                "cache-control: no-cache",
                "x-api-key: H6490912AB3211E680F576304DEC7EB7"
            );
        } elseif ($shop == 'wg') {
            $wg_age = $request->get('wg_age');
            $wg_min_price = $request->get('wg_min_price');
            $wg_max_price = $request->get('wg_max_price');
            $wg_date_from = $request->get('wg_date_from');
            $wg_date_to = $request->get('wg_date_to');
            $wg_city_id = $request->get('wg_city_id');
        }


        $curl = curl_init();

        curl_setopt_array(
            $curl, array(
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING       => "",
                CURLOPT_MAXREDIRS      => 10,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST  => "GET",
                CURLOPT_HTTPHEADER     => $header,
            )
        );

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return response()->json();
        }
        $productJson = json_decode($response, true);
        $products = array();
        foreach ($productJson['products'] as $id => $product) {
            $products[] = [
                'product_id' => $product['id'],
                'name'       => $product['name'],
                'price'      => $product['price'],
                'image_url'  => $product['images'][0]['url']
            ];
        }

        return $products;
    }
}
