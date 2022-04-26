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


## Init

**Container**

```shell
php exec.php \
    --moduleName "iblock" \
    --apiType "new" \
    --pathToData "usr/iblock/init_container.php"
```

**Element**

```shell
php exec.php \
	--moduleName "iblock" \ 
	--apiType "new" \
	--pathToData "usr/iblock/init_element.php"
```

## Update

**Container**

```shell
php exec.php \
	--moduleName "iblock" \ 
	--apiType "new" \
	--pathToData "usr/iblock/init_container.php"
```

**Element**

```shell
php exec.php \
	--moduleName "iblock" \ 
	--apiType "new" \
	--pathToData "usr/iblock/init_element.php"
```
