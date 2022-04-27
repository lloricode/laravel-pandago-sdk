<?php

use Illuminate\Support\Facades\Http;
use Lloricode\LaravelPandagoSdk\API\Order\FakeOrderAPI;
use Lloricode\LaravelPandagoSdk\DTO\Order\FeeDTO;
use Lloricode\LaravelPandagoSdk\DTO\Order\OrderDTO;

it('can order', function (array $payload) {
    ray()->clearAll();

    $orderPayload = <<<FAKE
{
  "order_id": "y0ud-000001",
  "client_order_id": "client-ref-000001",
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
    "name": "Merlion",
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
  "coldbag_needed": false,
  "status": "NEW",
  "delivery_fee": 8.17,
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

    $arrayPayload = json_decode($orderPayload, true);

    $orderResponse = FakeOrderAPI::new()
        ->fakeSubmit(Http::response($arrayPayload))
        ->submit(new OrderDTO($payload));

    expect($orderResponse)
        ->toArray()->toBe($arrayPayload);
})
    ->depends('generate-dto');

test('generate-dto', function () {
    $payload = <<<FAKE
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
    "name": "Merlion",
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

    $array = json_decode($payload, true);
    $dto = new OrderDTO($array);

    expect($dto)
        ->toArray()->toBe($array);

    return $array;
});

it('cancel', function () {
    $response = FakeOrderAPI::new()
        ->fakeCancel()
        ->cancel('MISTAKE_ERROR');
});

it('get coordinates', function () {
    $response = FakeOrderAPI::new()
        ->fakeCoordinates()
        ->coordinates();
});

it('get fee', function () {
    $payload = <<<FAKE
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

    $payloadArray = json_decode($payload, true);

    $response = FakeOrderAPI::new()
        ->fakeFee(Http::response(
            <<<FAKE
{
  "client_order_id": "client-ref-000001",
  "estimated_delivery_fee": 8.17
}
FAKE
        ))
        ->fee(new FeeDTO($payloadArray));

    expect($response)
        ->client_order_id->toBe('client-ref-000001')
        ->estimated_delivery_fee->toBe(8.17);
});
