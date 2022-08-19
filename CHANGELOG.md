# Changelog

All notable changes to `laravel-pandago-sdk` will be documented in this file.

## v1.6.8 - v1.6.9 - 2022-08-19

- Fix caching config

## v1.6.7 - 2022-08-19

- Add new command to generate key pair.
- Optimise test for generating key pair.
- Add dynamic key pair path.

## v1.6.6 - 2022-08-19

- Use random uuid in jti.

## v1.6.5 - 2022-08-12

- Fix production base url.

## v1.6.4 - 2022-08-01

- Fix cancel when api return null.

## v1.6.3 - 2022-07-01

- Set default 1 minute expiration.

## v1.6.2 - 2022-07-01

- Always generate timestamp for exp.

## v1.6.1 - 2022-07-01

- Ignore all missing in DTO.

## v1.6.0 - 2022-07-01

- Allow dynamic urls.

## v1.5.0 - 2022-06-30

- Add generate jwt for `client_assertion` in generate access_token.

## v1.4.1 - 2022-06-30

- Remove `ASSIGNED_TO_TRANSPORT` to cancellable status.

## v1.4.0 - 2022-06-30

- Added `isCoordinateAvailable` on status.
- Changed enum from `CallBackStatuses` to `Status`.

## v1.3.1 - 2022-06-30

- Fixed CoordinatesDTO->client_order_id as nullable.

## v1.3.0 - 2022-06-29

- Added country code for order url.

## v1.2.0 - 2022-06-29

- Fixed data types.
- Added `toDateReadable` in TimeEstimateResponseDTO.

## v1.0.4 - 2022-06-02

- Added check isCancellable().

## v1.0.3 - 2022-05-20

- Fixed missing message in cancel.

## v1.0.2 - 2022-05-20

- Fixed missing message in cancel.

## v1.0.1 - 2022-05-19

- Fixed missing response on submit order.

## v1.0.0 - 2022-05-19

- Initial Release.
