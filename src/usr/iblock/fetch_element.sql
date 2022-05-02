SELECT IEP.IBLOCK_ELEMENT_ID AS EL_ID, IEP.IBLOCK_PROPERTY_ID AS EL_PR_ID, IEP.VALUE AS EL_PR_VAL,
       IP.NAME AS PR_NAME
FROM b_iblock_element_property IEP
         LEFT JOIN b_iblock_element IE ON IEP.IBLOCK_ELEMENT_ID = IE.ID
         LEFT JOIN b_iblock_property IP ON IEP.IBLOCK_PROPERTY_ID = IP.ID
WHERE IE.IBLOCK_ID = (
    SELECT ID
    FROM b_iblock
    WHERE CODE LIKE 'supplier-steel'
)
ORDER BY IEP.IBLOCK_ELEMENT_ID







SELECT I.ID AS I_ID, I.NAME AS I_NAME,
       IE.ID AS IE_ID, IE.NAME AS IE_NAME,
       VALUE_NUM, VALUE,
       IP.NAME AS IP_NAME, IP.ID AS IP_ID, IP.CODE AS IP_CODE
FROM b_iblock_element_property
         LEFT JOIN b_iblock_element IE ON IBLOCK_ELEMENT_ID = IE.ID
         LEFT JOIN b_iblock_property IP ON IBLOCK_PROPERTY_ID = IP.ID
         LEFT JOIN b_iblock I ON IE.IBLOCK_ID = I.ID
WHERE IBLOCK_ELEMENT_ID IN (
    SELECT IBLOCK_ELEMENT_ID
    FROM b_iblock_element_property
    WHERE IBLOCK_PROPERTY_ID = (
        SELECT ID
        FROM b_iblock_property
        WHERE CODE LIKE 'SHIPMENT_ON_DAY_PAY'
    )
      AND VALUE = (
        SELECT ID
        FROM b_iblock_property_enum
        WHERE VALUE LIKE 'SHIPMENT_ON_DAY_PAY_ENABLE'
    )
)
  AND IE.IBLOCK_ID = (
    SELECT ID
    FROM b_iblock
    WHERE CODE LIKE 'supplier-steel'
)







SELECT IPEN.ID AS IPEN_ID, IPEN.VALUE AS IPEN_VALUE,
       IP.ID AS IP_ID, IP.CODE AS IP_CODE,
       IEP.IBLOCK_ELEMENT_ID AS IEP_ELEMENT_ID, IEP.VALUE AS IEP_VALUE
FROM b_iblock_property_enum IPEN
         LEFT JOIN b_iblock_property IP ON IPEN.PROPERTY_ID = IP.ID
         LEFT JOIN b_iblock_element_property IEP ON IP.ID = IEP.IBLOCK_PROPERTY_ID
WHERE IP.IBLOCK_ID = 7
  AND IPEN.VALUE IN ('AIRPLANE', 'SEMI_TRUCK')
ORDER BY IPEN.ID





SELECT IPEN.ID AS IPEN_ID, IPEN.VALUE AS IPEN_VALUE,
       IP.ID AS IP_ID, IP.CODE AS IP_CODE,
       IEP.IBLOCK_ELEMENT_ID AS IEP_ELEMENT_ID, GROUP_CONCAT(IEP.VALUE SEPARATOR ', ') AS IEP_VALUE
FROM b_iblock_property_enum IPEN
         LEFT JOIN b_iblock_property IP ON IPEN.PROPERTY_ID = IP.ID
         LEFT JOIN b_iblock_element_property IEP ON IP.ID = IEP.IBLOCK_PROPERTY_ID
WHERE IP.IBLOCK_ID = 7
  AND IPEN.VALUE IN ('AIRPLANE', 'SEMI_TRUCK')
GROUP BY IEP.IBLOCK_ELEMENT_ID




SELECT IEP.IBLOCK_ELEMENT_ID AS IEP_ELEMENT_ID, GROUP_CONCAT(IEP.VALUE SEPARATOR ', ') AS IEP_VALUE
FROM b_iblock_property_enum IPEN
         LEFT JOIN b_iblock_property IP ON IPEN.PROPERTY_ID = IP.ID
         LEFT JOIN b_iblock_element_property IEP ON IP.ID = IEP.IBLOCK_PROPERTY_ID
WHERE IP.IBLOCK_ID = 7
  AND IPEN.VALUE IN ('AIRPLANE', 'SEMI_TRUCK')
GROUP BY IEP.IBLOCK_ELEMENT_ID




SELECT TAB.IEP_ELEMENT_ID, TAB.IEP_VALUE
FROM
    (SELECT IEP.IBLOCK_ELEMENT_ID AS IEP_ELEMENT_ID, GROUP_CONCAT(IEP.VALUE SEPARATOR ', ') AS IEP_VALUE
     FROM b_iblock_property_enum IPEN
          LEFT JOIN b_iblock_property IP ON IPEN.PROPERTY_ID = IP.ID
          LEFT JOIN b_iblock_element_property IEP ON IP.ID = IEP.IBLOCK_PROPERTY_ID
     WHERE IP.IBLOCK_ID = 7
       AND IPEN.VALUE IN ('AIRPLANE', 'SEMI_TRUCK')
     GROUP BY IEP.IBLOCK_ELEMENT_ID) AS TAB
WHERE TAB.IEP_VALUE LIKE '%46%' AND TAB.IEP_VALUE LIKE '%47%'









SELECT I.ID AS I_ID, I.NAME AS I_NAME,
       IE.ID AS IE_ID, IE.NAME AS IE_NAME,
       VALUE_NUM, VALUE,
       IP.NAME AS IP_NAME, IP.ID AS IP_ID, IP.CODE AS IP_CODE
FROM b_iblock_element_property
         LEFT JOIN b_iblock_element IE ON IBLOCK_ELEMENT_ID = IE.ID
         LEFT JOIN b_iblock_property IP ON IBLOCK_PROPERTY_ID = IP.ID
         LEFT JOIN b_iblock I ON IE.IBLOCK_ID = I.ID
WHERE IBLOCK_ELEMENT_ID IN (
    SELECT RUNTIME_LIST_ELEMENT_ID.IEP_ELEMENT_ID
    FROM
        ( SELECT IEP.IBLOCK_ELEMENT_ID AS IEP_ELEMENT_ID, GROUP_CONCAT(IEP.VALUE SEPARATOR ', ') AS IEP_VALUE
          FROM b_iblock_property_enum IPEN
                   LEFT JOIN b_iblock_property IP ON IPEN.PROPERTY_ID = IP.ID
                   LEFT JOIN b_iblock_element_property IEP ON IP.ID = IEP.IBLOCK_PROPERTY_ID
          WHERE IP.IBLOCK_ID = (
              SELECT ID
              FROM b_iblock
              WHERE CODE LIKE 'supplier-steel'
          )
            AND IPEN.VALUE IN ('AIRPLANE', 'SEMI_TRUCK', 'SHIPMENT_ON_DAY_PAY_ENABLE', 'PAYMENT_DEFERMENT_ENABLE')
          GROUP BY IEP.IBLOCK_ELEMENT_ID ) AS RUNTIME_LIST_ELEMENT_ID
    WHERE
            RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
            SELECT ID
            FROM b_iblock_property_enum
            WHERE VALUE LIKE 'AIRPLANE'
        ), '%')
      AND
            RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
            SELECT ID
            FROM b_iblock_property_enum
            WHERE VALUE LIKE 'SEMI_TRUCK'
        ), '%')
      AND
            RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
            SELECT ID
            FROM b_iblock_property_enum
            WHERE VALUE LIKE 'SHIPMENT_ON_DAY_PAY_ENABLE'
        ), '%')
      AND
            RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
            SELECT ID
            FROM b_iblock_property_enum
            WHERE VALUE LIKE 'PAYMENT_DEFERMENT_ENABLE'
        ), '%')
)
  AND IE.IBLOCK_ID = (
    SELECT ID
    FROM b_iblock
    WHERE CODE LIKE 'supplier-steel'
)
ORDER BY IE_ID











-- mixed

             [root@localhost src]#
    [root@localhost src]#
    [root@localhost src]# php exec.php \
>         --moduleName "iblock" --apiType "new" \
>         --pathToData "usr/iblock/fetch_element_by_property_mixed_1.php"

SELECT I.ID AS I_ID, I.NAME AS I_NAME,
       IE.ID AS IE_ID, IE.NAME AS IE_NAME,
       VALUE_NUM, VALUE,
       IP.NAME AS IP_NAME, IP.ID AS IP_ID, IP.CODE AS IP_CODE
FROM b_iblock_element_property
         LEFT JOIN b_iblock_element IE ON IBLOCK_ELEMENT_ID = IE.ID
         LEFT JOIN b_iblock_property IP ON IBLOCK_PROPERTY_ID = IP.ID
         LEFT JOIN b_iblock I ON IE.IBLOCK_ID = I.ID
WHERE IBLOCK_ELEMENT_ID IN (
    SELECT RUNTIME_LIST_ELEMENT_ID.IEP_ELEMENT_ID
    FROM
        ( SELECT IEP.IBLOCK_ELEMENT_ID AS IEP_ELEMENT_ID, GROUP_CONCAT(IEP.VALUE SEPARATOR ', ') AS IEP_VALUE
          FROM b_iblock_property_enum IPEN
                   LEFT JOIN b_iblock_property IP ON IPEN.PROPERTY_ID = IP.ID
                   LEFT JOIN b_iblock_element_property IEP ON IP.ID = IEP.IBLOCK_PROPERTY_ID
          WHERE IP.IBLOCK_ID = (
              SELECT ID
              FROM b_iblock
              WHERE CODE LIKE 'supplier-steel'
          )
            AND IPEN.VALUE IN ('AIRPLANE', 'SEMI_TRUCK', 'PAYMENT_TYPE_REQUISIT', 'SHIPMENT_ON_DAY_PAY_ENABLE', 'PAYMENT_DEFERMENT_ENABLE')
          GROUP BY IEP.IBLOCK_ELEMENT_ID ) AS RUNTIME_LIST_ELEMENT_ID
    WHERE RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
        SELECT ID
        FROM b_iblock_property_enum
        WHERE VALUE LIKE 'AIRPLANE'
    ), '%')
      AND
            RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
            SELECT ID
            FROM b_iblock_property_enum
            WHERE VALUE LIKE 'SEMI_TRUCK'
        ), '%')
      AND
            RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
            SELECT ID
            FROM b_iblock_property_enum
            WHERE VALUE LIKE 'PAYMENT_TYPE_REQUISIT'
        ), '%')
      AND
            RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
            SELECT ID
            FROM b_iblock_property_enum
            WHERE VALUE LIKE 'SHIPMENT_ON_DAY_PAY_ENABLE'
        ), '%')
      AND
            RUNTIME_LIST_ELEMENT_ID.IEP_VALUE LIKE CONCAT('%', (
            SELECT ID
            FROM b_iblock_property_enum
            WHERE VALUE LIKE 'PAYMENT_DEFERMENT_ENABLE'
        ), '%')
)
  AND IBLOCK_ELEMENT_ID IN (
    SELECT IBLOCK_ELEMENT_ID
    FROM b_iblock_element_property
    WHERE IBLOCK_PROPERTY_ID = (
        SELECT ID
        FROM b_iblock_property
        WHERE CODE LIKE 'PAYMENT_BANK'
    )
      AND VALUE LIKE 'ПАО Банк «ФК Oткpытиe»'
)
  AND
        IBLOCK_ELEMENT_ID IN (
        SELECT IBLOCK_ELEMENT_ID
        FROM b_iblock_element_property
        WHERE IBLOCK_PROPERTY_ID = (
            SELECT ID
            FROM b_iblock_property
            WHERE CODE LIKE 'DELIVERY_WEIGHT_LIMIT'
        )
          AND VALUE LIKE '150 тонн'
    )
  AND IE.IBLOCK_ID = (
    SELECT ID
    FROM b_iblock
    WHERE CODE LIKE 'supplier-steel'
)
    [root@localhost src]#

