# Changelog

All notable changes to `laravel-pandago-sdk` will be documented in this file.

## v1.4.1 - 2022-06-30

- Remove `ASSIGNED_TO_TRANSPORT` to cancellable status

## v1.4.0 - 2022-06-30

- Added `isCoordinateAvailable` on status
- Changed enum from `CallBackStatuses` to `Status`

## v1.3.1 - 2022-06-30

- Fixed CoordinatesDTO->client_order_id as nullable

## v1.3.0 - 2022-06-29

- Added country code for order url

## v1.2.0 - 2022-06-29

- Fixed data types
- Added `toDateReadable` in TimeEstimateResponseDTO

## v1.0.4 - 2022-06-02

- Added check isCancellable()

## v1.0.3 - 2022-05-20

- Fixed missing message in cancel

## v1.0.2 - 2022-05-20

- Fixed missing message in cancel

## v1.0.1 - 2022-05-19

- Fixed missing response on submit order

## v1.0.0 - 2022-05-19

- Initial Release