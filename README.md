# PHP - Discord Nitro Checker API

### Note : Use checker.php file to use because this api url is expired. (22/06/2022)

### Documention : [https://nitro-gift.nankaji-dev.tk/](https://nitro-gift.nankaji-dev.tk/)

### Demo : [https://nitro-gift.nankaji-dev.tk/demo.php](https://nitro-gift.nankaji-dev.tk/demo.php)

## Github Documention :

### API url : `https://nitro-gift.nankaji-dev.tk/api/nitro-checker/{code}`

### METHOD SUPPORT : `GET`

### Version : 0.1.1

Example ajax code (jQuery) :

```javascript
$.get(`https://nitro-gift.nankaji-dev.tk/api/nitro-checker/${nitro_code}`, function (data, status) {
    if (status == "success") {
      if (data.status == 404) {
        // Invalid
      } else if (data.status == 429) {
        // Cooldown
      } else if (data.status == 200) {
        if (!data.claimed) {
          // Valid and Available
        } else {
          // Invalid and Unavailable
        }
      } else {
        // Unknown
      }
    } else {
      // Error
    }
});
```

Example curl (PHP) :

```php
$ch = curl_init();

curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => "https://nitro-gift.nankaji-dev.tk/api/nitro-checker/$nitro_code",
    CURLOPT_SSL_VERIFYPEER => false
));

$response = curl_exec($ch);

$result = json_decode($response, true);

curl_close($ch);

if ($result['status'] == 200) {
    if (!$result['claimed']) {
        // Valid and available
    } else {
        // Valid and unavailable
    }
} else if ($result['status'] == 404) {
    // Invalid
} else if ($result['status'] == 429) {
    // Cooldown
} else {
    // Unknown
}
```

## Example JSON Response :

Status code : 200 (Available)

```json
{
    "message": "[NITRO GIFT/PROMO] Code is valid !",
    "status": 200,
    "claimed": false,
    "nitro_type": "gift/promo"
}
```

Status code : 200 (Used)

```json
{
    "message": "[NITRO GIFT/PROMO] Code is valid but this code is being used !",
    "status": 200,
    "claimed": true,
    "nitro_type": "gift/promo"
}
```

Status code : 404 (Invalid)

```json
{
    "message": "Code is invalid !",
    "status": 404
}
```

Status code : 0 (Missing Information)

```json
{
    "message": "MISSING_INFORMATION",
    "status": 0
}
```

Status code : 100 (Minimum Length)

```json
{
    "message": "Value must be more than 16 characters !",
    "status": 100
}
```

Status code : 101 (Maximum Length)

```json
{
    "message": "Value must be less than 30 characters !",
    "status": 101
}
```

Status code : 429 (Cooldown)

```json
{
    "message": "Wait for cooldown 15(s)",
    "status": 429,
    "countdown": 15
}
```

Status code : -1 (Unknown)

```json
{
    "message": "Unknown status",
    "status": -1
}
```

## Contact me

Facebook : [`Facebook`](https://www.facebook.com/Kuromi.Dev/)

Email : `kuromi.dev@tokovn.com`
