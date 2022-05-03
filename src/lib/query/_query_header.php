<?php return "
    SELECT I.ID AS I_ID, I.NAME AS I_NAME,
           IE.ID AS IE_ID, IE.NAME AS IE_NAME, IE.IBLOCK_SECTION_ID AS IE_IBLOCK_SECTION_ID,
           IEP.VALUE_NUM AS IEP_VALUE_NUM, IEP.VALUE AS IEP_VALUE, IEP.VALUE_ENUM AS IEP_VALUE_ENUM,
           IP.NAME AS IP_NAME, IP.ID AS IP_ID, IP.CODE AS IP_CODE, IP.MULTIPLE AS IP_MULTIPLE,
           IPEN.VALUE AS IPEN_VALUE
    FROM b_iblock_element IE
             LEFT JOIN b_iblock_element_property IEP ON IEP.IBLOCK_ELEMENT_ID = IE.ID
             LEFT JOIN b_iblock_property IP ON IEP.IBLOCK_PROPERTY_ID = IP.ID
             LEFT JOIN b_iblock I ON IE.IBLOCK_ID = I.ID
             LEFT JOIN b_iblock_property_enum IPEN ON IEP.VALUE_ENUM = IPEN.ID
";