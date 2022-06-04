# PHP - Discord Nitro Checker API

### Documention : [https://nitro-gift.nankaji-dev.tk/](https://nitro-gift.nankaji-dev.tk/)

### Demo : [https://nitro-gift.nankaji-dev.tk/demo.php](https://nitro-gift.nankaji-dev.tk/demo.php)

## Github Documention :

### API url : `https://nitro-gift.nankaji-dev.tk/api/nitro-checker/{code}`

Example ajax code (jQuery) :

```javascript
$.get(`https://nitro-gift.nankaji-dev.tk/api/nitro-checker/zjnOmBuYgXcuGPyU`, function (data, status) {
    if (status == "success") {
      if (data.status == 404) {
        // Invalid
      } else if (data.status == 427) {
        // Cooldown
      } else if (data.status == 200) {
        if (!data.claimed) {
          // Valid and Available
        } else {
          // Invalid and Unavailable
        }
      }
    } else {
      // Error
    }
});
```

## Example JSON Response :

Status code : 200 (Available)

```json
{
    "message": "Code is valid !",
    "status": 200,
    "claimed": false
}
```
