
SELECT 
COUNT(*) AS aktualis,
p.maximum,
p.ertek prioritas,
p.nev

FROM
prioritasok p,
dolgozok_ertekelesei e
WHERE 
	e.id_dolgozok=@dolgozo
	AND e.prioritas=p.ertek
	AND e.deleted=0 
	AND (SELECT COUNT(*) FROM dolgozok d WHERE d.vezeto=@vezeto AND d.id=id_dolgozok)>0
GROUP BY e.prioritas