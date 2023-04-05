SELECT ROUND(SUM(d.pont*d.prioritas)/SUM(d.prioritas)) eredmeny,c.nev FROM dolgozok_ertekelesei d,dolgozok c WHERE d.deleted=0 AND d.id_lezart_ertekelesek=@lezart AND c.id=d.id_dolgozok
GROUP BY d.id_dolgozok ORDER BY nev ASC
