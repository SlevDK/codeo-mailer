#### All requests required
```
    Accept: application/json
```

#### All requests under authorization required
```
    Authorization: JWT <token>
```    

### Common responses:
```json    
    {
        "code": 21,
        "message": "Some validation failed"
    }
    
    {
        "code": 43,
        "message": "Unauthenticated."
    }
    
    {
        "code": 44,
        "message": "Not found"
    }
    
    {
        "code": 44,
        "message": "Bad request"
    }
    
    {
        "code": 50,
        "message": "Unprocessed error"
    }
```    
    


## Account

### Create user

Route:
```http_request
    POST /api/v1/account/create
```

Params:

    - username: required, string, mix:4, max:255, 
    - email:    required, email (must be valid email), max:255, unique:users (unique in users db)
    - password: required, mix:6, max:255
    
Response:
```json
    {
        "code": 20,
        "message": "Success",
        "payload": {
            "id": 1,
            "username": "slevin"
        }
    }
    
    {
        "code": 33,
        "message": "User with username/email already exists"
    }
```
    
### Token retrieve

Route:
```http_request
    POST /api/v1/account/token-obtain
```

Params:

    - email:    required, email (must be valid email)
    - password: required

Response:
```json
    {
        "token": "yn3OIijZMgNlErtxHuJE6UNMnhMsswOmmYpvs66LrieV2jk4EDymhfsd30l1"
    }
    
    {
        "non_field_errors": [
            "Unable to log in with provided credentials."
        ]
    }
```    
    
    
### Get current user info (Authorization token required)

Route:
```http_request
    GET /api/v1/account/
```

Params:

    - none
    
Response:
```json
    {
        "status": 20,
        "message": "Success",
        "payload": {
            "id": 1,
            "username": "slevin",
            "email": "test@mail.me"
        }
    }
```    
    
    
    
## Campaigns (Auth token required)

### Retrieve list

Route:
```http_request
    GET /api/v1/manager/campaigns
```

Params:

    - page:     integer
    - limit:    integer (count per page) (default 20)
    - status:   string (one of 'active', 'paused', 'finished', 'stopping', 'draft', 'archive') 
                (default 'all' (if param missing or not in list))
    
Response:
```json
    {
        "status": 20,
        "message": "Success",
        "payload": {
            "count": 1, // retrieved count
            "total": 1, // total campaigns in db
            "prev": null, // next page
            "next": null, // prev page
            "results": [ // campaigns collection
                {
                    "id": 1,
                    "name": "",
                    "note": null,
                    "status": "draft",
                    "mails": []
                }
            ]
        }
    }
```


### Campaign create

Route:
```http_request
    POST: /api/v1/manager/campaign
```

Params:

    - name:     string, min:3, max:255 (campaign name, null if param missing)
    - note:     string (note, null if param missing)
    
Response:
```json
    {
        "status": 20,
        "message": "Success",
        "payload": {
            "id": 1,
            "name": null,
            "note": null,
            "status": null,
            "mails": []
        }
    }
```    
    
### Campaign retrieve

Request:
```http_request
    GET /api/v1/manager/campaign/{id}
```    
Params:

    - none
    
Response:
```json
    {
        "status": 20,
        "message": "Success",
        "payload": {
            "id": 1,
            "name": "",
            "note": null,
            "status": "draft",
            "mails": []
        }
    }
```    
    
    
### Campaign update

Request:
```http_request
    PUT /api/v1/manager/campaign/{id}
```

Params:

    - name:     string, min:3, max:255
    - note:     string
    - status:   string (one of 'statuses list')
    
Response:
```json
    {
        "status": 20,
        "message": "Success",
        "payload": {
            "id": 1,
            "name": "updates name",
            "note": null,
            "status": "active",
            "mails": []
        }
    }
```   
    
    
### Campaign delete

Request:
```http_request
    DELETE /api/v1/manager/campaign/{id}
```

Params:

    - none
    
Response:
```json
    {
        "code": 20,
        "message": "Success"
    }
```    
    
    
## Mails (Auth token required)

### Create

Route:
```http_request
    POST /api/v1/manager/campaign/{id}/mails
```
    
Params:

    - name:     required, string, min:3, max:50
    
Response:
```json
    {
        "code": 200,
        "message": "Success",
        "payload": {
            "id": 1,
            "name": "test mail",
            "order": null,
            "enabled": false
        }
    }
```    
    
    
### Retrieve

Route:
```http_request
    GET /api/v1/manager/mails/{id}
```

Params:

    - none
    
Response:
```json
    {
        "code": 200,
        "message": "Success",
        "payload": {
            "id": 1,
            "name": "test mail",
            "order": 0,
            "enabled": false
        }
    }
```    
    
    
### Update

Route:
```http_request
    PUT /api/v1/manager/mails/{id}
```    

Fields:

    - name:     string, min:3, max:50
    - order:    integer
    - enabled:  boolean
    
Response:
```json
    {
        "code": 200,
        "message": "Success",
        "payload": {
            "id": 1,
            "name": "updated test mail",
            "order": "7",
            "enabled": false
        }
    }
```    
    
    
### Delete:

Route:
```http_request
    DELETE /api/v1/manager/mails/{id}
```    
    
Params:

    - none
    
Response:
```json
    {
        "code": 20,
        "message": "Success"
    }
```    
    
    
## Mail Headers (Auth token required)
    
### Retrieve

Request:
```http_request
    GET /api/v1/manager/mails/{id}/headers
```    
    
Params:

    - none
    
Response:
```json
    {
        "status": 20,
        "message": "Success",
        "payload": {
            "data": "''"
        }
    }
```    
    
    
### Update

Request:
```http_request
    PUT /api/v1/manager/mails/{id}/headers
```    
    
Params:

    - data:     required, json (must be valid json)
                schema - [{"type":"text","content":"some text"},{"type":"list", "id":15, "content":"list name"},...]
            
Response:
```json
     {
        "status": 20,
        "message": "Success",
        "payload": {
            "data": "[{\"type\":\"text\",\"content\":\"some text\"},{\"type\":\"list\", \"id\":15, \"content\":\"list name\"}]"
        }
    }
```    
    
    
## Topics (Auth token required)

### Retrieve

Request:
```http_request
    GET /api/v1/manager/mails/{id}/topics
```    
    
Params:

    - none
    
Response:
```json
    {
        "status": 20,
        "message": "Success",
        "payload": {
            "data": "''"
        }
    }
```    
    
    
### Update

Request:
```http_request
    PUT /api/v1/manager/mails/{id}/topics
```    
    
Params:

    - data:     required, json (must be valid json)
                schema - [{"type":"text","content":"some text"},{"type":"list", "id":15, "content":"list name"},...]
            
Response:
```json
    {
        "status": 20,
        "message": "Success",
        "payload": {
            "data": "[{\"type\":\"text\",\"content\":\"some text\"},{\"type\":\"list\", \"id\":15, \"content\":\"list name\"}]"
        }
    }
```    
    
    
    
    
## Mail Body (Auth token required)

### Retrieve

Request:
```http_request
    GET /api/v1/manager/mails/{id}/body
```    
    
Params:

    - none
    
Response:
```json
    {
        "status": 20,
        "message": "Success",
        "payload": {
            "content": ""
        }
    }
```    
    
    
### Update

Request:
```http_request
    PUT /api/v1/manager/mails/{id}/body
```    
    
Params:
    
    - content:  required, string
    
Response:
```json
    {
        "status": 20,
        "message": "Success",
        "payload": {
            "content": "updated body"
        }
    }
```    