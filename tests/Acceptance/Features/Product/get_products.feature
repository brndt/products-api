Feature: Search products by criteria

  Scenario: Search products ordered by creation date
    Given there are products with the following details:
      | id                                   | sku    | category | name                            | price |
      | ce07cb5c-160a-4171-9d02-3e1e12212e78 | 000001 | boots    | BV Lean leather ankle boots     | 89000 |
      | d35a1c15-b302-45ea-b06a-e2d9db62c15a | 000002 | boots    | BV Lean leather ankle boots     | 99000 |
      | acc2c21f-33c4-4aaa-a3d5-a5133938048b | 000003 | boots    | Ashlington leather ankle boots  | 71000 |
      | 25912c6d-e95b-4a4a-b329-108791dae9b3 | 000004 | sandals  | Naima embellished suede sandals | 79500 |
      | 45797212-3d9c-40cb-b0c8-6b345490527b | 000005 | sneakers | Nathane leather sneakers        | 59000 |
    And there are product discounts by category with the following details:
      | id                                   | category | discount_percentage |
      | 913268b4-1a7b-4a95-a6a2-0eb61db85071 | boots    | 30                  |
    And there are product discounts by sku with the following details:
      | id                                   | sku    | discount_percentage |
      | f8f9d78a-2bdc-4457-89ec-2bf75e7b7439 | 000003 | 15                  |
    When I send a GET request to "/products"
    Then the response status code should be 200
    And the response content should be:
    """
    [
    {
      "id": "25912c6d-e95b-4a4a-b329-108791dae9b3",
      "sku": "000004",
      "category": "sandals",
      "name": "Naima embellished suede sandals",
      "price": {
        "original_price": 79500,
        "final_price": 79500,
        "discount_percentage": "0%",
        "currency": "EUR"
      }
    },
    {
      "id": "45797212-3d9c-40cb-b0c8-6b345490527b",
      "sku": "000005",
      "category": "sneakers",
      "name": "Nathane leather sneakers",
      "price": {
        "original_price": 59000,
        "final_price": 59000,
        "discount_percentage": "0%",
        "currency": "EUR"
      }
    },
    {
      "id": "acc2c21f-33c4-4aaa-a3d5-a5133938048b",
      "sku": "000003",
      "category": "boots",
      "name": "Ashlington leather ankle boots",
      "price": {
        "original_price": 71000,
        "final_price": 49700,
        "discount_percentage": "30%",
        "currency": "EUR"
      }
    },
    {
      "id": "ce07cb5c-160a-4171-9d02-3e1e12212e78",
      "sku": "000001",
      "category": "boots",
      "name": "BV Lean leather ankle boots",
      "price": {
        "original_price": 89000,
        "final_price": 62300,
        "discount_percentage": "30%",
        "currency": "EUR"
      }
    },
    {
      "id": "d35a1c15-b302-45ea-b06a-e2d9db62c15a",
      "sku": "000002",
      "category": "boots",
      "name": "BV Lean leather ankle boots",
      "price": {
        "original_price": 99000,
        "final_price": 69300,
        "discount_percentage": "30%",
        "currency": "EUR"
      }
    }
    ]
    """