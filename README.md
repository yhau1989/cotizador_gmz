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
- No JSON value set

```json
{
  "status": {
    "type": "error",
    "value": "No JSON value set"
  }
}
```


### Json 
- Valid JSON but not found data in data base.

```json
{
  "status":{
  "type": "ok",
  "value": "Valid JSON but not found data in data base."
  }
}
```

- Valid JSON and found data in data base.

```json
{
  "status": {
    "type": "ok",
    "value": "Valid JSON and found data in data base."
  },
  "planes": [
    {
      "id": "4",
      "rango": "18-24",
      "razon_social": "VUMI S.A",
      "nombre_plan": "OPCION 4",
      "anual": "935.00",
      "semi_anual": "496.00",
      "trimestral": null,
      "bimestral": null,
      "mensual": null,
      "dentro_usa": "10000.00",
      "fuera_usa": null,
      "estado": "1"
    },
    {
      "id": "5",
      "rango": "18-24",
      "razon_social": "VUMI S.A",
      "nombre_plan": "OPCION 5",
      "anual": "736.00",
      "semi_anual": "391.00",
      "trimestral": null,
      "bimestral": null,
      "mensual": null,
      "dentro_usa": "20000.00",
      "fuera_usa": null,
      "estado": "1"
    }
  ]
}
```

