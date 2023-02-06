<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignProduct;
use App\Models\Product;

class CampaignProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($campaign_id)
    {
        $products = Product::where('product_status', 1)->get();
        return view('admin.offer.campaign_product.index', compact('products', 'campaign_id'));
    }

    public function store($product_id, $campaign_id)
    {
        $campaign = Campaign::where('id', $campaign_id)->first();
        $product = Product::where('id', $product_id)->first();

        $discount_price = (1 - $campaign->campaign_discount / 100) * $product->product_selling_price;

        CampaignProduct::insert([
            'campaign_id' => $campaign_id,
            'product_id' => $product_id,
            'price' => $discount_price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Campaing Product added', 'alert_type' => 'success');
        return back()->with($notification);
    }

    function list($campaign_id) {
        $campaign_products = CampaignProduct::where('campaign_id', $campaign_id)->get();
        $campaign = Campaign::where('id', $campaign_id)->first();
        return view('admin.offer.campaign_product.edit', compact('campaign_products', 'campaign'));
    }

    public function destroy($id)
    {
        CampaignProduct::where('id', $id)->delete();
        $notification = array('message' => 'Campaing Product Removed', 'alert_type' => 'success');
        return back()->with($notification);
    }
}
