<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Visit;
use App\Product;

class VisitTest extends TestCase
{
    /**
     * Add Visit and its products using a factory model.
     *
     * @return void
     */
    public function testVisit()
    {
        $newRecord = factory(Visit::class)->create();
        $newRecordID = $newRecord->id;
        $max = rand(1, 10);
        for ($i = 0; $i < $max ; $i++) {
            $product_id = Product::inRandomOrder()->first()->id;
            $qtd = rand(0, 15);
            $amount = rand(0, 500);
            if ($qtd == 0) {
                $amount = 0;
            }
            $newRecord->products()->attach([$product_id], ['qtd' => $qtd, 'amount' => $amount]);
        }
        dump('visit id ' . $newRecordID);
        $model = [
            'data' => Visit::find($newRecordID)
        ];
        $model = (array)$model;
        // dump($model['data']['id']);
        dump("assertTrue(\$model['data']['id'] == $newRecord->id)");
        $this->assertTrue($model['data']['id'] == $newRecordID);
    }
}
