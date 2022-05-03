<?php return "
        IE.IBLOCK_ID = (
            SELECT ID
            FROM b_iblock
            WHERE CODE LIKE '$iblockCode'
        )
        $stringSectionFilterValueLike
    ORDER BY IE.ID
";