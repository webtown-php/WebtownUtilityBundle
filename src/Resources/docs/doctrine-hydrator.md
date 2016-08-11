# Doctrine hydrator

## KeyValue hydrator

Symfony esetében a hydratort engedélyezni kell a config.yml-ben:
```
doctrine:
    orm:
        entity_managers:
            default:
                hydrators:
                    key_value_hydrator: Webtown\UtilityBundle\Doctrine\Hydrator\KeyValueHydrator
```

Használata például egy repository classban:
```php
$this->createQueryBuilder('a')
    ->select('a.id', 'a.name')
    ->getQuery()
    ->getResult('key_value_hydrator')
;
```

Az eredmény egy tömb lesz, aminek az elemeinek a kulcsa az első mező, az értéke pedig a második mező. Például:
```php
array(
    1 => 'Első',
    2 => 'Második',
)
```
