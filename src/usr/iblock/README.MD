# PHP Framework D7 Snippets


# Iblock snippets

View [new](/src/lib/iblock/new), [old](/src/lib/iblock/old) API code

## Get started

1. Change directory:

```shell
$ cd /path/to/snippets/src
$ ls
exec.php        init.php        lib             usr
```

2. Execute command:

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    ....
```

# Command

## Init

**Container**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/init_container.php"
```

**Property**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/init_property.php"
```

**Section**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/init_section_$num.php"
```

**Element**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/init_element.php"
```

## Update

**Container**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/update_container.php"
```

**Element**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/update_element.php"
```

## Delete

**Property**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/delete_property.php"
```

**Element**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/delete_element.php"
```

## Fetch

**Section**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/fetch_section.php"

