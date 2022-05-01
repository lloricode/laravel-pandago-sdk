<?php

use Illuminate\Support\Facades\Http;
use Lloricode\LaravelPandagoSdk\DTO\Order\FeeEstimateDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\OrderDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\TimeEstimateDTO;
use Lloricode\LaravelPandagoSdk\Enum\PaymentMethod;
use Lloricode\LaravelPandagoSdk\Facades\LaravelPandagoSdk;

use function PHPUnit\Framework\assertEquals;

it('submit', function () {
    $payloadRequest = <<<FAKE
{
  "sender": {
    "name": "Pandago",
    "phone_number": "+6500000000",
    "location": {
      "address": "1 2nd Street #08-01",
      "latitude": 1.2923742,
      "longitude": 103.8486029,
      "notes":"my notes"
    },
    "notes": "use the left side door"
  },
  "recipient": {
    "name": "Merlion",
    "phone_number": "+6500000000",
    "location": {
      "address": "20 Esplanade Drive",
      "latitude": 1.2857488,
      "longitude": 103.8548608,
      "notes":"my notes 2"
    },
    "notes": "use lift A and leave at the front door"
  },
  "amount": 23.5,
  "payment_method": "PAID",
  "description": "Refreshing drink"
}
FAKE;

    $payloadRequest = ['payment_method' => PaymentMethod::PAID()] + json_decode($payloadRequest, true);

    $payloadResponse = <<<FAKE
{
  "order_id": "y0ud-000001",
  "client_order_id": "client-ref-000001",
  "sender": {
    "name": "Pandago",
    "phone_number": "+6500000000",
    "location": {
      "address": "1 2nd Street #08-01",
      "latitude": 1.2923742,
      "longitude": 103.8486029,
      "notes": "my notes"
    },
    "notes": "use the left side door"
  },
  "recipient": {
    "name": "Merlion",
    "phone_number": "+6500000000",
    "location": {
      "address": "20 Esplanade Drive",
      "latitude": 1.2857488,
      "longitude": 103.8548608,
      "notes": "my notes 2"
    },
    "notes": "use lift A and leave at the front door"
  },
  "amount": 23.5,
  "payment_method": "PAID",
  "coldbag_needed": false,
  "status": "NEW",
  "description": "my description",
  "delivery_fee": 8,
  "timeline": {
    "estimated_pickup_time": "",
    "estimated_delivery_time": ""
  },
  "driver": {
    "id": "",
    "name": "",
    "phone_number": ""
  },
  "created_at": 1536802000,
  "updated_at": 1536802000
}
FAKE;

    $payloadResponse = json_decode($payloadResponse, true);

    $apiResponse = LaravelPandagoSdk::order()
        ->fake()
        ->fakeSubmit(Http::response($payloadResponse))
        ->submit(new OrderDTO($payloadRequest));

    expect($apiResponse)
        ->toArray()->toBe($payloadResponse);
});



it('show', function () {
    $payloadResponse = <<<FAKE
{
  "order_id": "y0ud-000001",
  "client_order_id": "client-ref-000001",
  "sender": {
    "name": "Pandago",
    "phone_number": "+6500000000",
    "location": {
      "address": "1 2nd Street #08-01",
      "latitude": 1.2923742,
      "longitude": 103.8486029,
      "notes": "my notes"
    },
    "notes": "use the left side door"
  },
  "recipient": {
    "name": "Merlion",
    "phone_number": "+6500000000",
    "location": {
      "address": "20 Esplanade Drive",
      "latitude": 1.2857488,
      "longitude": 103.8548608,
      "notes": "my notes 2"
    },
    "notes": "use lift A and leave at the front door"
  },
  "payment_method": "PAID",
  "coldbag_needed": false,
  "description": "Refreshing drink",
  "amount": 23.5,
  "status": "NEW",
  "delivery_fee": 8,
  "timeline": {
    "estimated_pickup_time": "",
    "estimated_delivery_time": ""
  },
  "driver": {
    "id": "",
    "name": "",
    "phone_number": ""
  },
  "created_at": 1536802000,
  "updated_at": 1536802000,
  "tracking_link": "https://example.com/test_tracking_path",
  "cancellation": {
    "reason": "MISTAKE_ERROR",
    "source": "CLIENT"
  }
}
FAKE;

    $payloadResponse = json_decode($payloadResponse, true);

    $apiResponse = LaravelPandagoSdk::order()
        ->fake()
        ->fakeShow('y0ud-000001', Http::response($payloadResponse))
        ->show('y0ud-000001');

    assertEquals($payloadResponse, $apiResponse->toArray());
});

it('cancel', function () {
    $payloadResponse = '{"message":"reason has been modified to REASON_UNKNOWN"}';

    $apiResponse = LaravelPandagoSdk::order()
        ->fake()
        ->fakeCancel(
            'order-id',
            Http::response($payloadResponse, 203)
        )
        ->cancel('order-id', 'MISTAKE_ERROR');

    assertEquals($apiResponse->collect()->toJson(), $payloadResponse);
});

it('get coordinates', function () {
    $payloadResponse = <<<FAKE
{
  "client_order_id": "client-ref-000001",
  "latitude": 1.2857488,
  "longitude": 103.8548608,
  "updated_at": 1536802252
}
FAKE;

    $payloadResponse = json_decode($payloadResponse, true);

    $apiResponse = LaravelPandagoSdk::order()
        ->fake()
        ->fakeCoordinates('client-ref-000001', Http::response($payloadResponse))
        ->coordinates('client-ref-000001');

    assertEquals($payloadResponse, $apiResponse->toArray());
});

it('get fee estimate', function () {
    $payloadRequest = <<<FAKE
{
  "sender": {
    "name": "Pandago",
    "phone_number": "+6500000000",
    "location": {
      "address": "1 2nd Street #08-01",
      "latitude": 1.2923742,
      "longitude": 103.8486029
    },
    "notes": "use the left side door"
  },
  "recipient": {
    "name": "Pandago",
    "phone_number": "+6500000000",
    "location": {
      "address": "20 Esplanade Drive",
      "latitude": 1.2857488,
      "longitude": 103.8548608
    },
    "notes": "use lift A and leave at the front door"
  },
  "amount": 23.5,
  "payment_method": "PAID",
  "description": "Refreshing drink"
}
FAKE;

    $payloadRequest = json_decode($payloadRequest, true);

    $apiResponse = LaravelPandagoSdk::order()
        ->fake()
        ->fakeFeeEstimate(
            Http::response(
                <<<FAKE
{
  "client_order_id": "client-ref-000001",
  "estimated_delivery_fee": 8.17
}
FAKE
            )
        )
        ->feeEstimate(new FeeEstimateDTO($payloadRequest));

    expect($apiResponse)
        ->client_order_id->toBe('client-ref-000001')
        ->estimated_delivery_fee->toBe(8.17);
});

it('get time estimate', function () {
    $payloadRequest = <<<FAKE
{
  "sender": {
    "name": "Pandago",
    "phone_number": "+6500000000",
    "location": {
      "address": "1 2nd Street #08-01",
      "latitude": 1.2923742,
      "longitude": 103.8486029
    },
    "notes": "use the left side door"
  },
  "recipient": {
    "name": "User",
    "phone_number": "+6500000000",
    "location": {
      "address": "20 Esplanade Drive",
      "latitude": 1.2857488,
      "longitude": 103.8548608
    },
    "notes": "use lift A and leave at the front door"
  },
  "amount": 23.5,
  "payment_method": "PAID",
  "description": "Refreshing drink"
}
FAKE;

    $payloadRequest = ['payment_method' => PaymentMethod::PAID()] + json_decode($payloadRequest, true);

    $payloadResponse = <<<FAKE
{
  "estimated_pickup_time": "2018-09-13T01:30:52.123Z",
  "estimated_delivery_time": "2018-09-13T01:45:52.123Z"
}
FAKE;
    $payloadResponse = json_decode($payloadResponse, true);

    $apiResponse = LaravelPandagoSdk::order()
        ->fake()
        ->fakeTimeEstimate(Http::response($payloadResponse))
        ->timeEstimate(new TimeEstimateDTO($payloadRequest));


    assertEquals($payloadResponse, $apiResponse->toArray());
});
