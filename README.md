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
- POST `/api/material/materials`
- PATCH `/api/material/materials/{uuid}`
- DELETE `/api/material/materials/{uuid}`

#MaterialGroup:
- GET `/api/material_group/materials/{uuid}/group`
- GET `/api/material_group/material/groups`
- POST `/api/material_group/materials/groups`
- PATCH `/api/material_group/materials/{uuid}/group`
- DELETE `/api/material_group/materials/{uuid}/group`

#UnitMeasure:
- GET `/api/unit_measure/units/{uuid}/measure`
- GET `/api/unit_measure/unit/measures`
- POST `/api/unit_measure/units/measures`
- PATCH `/api/unit_measure/units/{uuid}/measure`
- DELETE `/api/unit_measure/units/{uuid}/measure`
