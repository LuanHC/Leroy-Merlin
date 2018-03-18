---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://leroymerlin.test/docs/collection.json)
<!-- END_INFO -->

#general
<!-- START_dd873464f7c6ace481b7520ef5394dc9 -->
## Display a listing of the products.

> Example request:

```bash
curl -X GET "http://leroymerlin.test/products" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://leroymerlin.test/products",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true,
    "status_code": 200,
    "message": "messages.product.all",
    "products": [
        {
            "id": 1,
            "category_id": 1,
            "lm": 1001,
            "name": "Furadeira X",
            "free_shipping": 0,
            "description": "Furadeira eficiente X",
            "price": 100,
            "created_at": {
                "date": "2018-03-18 16:02:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-03-18 16:08:43.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        },
        {
            "id": 2,
            "category_id": 1,
            "lm": 1002,
            "name": "Furadeira Y",
            "free_shipping": 1,
            "description": "Furadeira super eficiente Y",
            "price": 140,
            "created_at": {
                "date": "2018-03-18 16:02:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-03-18 16:02:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        },
        {
            "id": 3,
            "category_id": 1,
            "lm": 1003,
            "name": "Chave de Fenda X",
            "free_shipping": 0,
            "description": "Chave de fenda simples",
            "price": 20,
            "created_at": {
                "date": "2018-03-18 16:02:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-03-18 16:02:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        },
        {
            "id": 4,
            "category_id": 1,
            "lm": 1008,
            "name": "Serra de Marmore",
            "free_shipping": 1,
            "description": "Serra com 1400W modelo 4100NH2Z-127V-L",
            "price": 399,
            "created_at": {
                "date": "2018-03-18 16:02:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-03-18 16:02:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        },
        {
            "id": 5,
            "category_id": 1,
            "lm": 1009,
            "name": "Broca Z",
            "free_shipping": 0,
            "description": "Broca simples",
            "price": 3.9,
            "created_at": {
                "date": "2018-03-18 16:02:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-03-18 16:02:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        },
        {
            "id": 6,
            "category_id": 1,
            "lm": 1010,
            "name": "Luvas de Proteção",
            "free_shipping": 0,
            "description": "Luva de proteção básica",
            "price": 5.6,
            "created_at": {
                "date": "2018-03-18 16:02:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            },
            "updated_at": {
                "date": "2018-03-18 16:02:51.000000",
                "timezone_type": 3,
                "timezone": "UTC"
            }
        }
    ]
}
```

### HTTP Request
`GET products`

`HEAD products`


<!-- END_dd873464f7c6ace481b7520ef5394dc9 -->

<!-- START_e69e3804fa0af1eb523e480d661362b7 -->
## Store a newly created product in storage.

> Example request:

```bash
curl -X POST "http://leroymerlin.test/products" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://leroymerlin.test/products",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST products`


<!-- END_e69e3804fa0af1eb523e480d661362b7 -->

<!-- START_164b804602a2f6de772150ffba05ba43 -->
## Display the specified product.

> Example request:

```bash
curl -X GET "http://leroymerlin.test/products/{product}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://leroymerlin.test/products/{product}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true,
    "status_code": 200,
    "message": "messages.product.show",
    "product": {
        "id": 1,
        "category_id": 1,
        "lm": 1001,
        "name": "Furadeira X",
        "free_shipping": 0,
        "description": "Furadeira eficiente X",
        "price": 100,
        "created_at": {
            "date": "2018-03-18 16:02:51.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        },
        "updated_at": {
            "date": "2018-03-18 16:08:43.000000",
            "timezone_type": 3,
            "timezone": "UTC"
        }
    }
}
```

### HTTP Request
`GET products/{product}`

`HEAD products/{product}`


<!-- END_164b804602a2f6de772150ffba05ba43 -->

<!-- START_3d6f3cbb4f154b7da4faac30c3380d51 -->
## Update the specified product in storage.

> Example request:

```bash
curl -X PUT "http://leroymerlin.test/products/{product}" \
-H "Accept: application/json" \
    -d "id"="voluptate" \
    -d "category_id"="voluptate" \
    -d "lm"="voluptate" \
    -d "name"="voluptate" \
    -d "free_shipping"="voluptate" \
    -d "description"="voluptate" \
    -d "price"="voluptate" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://leroymerlin.test/products/{product}",
    "method": "PUT",
    "data": {
        "id": "voluptate",
        "category_id": "voluptate",
        "lm": "voluptate",
        "name": "voluptate",
        "free_shipping": "voluptate",
        "description": "voluptate",
        "price": "voluptate"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT products/{product}`

`PATCH products/{product}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | Valid product id
    category_id | string |  required  | Valid category id
    lm | string |  required  | 
    name | string |  required  | 
    free_shipping | string |  required  | 
    description | string |  required  | 
    price | string |  required  | 

<!-- END_3d6f3cbb4f154b7da4faac30c3380d51 -->

<!-- START_9dc19a575e78a6169cad6bda8a2186de -->
## Remove the specified product from storage.

> Example request:

```bash
curl -X DELETE "http://leroymerlin.test/products/{product}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://leroymerlin.test/products/{product}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE products/{product}`


<!-- END_9dc19a575e78a6169cad6bda8a2186de -->

<!-- START_2f1038cabc13b0dbcd0e043a404758b2 -->
## Display a listing of the categories.

> Example request:

```bash
curl -X GET "http://leroymerlin.test/categories" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://leroymerlin.test/categories",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true,
    "status_code": 200,
    "message": "messages.category.all",
    "categories": [
        {
            "name": "123123"
        }
    ]
}
```

### HTTP Request
`GET categories`

`HEAD categories`


<!-- END_2f1038cabc13b0dbcd0e043a404758b2 -->

<!-- START_cb37a009c57f6e054e721aada4d9664b -->
## Store a newly created category in storage.

> Example request:

```bash
curl -X POST "http://leroymerlin.test/categories" \
-H "Accept: application/json" \
    -d "name"="dolores" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://leroymerlin.test/categories",
    "method": "POST",
    "data": {
        "name": "dolores"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST categories`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | 

<!-- END_cb37a009c57f6e054e721aada4d9664b -->

<!-- START_f387be7fc23bca291442057cd2b00065 -->
## Display the specified category.

> Example request:

```bash
curl -X GET "http://leroymerlin.test/categories/{category}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://leroymerlin.test/categories/{category}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "success": true,
    "status_code": 200,
    "message": "messages.category.show",
    "category": {
        "name": "123123"
    }
}
```

### HTTP Request
`GET categories/{category}`

`HEAD categories/{category}`


<!-- END_f387be7fc23bca291442057cd2b00065 -->

<!-- START_5c7692955c3e2542b25146f0d77e3767 -->
## Update the specified category in storage.

> Example request:

```bash
curl -X PUT "http://leroymerlin.test/categories/{category}" \
-H "Accept: application/json" \
    -d "id"="veritatis" \
    -d "name"="veritatis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://leroymerlin.test/categories/{category}",
    "method": "PUT",
    "data": {
        "id": "veritatis",
        "name": "veritatis"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT categories/{category}`

`PATCH categories/{category}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | Valid category id
    name | string |  required  | 

<!-- END_5c7692955c3e2542b25146f0d77e3767 -->

<!-- START_c595e22ac497b4ace0ad442feffe7712 -->
## Remove the specified category from storage.

> Example request:

```bash
curl -X DELETE "http://leroymerlin.test/categories/{category}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://leroymerlin.test/categories/{category}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE categories/{category}`


<!-- END_c595e22ac497b4ace0ad442feffe7712 -->

<!-- START_05316d0ab9b7b56d1e7514c4a1096983 -->
## Verify if import queue is ended.

> Example request:

```bash
curl -X GET "http://leroymerlin.test/verify" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://leroymerlin.test/verify",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET verify`

`HEAD verify`


<!-- END_05316d0ab9b7b56d1e7514c4a1096983 -->

