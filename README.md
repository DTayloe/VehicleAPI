<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About VehicleAPI

This is a coding challenge to create a vehicle sales inventory API, complete with documentation based on the OpenAPI specification. 

### OpenAPI specification

https://app.swaggerhub.com/apis/DTayloe/vehicle-api/1.0

## Setup

### Prerequisites

1. Clone the project using GitHub
2. Ensure Docker is installed and setup
3. `cd` to the root directory of the project in your terminal (such that this readme is listed)
4. Run the following command in the bash terminal:
`./vendor/bin/sail up`
5. You should be able to view the page at `localhost`, which contains a single button to redirect to the list of vehicles.

## Usage

> The resulting vehicle returned from certain queries below will have these properties in the returned JSON object:

- Make
- Model
- Year
- Color
- Price
- Mileage
- *Optional specs can be returned e.g. AWD, Engine type*

### Get paginated list of vehicles

GET `/api/vehicles`

### Store newly created vehicle

POST `/api/vehicles`

### Show specific vehicle by ID

GET `/api/vehicles/{id}`

### Update specific vehicle by ID

PUT `/api/vehicles/{id}`

### Delete specific vehicle by ID

DELETE `/api/vehicles/{id}`

## Search

The following criteria can be searched using the API. Substitute your search term for the curly braces in the request.

### Make

`/api/vehicles/search/make/{make}`

- Example

URL:

`http://localhost/api/vehicles/search/make/tesla`

Result:

```
{
  "current_page": 1,
  "data": [
    {
      "id": 26,
      "make": "tesla",
      "model": "test",
      "year": 2003,
      "color": "red",
      "price": "10000.00",
      "mileage": 2000,
      "options": "{\"AWD\": true}",
      "created_at": "2021-04-25T20:01:26.000000Z",
      "updated_at": "2021-04-25T20:01:26.000000Z"
    }
  ],
  "first_page_url": "http://localhost/api/vehicles/search/make/tesla?page=1",
  ...
```

### Model

`/api/vehicles/search/model/{model}`

### Year

`/api/vehicles/search/year/{year}`

### Color

`/api/vehicles/search/color/{color}`
