# cotizador_gmz
Cotizador de seguros GMZ 


### Json inpunt

```json
{
  "cotizador": {
    "id_rango_edad": 1,
    "val_min": 600,
    "val_max": 100
  }
}
```

### Json information errors
- Invalid JSON value found

```json
{
  "status": {
    "type": "error",
    "value": "No JSON value set"
  }
}
```

- Invalid JSON structure

```json
{
  "status": {
  "type": "error",
  "value": "Invalid JSON structure."
  }
}
```
- Valid JSON but error in database.

```json
{
  "status": {
  "type": "error",
  "value": "Valid JSON but error in database.",
  "error_data_base": "error detail"
  }
}
```

### Json 
- Valid JSON but not found data in data base.
- Valid JSON and found data in data base.
- No JSON value set


