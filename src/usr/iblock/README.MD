# PHP Framework D7 Snippets


# Iblock snippets

Change directory:

```shell
$ cd /path/to/snippets/src
$ ls
exec.php        init.php        lib             usr
```

Execute command:

* Init
* Update
* Delete
* Fetch

View [new](/src/lib/iblock/new), [old](/src/lib/iblock/old) API code


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
    --pathToData "usr/iblock/init_section.php"
```

**Element**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/init_element.php"
```

## Update

**Property**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/update_property.php"
```

**Element**

```shell
php exec.php \
    --moduleName "iblock" --apiType "new" \
    --pathToData "usr/iblock/update_element.php"
```
