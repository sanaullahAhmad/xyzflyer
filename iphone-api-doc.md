
#Iphone api endpoints

**Title**: Get login credentials for users
**Description**: get login credentials for api if already loggedin return same credentials again
**Method**: `POST`
**URL**: `/api/v1/mobile/login'`
**URL Params**: Not Required
**DATA PARAMS**: 
```php
        { 
            username: [string]
            password: [string]
        }

```

**success response**: 
```php 
    [
        "status" => "200",
        "message" => "You are logged in." ,
        "data" => 
            [
              //admin_id and token user must store and send in headers at each request for validation
            "admin_id" : integer,
            "token" => string ,
            "username" => string
            "admin_email" => string,
            "pending_flyer": integer
            ]
    ]

```

**ERR RESPONSE**
```php
    [
        "status" => "401",
        "message" => "Invalid username or password or not super-admin" 
    ]
    OR
    [
        "status" => "401",
        "message" => "No empty fields"
    ]

```

**NOTES**
 + api-developer note: 
 + api-end-user note:
    - you should store admin_id and token for sending subsequent requrest to other authenticated resources.
    - use header `Auth-Admin-Id`  and `Auth-Token` 



_________________________________________________________________________________________________________________END_________________________________________________________________________________________________________________________

**Title**: Logout
**Description**: get logout
**Method**: `DELETE`
**URL**: `api/v1/mobile/logout'`
**URL Params**: Not Required
**DATA PARAMS**: Not Required

**success response**: 
```php 
    [
        "status" => "200",
        "message" => "Logged Out",
        "data" => 
        [
            "admin_id" => integer
        ]
    ]

```

**ERR RESPONSE**
```php
    [
        "status" => "401",
        "message" => "Invalid username or password or not super-admin" 
    ]
    OR
    [
        "status" => "200",
        "message" => "No such account record or session",
    ]

```

**NOTES**
 + api-developer note: 
 + api-end-user note:
    - use header `Auth-Admin-Id`  and `Auth-Token` 

_________________________________________________________________________________________________________________END_________________________________________________________________________________________________________________________

**Title**:  List flyers
**Description**:  List all flyers or list flyers by status
**Method**: `POST`
**URL**: `api/v1/mobile/flyerlist`
**URL Params**: Not Required
**DATA PARAMS**: 
```php
        { 
            "status": [integer]  //>>optional
            //-1 for trash  
            //0 pending
            //1 for approve
             //2 for reject
        }

```

**success response**: 
```php 
    [
        "status" => "200",
        "thumb_path"=>"Image thumb path",
        "message" => "Data fetch Successfully."
        "data" =>[
       {
          "flyer_title": [string],
          "thumb": [string],
          "order_id": [integer],
          "order_date": [string],
          "order_time":[string],
          "order_datetime":[string] //US militray formate
          "status": [integer]
        }

        ]
    ]
```

**ERR RESPONSE**
```php
    [
        "status" => "404",
        "message" => "No data found." 
    ]
    OR
    [
        "status" => "401",
        "message" => "Invalid access." 
    ]
```

**NOTES**
 + api-developer note: Image and thumb have same name value.only to  use different path will make them differ.
 + api-end-user note:
    - use header `Auth-Admin-Id`  and `Auth-Token` 


_________________________________________________________________________________________________________________END_________________________________________________________________________________________________________________________
**Title**:  Flyer Info
**Description**:  list user info and total sales of user monthly/yearly/total
**Method**: `POST`
**URL**: `api/v1/mobile/flyerinfo`
**URL Params**: Not Required
**DATA PARAMS**: 
```php
        { 
            "order_id": [integer],//required
        }

```

**success response**: 
```php 
    [
        "status" => "200",
        "image_path": "Image path",
        "thumb_path": "Image thumb path",
        "message" => "Data fetch Successfully."
        "data" =>[
        {
            "fname": [string],
            "lname": [string],
            "flyer_title": [string],
            "image": [string],
            "property_address": [string],
            "property_main_header": [string],
            "property_headline": [string],
            "property_price":[string],
            "order_id": [integer],
            "order_user": [integer],
            "total_counties": [integer],
            "counties": [string],
            "create_date": [string],
            "created_time":[string],
            "created_datetime":[string] //US militray formate
            "totalvalue": [float],
            "totalsend": [integer]
        }
        ]
    ]
```

**ERR RESPONSE**
```php
    [
        "status" => "404",
        "message" => "No data found." 
    ]
    OR
    [
        "status" => "401",
        "message" => "Invalid access." 
    ]
    OR
     [
        "status" => "401",
        "message" => "No order found." 
    ]

```

**NOTES**
 + api-developer note: 
 + api-end-user note:
    - use header `Auth-Admin-Id`  and `Auth-Token` 

_________________________________________________________________________________________________________________END_________________________________________________________________________________________________________________________

**Title**:  Client Info
**Description**:  list user info and total sales of user monthly/yearly/total
**Method**: `POST`
**URL**: `api/v1/mobile/clientinfo`
**URL Params**: Not Required
**DATA PARAMS**: 
```php
        { 
            "user_id": [integer],//required
            "year": [string],//optional use for search
            "month": [string]//optional use for search
           
        }

```

**success response**: 
```php 
    [
        "status" => "200",
        "message" => "Data fetch Successfully."
        "data" =>[
        {
            "fname":[string],
            "lname":[string],
            "phone":[string],
            "email":[string],
            "company":[string],
            "state":[string],
            "county":[string],
            "city":[string],
            "zipCode":[string],
            "address":[string],
            "monthSale":[float],//by default the current month
            "yearSale":[float],//by default the current year
            "totalSale":[float],
        }
        ]
    ]
```

**ERR RESPONSE**
```php
    [
        "status" => "404",
        "message" => "No data found." 
    ]
    OR
    [
        "status" => "401",
        "message" => "Invalid access." 
    ]
    OR
     [
        "status" => "401",
        "message" => "No user found." 
    ]

```

**NOTES**
 + api-developer note: 
 + api-end-user note:
    - use header `Auth-Admin-Id`  and `Auth-Token` 
_________________________________________________________________________________________________________________END_________________________________________________________________________________________________________________________
**Title**:  Get general stats
**Description**:  get stats like email: sent, flyer rejected etc. ...
**Method**: `POST`
**URL**: `api/v1/mobile/stats`
**URL Params**: Not Required
**DATA PARAMS**: 
```php
        { 
            "date_from": [string],//optional date formate is 2016-10-21 
            "date_to": [string],//optional date formate is 2016-10-21
           
        }

```
**success response**: 
```php 
    [
        "status" => "200",
        "message" => "Data fetch Successfully."
        "data" =>[
                'sent' => integer, //email sent
                'bounces' => integer, //email bounces
                'optOut' => integer, //unsubscribed mails
                'transactions' => integer, //failed tranactions
                'rejected' => integer, //rejected flyer orders
                'pending' => integer, //pending flyer orders
                'approved' => integer, //approved lyer orders
                'failed' => integer, //failed flyer orders
                'sales' => integer //total sales
        ]
    ]
```

**ERR RESPONSE**
```php
     [
        "status" => "424",
        "message" => "some thing bad happen while processing"
    ]
```

**NOTES**
 + api-developer note: 
 + api-end-user note:
    - use header `Auth-Admin-Id`  and `Auth-Token`
_________________________________________________________________________________________________________________END_________________________________________________________________________________________________________________________
**Title**:  Make order processed or reject
**Description**:  flyer process or reject
**Method**: `POST`
**URL**: `api/v1/mobile/flyerProcess`
**URL Params**: Not Required
**DATA PARAMS**: 
```php
        { 
            "status": [int],//required
            "order_id": [int],//required
            "rejection": [string],//rejection reason comments >> optional
           
        }

```
**success response**: 
```php 
    [
        "status" => "200",
        "message" => "Order Completed Successfully."
       
    ]

    [
        "status" => "200",
        "message" => "Successfully Order Rejected."
       
    ]
```

**ERR RESPONSE**
```php
     [
        "status" => "401",
        "message" => "The order is already processed.No action is allowed."
    ]
```
```php
     [
        "status" => "424",
        "message" => "Some error please try later."
    ]
```
```php
     [
        "status" => "401",
        "message" => "Invalid action."
    ]
```
```php
     [
        "status" => "401",
        "message" => "No data found."
    ]
```

**NOTES**
 + api-developer note: 
 + api-end-user note:
    - use header `Auth-Admin-Id`  and `Auth-Token`
_________________________________________________________________________________________________________________END_________________________________________________________________________________________________________________________
