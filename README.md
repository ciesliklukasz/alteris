alteris-project
===============

To run project:
- `git clone git@github.com:polishvodka/alteris.git`
- `composer install`
- change data in `parameters.yml`
- `php app/console doctrine:schema:update --force`

API
===============

#Material:
- GET `/api/material/materials/{uuid}`
- GET `/api/material/materials`
- POST `/api/material/materials`:
	```
		"code": 'test' -> required,
		"name": 'test' -> required,
		"materialGroup": 'uuid' -> required,
		"unitMeasure": 'uuid' -> required,
- PATCH `/api/material/materials/{uuid}`
	```
		"code": 'test',
		"name": 'test',
		"materialGroup": 'uuid',
		"unitMeasure": 'uuid',
- DELETE `/api/material/materials/{uuid}`

#MaterialGroup:
- GET `/api/material_group/materials/{uuid}/group`
- GET `/api/material_group/material/groups`
- POST `/api/material_group/materials/groups`
	```
		"code": 'test' -> required,
		"parent": 'uuid',
		"children": 'uuid'
- PATCH `/api/material_group/materials/{uuid}/group`
	```
		"code": 'test',
		"parent": 'uuid',
       	"children": 'uuid'
- DELETE `/api/material_group/materials/{uuid}/group`

#UnitMeasure:
- GET `/api/unit_measure/units/{uuid}/measure`
- GET `/api/unit_measure/unit/measures`
- POST `/api/unit_measure/units/measures`
	```
    	"name": 'test' -> required,
    	"shortName": 'test' -> required,
- PATCH `/api/unit_measure/units/{uuid}/measure`
	```
        "name": 'test' -> required,
        "shortName": 'test' -> required,
- DELETE `/api/unit_measure/units/{uuid}/measure`
