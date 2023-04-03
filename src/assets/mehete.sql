SELECT 
(SELECT COUNT(*) FROM dolgozok_ertekelesei e2 WHERE e2.id_lezart_ertekelesek=0 AND e2.deleted=0  AND e2.id_dolgozok=@dolgozo) osszes,
(SELECT COUNT(*) FROM dolgozok_ertekelesei e WHERE e.id_lezart_ertekelesek=0 AND  e.deleted = 0 AND e.id_dolgozok=@dolgozo AND e.prioritas=@prioritas) prio,
(SELECT p.maximum FROM prioritasok p WHERE p.ertek=@prioritas) maximum,
(SELECT COUNT(*) FROM dolgozok_ertekelesei e WHERE e.id_lezart_ertekelesek=0 AND  e.deleted = 0 AND e.id_dolgozok=@dolgozo AND e.id_celok=@cel) ezacel